<?php

namespace Khairulkabir\Steadfast\Services;

use Illuminate\Support\Facades\Http;
use Khairulkabir\Steadfast\Models\SteadfastsConfig;
use Illuminate\Http\Client\RequestException;


define("LB_API_DEBUG", false);
if(!LB_API_DEBUG){
	@ini_set('display_errors', 0);
}


class SteadfastApiServices
{
    protected $baseUrl;
    protected $apiKey;
    protected $secretKey;
    protected $enable_disable;
    public $notes;


    private $product_id;
	private $api_url;
	private $api_key;
	private $api_language;
	private $current_version;
	private $verify_type;


    private $license_code;

    private $client_name;

    private $license_file;


    public function __construct()
    {
        $config = SteadfastsConfig::firstOrNew(); // Assuming you have one record for configuration
        
        $this->baseUrl = "https://portal.steadfast.com.bd/api/v1";
        $this->apiKey = $config->api_key;
        $this->secretKey = $config->secret_key;
        $this->enable_disable = $config->enable_disable;
        $this->notes = $config->notes;



        $this->product_id = '415DA99F';
		$this->api_url = 'https://licensebox.mustafij.com/';
		$this->api_key = '553692CC9CF48DA38B7A';
		$this->api_language = 'english';
		$this->current_version = 'v1.0.0';
		$this->verify_type = 'non_envato';

        $this->client_name = $config->client_name;
        $this->license_code = $config->license_code;
        $this->license_file = $config->license_file;
    

    } 

    // Make sure all requests are made without verifying SSL certificates
    protected function makeRequest($method, $url, $data = [])
    {
        $this->verify_license();
        
        if (!$this->enable_disable) {
            return [
                'status' => false,
                'message' => 'Please enable the API from settings',
            ];
        }
        
        return Http::withHeaders([
            'Api-Key' => $this->apiKey,
            'Secret-Key' => $this->secretKey,
            'Content-Type' => 'application/json',
        ])
        ->withoutVerifying() // Skip SSL certificate verification
        ->{$method}($this->baseUrl . $url, $data)
        ->json();
    }
    public function placeOrder($data)
    {
        return $this->makeRequest('post', '/create_order', $data);
    }
    public function bulkCreateOrders($data)
    {
        return $this->makeRequest('post', '/create_order/bulk-order', ['data' => json_encode($data)]);
    }
    public function checkDeliveryStatusByConsignmentId($id)
    {
        return $this->makeRequest('get', '/status_by_cid/' . $id);
    }

    public function checkDeliveryStatusByInvoiceId($id)
    {
        return $this->makeRequest('get', '/status_by_invoice/' . $id);
    }
    public function checkDeliveryStatusByTrackingCode($id)
    {
        return $this->makeRequest('get', '/status_by_trackingcode/' . $id);
    }
    public function getCurrentBalance()
    {
        return $this->makeRequest('get', '/get_balance');
    }
    private function callApi()
    {
        $url = $this->api_url . 'api/activate_license';
        $data_array = [
            "product_id" => $this->product_id,
            "license_code" => $this->license_code,
            "client_name" => $this->client_name,
            "verify_type" => $this->verify_type,
        ];

        if ($this->license_file) {
            // Set URL and data for license verification
            $url = $this->api_url . 'api/verify_license';
            $data_array = [
                "product_id" => $this->product_id,
                "license_file" => $this->license_file,
            ];
        } else {
            // Set URL and data for license activation
            $url = $this->api_url . 'api/activate_license';
            $data_array = [
                "product_id" => $this->product_id,
                "license_code" => $this->license_code,
                "client_name" => $this->client_name,
                "verify_type" => $this->verify_type,
            ];
        }



        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'LB-API-KEY' => $this->api_key,
                'LB-URL' => $this->getServerUrl(),
                'LB-IP' => $this->getServerIp(),
                'LB-LANG' => $this->api_language,
            ])->withoutVerifying()->timeout(30)->post($url, $data_array);

            $responseData = $response->json();

        

            if (!$response->successful() || !isset($responseData['status'])) {
                $errorMessage = $responseData['error'] ?? $responseData['message'] ?? 'Unknown error';
                return json_encode([
                    'status' => false,
                    'message' => LB_API_DEBUG ?? $errorMessage,
                ]);
            }

            if ($responseData['status'] == true) {
                if (!empty($responseData['lic_response'])) {
                    SteadfastsConfig::updateOrCreate(
                        [], // Adjust if multiple configurations need different conditions
                        ['license_file' => $responseData['lic_response']]
                    );
                }
            } else {
                $this->enable_disable = 0;
                SteadfastsConfig::updateOrCreate(
                    [],
                    ['enable_disable' => 0,'license_file' => null],
                    
                );

                $sessionKey = "55f8025ed1c2cba";
                $_SESSION[$sessionKey] = '00-00-0000';


            }

            return $responseData;

        } catch (RequestException | \Exception $e) {
            return json_encode([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
    private function getServerUrl()
    {
        $protocol = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === "on") || 
                     (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https'))
                    ? 'https://' : 'http://';

        return $protocol . ($_SERVER['SERVER_NAME'] ?? $_SERVER['HTTP_HOST'] ?? 'localhost') . ($_SERVER['REQUEST_URI'] ?? '/');
    }

    private function getServerIp(): array|bool|string
    {
        return getenv('SERVER_ADDR') ?? $_SERVER['SERVER_ADDR'] ?? $this->getIpFromThirdParty() ?? gethostbyname(gethostname());
    }

    private function getIpFromThirdParty()
    {
        try {
            $response = Http::timeout(5)->get('http://ipecho.net/plain');
            return $response->successful() ? trim($response->body()) : null;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function verify_license()
    {
        $sessionKey = "55f8025ed1c2cba";
        $today = date('d-m-Y');
    
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        // Initialize session key if not set, defaulting to an old date to trigger initial verification
        if (empty($_SESSION[$sessionKey])) {
            $_SESSION[$sessionKey] = '00-00-0000';
        }
        // Check if today's date is equal to or past the stored session date, then run verification if needed
        if (strtotime($today) || strtotime($_SESSION[$sessionKey])) {
            $res = $this->callApi();
          
            if ($res['status'] == true) {
                $next_check = date('d-m-Y', strtotime($today . ' + ' . $this->getVerificationPeriodText()));
                $_SESSION[$sessionKey] = $next_check;
            }
            return $res; 
        }
        return ['status' => true, 'message' => 'License is valid'];
    }
    

    private function getVerificationPeriodText()
    {
        $periods = [
            1 => '1 day',
            3 => '3 days',
            7 => '1 week',
            30 => '1 month',
            90 => '3 months',
            365 => '1 year',
        ];

        return $periods[7] ?? "7 days";
    }

}

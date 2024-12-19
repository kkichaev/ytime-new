<?php

namespace ArchiElite\EcommerceNotification\Listeners;

use ArchiElite\EcommerceNotification\Supports\EcommerceNotification;
use Botble\Ecommerce\Events\OrderConfirmedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendOrderConfirmedNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(OrderConfirmedEvent $event): void
    {
        $order = $event->order;

        EcommerceNotification::make()
            ->sendNotifyToDriversUsing('order', 'Order {{ order_id }} has been confirmed on {{ site_name }}.', [
                'order_id' => get_order_code($order->id),
                'order_url' => route('customer.orders.view', $order->getKey()),
                'order' => $order,
                'status' => $order->status->label(),
                'customer' => $order->address,
            ]);
    }
}
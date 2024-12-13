<?php

namespace Botble\EventsPlaces\Http\Controllers;

use Botble\EventsPlaces\Exporters\PostExporter;
use Botble\DataSynchronize\Exporter\Exporter;
use Botble\DataSynchronize\Http\Controllers\ExportController;

class ExportPostController extends ExportController
{
    protected function getExporter(): Exporter
    {
        return PostExporter::make();
    }
}

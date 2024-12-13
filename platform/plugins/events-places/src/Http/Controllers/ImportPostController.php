<?php

namespace Botble\EventsPlaces\Http\Controllers;

use Botble\EventsPlaces\Importers\PostImporter;
use Botble\DataSynchronize\Http\Controllers\ImportController;
use Botble\DataSynchronize\Importer\Importer;

class ImportPostController extends ImportController
{
    protected function getImporter(): Importer
    {
        return PostImporter::make();
    }
}

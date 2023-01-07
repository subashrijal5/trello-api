<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExportDbController extends Controller
{
    public function export()
    {
        $dumpFile = \Spatie\DbDumper\Databases\Sqlite::create()
            ->setDbName(database_path('database.sqlite'))
            ->dumpToFile('export.sql');
        return \response()->download($dumpFile);
    }
}

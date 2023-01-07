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
            if(!empty($dumpFile)){
                return \response()->download($dumpFile);
            }
            return back();
    }
}

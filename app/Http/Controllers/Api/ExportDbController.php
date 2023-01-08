<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ExportDbController extends Controller
{
    public function export()
    {
        try {
           \Spatie\DbDumper\Databases\MySql::create()
                ->setDbName('trello_db')
                ->setUserName('root')
                ->setPassword('Perception@555')
                ->dumpToFile('trello_db.sql');
            return \response()->download(\public_path('trello_db.sql'));
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getCode() ?? 500, $th->getMessage());
        }
    }
}

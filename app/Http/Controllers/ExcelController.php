<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\EvacsExport;
use App\Exports\AidWorkersExport;
use Maatwebsite\Excel\Facades\Excel;
use Auth;

class ExcelController extends Controller
{
    public function evac_history(){
        date_default_timezone_set('Asia/Singapore');
        return Excel::download(new EvacsExport, Auth::user()->center->barangay->brgy."_evac_history_".date('Y-m-d').".xlsx");
    }

    public function aid_workers(){
        date_default_timezone_set('Asia/Singapore');
        return Excel::download(new AidWorkersExport, "sample.xlsx");
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ManagementController extends Controller
{
    public function index()
    {
        $pengunjung = DB::table('Users')
        ->where('level','pengunjung')
        ->select('name', 'email')
        ->get();
        $opk = DB::table('Users')
        ->where('level','opk')
        ->select('name', 'email')
        ->get();
        $opm = DB::table('Users')
        ->where('level','opm')
        ->select('name', 'email')
        ->get();
        $ocs = DB::table('Users')
        ->where('level','ocs')
        ->select('name', 'email')
        ->get();

        return view('managementUser.manage', [
            'title' => 'Management User',
            'active' => 'management user',
            'pengunjung' => $pengunjung,
            'opk' => $opk,
            'opm' => $opm,
            'ocs' => $ocs
        ]);
    }
}

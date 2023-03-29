<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DisplayAntrianController extends Controller
{
    public function index()
    {
        $skrg = Carbon::now()->addHours(7);
        $HariIni = Carbon::now()->addHours(7)->startOfDay();
        $waktuAntri=Carbon::parse($skrg)->subMinutes(10);

        $jedaK = DB::table('waktus')
        ->where('jenis_layanan','karantina')
        ->pluck('jeda')
        ->first();
        $jedaM = DB::table('waktus')
        ->where('jenis_layanan','mutu')
        ->pluck('jeda')
        ->first();
        $jedaCS = DB::table('waktus')
        ->where('jenis_layanan','cs')
        ->pluck('jeda')
        ->first();

        // $waktuK = DB::table('antrians')
        // ->where('jenis_layanan','karantina')
        // ->where('tanggal_antrian', '<', $skrg)
        // ->orderBy('id', 'desc')
        // ->pluck('tanggal_antrian')
        // ->first();
        // $waktuM = DB::table('antrians')
        // ->where('jenis_layanan','mutu')
        // ->where('tanggal_antrian', '<', $skrg)
        // ->orderBy('id', 'desc')
        // ->pluck('tanggal_antrian')
        // ->first();
        // $waktuCS = DB::table('antrians')
        // ->where('jenis_layanan','cs')
        // ->where('tanggal_antrian', '<', $skrg)
        // ->orderBy('id', 'desc')
        // ->pluck('tanggal_antrian')
        // ->first();

        $waktuAntriK=Carbon::parse($skrg)->subMinutes($jedaK);
        $waktuAntriM=Carbon::parse($skrg)->subMinutes($jedaM);
        $waktuAntriCS=Carbon::parse($skrg)->subMinutes($jedaCS);

        $listK = DB::table('antrians')
            ->where('jenis_layanan', 'karantina')
            ->where('tanggal_antrian', '>', $skrg)
            ->orderBy('id', 'asc')
            ->select('no_antrian', 'no_ppk', 'tanggal_antrian')
            ->get();

        $listM = DB::table('antrians')
            ->where('jenis_layanan', 'mutu')
            ->where('tanggal_antrian', '>', $skrg)
            ->orderBy('id', 'asc')
            ->select('no_antrian', 'no_ppk', 'tanggal_antrian')
            ->get();

        $listCS = DB::table('antrians')
            ->where('jenis_layanan', 'cs')
            ->where('tanggal_antrian', '>', $skrg)
            ->orderBy('id', 'asc')
            ->select('no_antrian', 'no_ppk', 'tanggal_antrian')
            ->get();

        if(count($listK)>0){
            $panggilK = DB::table('antrians')
            ->where('jenis_layanan', 'karantina')
            ->where('tanggal_antrian', '<', $skrg)
            ->where('tanggal_antrian', '>', $HariIni)
            ->orderBy('id', 'desc')
            ->select('no_antrian', 'no_ppk', 'tanggal_antrian')
            ->first();
        }else{
            $panggilK = DB::table('antrians')
            ->where('jenis_layanan', 'karantina')
            ->where('tanggal_antrian', '>', $waktuAntriK)
            ->orderBy('id', 'desc')
            ->select('no_antrian', 'no_ppk', 'tanggal_antrian')
            ->first();
        }
        
        if(count($listM)>0){
            $panggilM = DB::table('antrians')
            ->where('jenis_layanan', 'mutu')
            ->where('tanggal_antrian', '<', $skrg)
            ->where('tanggal_antrian', '>', $HariIni)
            ->orderBy('id', 'desc')
            ->select('no_antrian', 'no_ppk', 'tanggal_antrian')
            ->first();
        }else{
            $panggilM = DB::table('antrians')
            ->where('jenis_layanan', 'mutu')
            ->where('tanggal_antrian', '>', $waktuAntriM)
            ->orderBy('id', 'desc')
            ->select('no_antrian', 'no_ppk', 'tanggal_antrian')
            ->first();
        }

        if(count($listCS)>0){
            $panggilCS = DB::table('antrians')
            ->where('jenis_layanan', 'cs')
            ->where('tanggal_antrian', '<', $skrg)
            ->where('tanggal_antrian', '>', $HariIni)
            ->orderBy('id', 'desc')
            ->select('no_antrian', 'no_ppk', 'tanggal_antrian')
            ->first();
        }else{
            $panggilCS = DB::table('antrians')
            ->where('jenis_layanan', 'cs')
            ->where('tanggal_antrian', '>', $waktuAntriCS)
            ->orderBy('id', 'desc')
            ->select('no_antrian', 'no_ppk', 'tanggal_antrian')
            ->first();
        }

        return view('display', [
            'title' => 'Antrian Pengunjung',
            'panggilK' => $panggilK,
            'panggilM' => $panggilM,
            'panggilCS' => $panggilCS,
        ]);
    }
}

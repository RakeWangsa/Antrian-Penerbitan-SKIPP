<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AntriansController;

class DashboardController extends Controller
{

    public function tampil(Request $request){
        
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

        $waktuAntriK=Carbon::parse($skrg)->subMinutes($jedaK);
        $waktuAntriM=Carbon::parse($skrg)->subMinutes($jedaM);
        $waktuAntriCS=Carbon::parse($skrg)->subMinutes($jedaCS);


        // $antrianK = DB::table('antrians')
        //     ->where('jenis_layanan', 'karantina')
        //     ->where('tanggal_antrian', '<', $skrg)
        //     ->where('tanggal_antrian', '>', $waktuAntri)
        //     ->where('tanggal_antrian', '>', $HariIni)
        //     ->orderBy('id', 'desc')
        //     ->pluck('no_antrian')
        //     ->first();

        // $antrianM = DB::table('antrians')
        //     ->where('jenis_layanan', 'mutu')
        //     ->where('tanggal_antrian', '<', $skrg)
        //     ->where('tanggal_antrian', '>', $waktuAntri)
        //     ->where('tanggal_antrian', '>', $HariIni)
        //     ->orderBy('id', 'desc')
        //     ->pluck('no_antrian')
        //     ->first();

        // $antrianCS = DB::table('antrians')
        //     ->where('jenis_layanan', 'cs')
        //     ->where('tanggal_antrian', '<', $skrg)
        //     ->where('tanggal_antrian', '>', $waktuAntri)
        //     ->where('tanggal_antrian', '>', $HariIni)
        //     ->orderBy('id', 'desc')
        //     ->pluck('no_antrian')
        //     ->first();

        $panggilK = DB::table('antrians')
            ->where('jenis_layanan', 'karantina')
            ->where('tanggal_antrian', '<', $skrg)
            ->where('tanggal_antrian', '>', $waktuAntri)
            ->where('tanggal_antrian', '>', $HariIni)
            ->orderBy('id', 'desc')
            ->select('no_antrian', 'no_ppk', 'tanggal_antrian')
            ->first();

        $panggilM = DB::table('antrians')
            ->where('jenis_layanan', 'mutu')
            ->where('tanggal_antrian', '<', $skrg)
            ->where('tanggal_antrian', '>', $waktuAntri)
            ->where('tanggal_antrian', '>', $HariIni)
            ->orderBy('id', 'desc')
            ->select('no_antrian', 'no_ppk', 'tanggal_antrian')
            ->first();

        $panggilCS = DB::table('antrians')
            ->where('jenis_layanan', 'cs')
            ->where('tanggal_antrian', '<', $skrg)
            ->where('tanggal_antrian', '>', $waktuAntri)
            ->where('tanggal_antrian', '>', $HariIni)
            ->orderBy('id', 'desc')
            ->select('no_antrian', 'no_ppk', 'tanggal_antrian')
            ->first();        

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
            
        $countK = $listK->count();
        $countM = $listM->count();
        $countCS = $listCS->count();

        if(isset($panggilK)){
            $countK++;
        }
        if(isset($panggilM)){
            $countM++;
        }
        if(isset($panggilCS)){
            $countCS++;
        }

        if(count($listK)>0){
            $antrianK = DB::table('antrians')
            ->where('jenis_layanan', 'karantina')
            ->where('tanggal_antrian', '<', $skrg)
            ->where('tanggal_antrian', '>', $HariIni)
            ->orderBy('id', 'desc')
            ->pluck('no_antrian')
            ->first();
        }else{
            $antrianK = DB::table('antrians')
            ->where('jenis_layanan', 'karantina')
            ->where('tanggal_antrian', '>', $waktuAntriK)
            ->orderBy('id', 'desc')
            ->pluck('no_antrian')
            ->first();
        }
        
        if(count($listM)>0){
            $antrianM = DB::table('antrians')
            ->where('jenis_layanan', 'mutu')
            ->where('tanggal_antrian', '<', $skrg)
            ->where('tanggal_antrian', '>', $HariIni)
            ->orderBy('id', 'desc')
            ->pluck('no_antrian')
            ->first();
        }else{
            $antrianM = DB::table('antrians')
            ->where('jenis_layanan', 'mutu')
            ->where('tanggal_antrian', '>', $waktuAntriM)
            ->orderBy('id', 'desc')
            ->pluck('no_antrian')
            ->first();
        }

        if(count($listCS)>0){
            $antrianCS = DB::table('antrians')
            ->where('jenis_layanan', 'cs')
            ->where('tanggal_antrian', '<', $skrg)
            ->where('tanggal_antrian', '>', $HariIni)
            ->orderBy('id', 'desc')
            ->pluck('no_antrian')
            ->first();
        }else{
            $antrianCS = DB::table('antrians')
            ->where('jenis_layanan', 'cs')
            ->where('tanggal_antrian', '>', $waktuAntriCS)
            ->orderBy('id', 'desc')
            ->pluck('no_antrian')
            ->first();
        }
        return view('dashboard.pengunjung', [
            "title" => "Dashboard",
            'active' => 'pengunjung',
            'antrianK'=> $antrianK,
            'antrianM'=> $antrianM,
            'antrianCS'=> $antrianCS,
            'listK'=> $listK,
            'listM'=> $listM,
            'listCS'=> $listCS,
            'panggilK'=> $panggilK,
            'panggilM'=> $panggilM,
            'panggilCS'=> $panggilCS,
            'countK'=> $countK,
            'countM'=> $countM,
            'countCS'=> $countCS,
        ]);
    }

    public function dash_opk()
    {
        $HariIni = Carbon::now()->addHours(7)->startOfDay();
        $skrg = Carbon::now()->addHours(7);
        $jedaK = DB::table('waktus')
        ->where('jenis_layanan','karantina')
        ->pluck('jeda')
        ->first();
        $waktuAntriK=Carbon::parse($skrg)->subMinutes($jedaK);

        $antrianK = DB::table('antrians')
            ->where('jenis_layanan', 'karantina')
            ->where('tanggal_antrian', '>', $HariIni)
            ->select('no_antrian', 'no_ppk', 'tanggal_antrian', 'email', 'status')
            ->get();
        $jumlahK = count($antrianK);

        $nextantriK = DB::table('antrians')
        ->where('jenis_layanan', 'karantina')
        ->where('tanggal_antrian', '>', $skrg)
        ->orderBy('id', 'asc')
        ->pluck('no_antrian')
        ->first();

        if(isset($nextantriK)){
            $panggilK = DB::table('antrians')
            ->where('jenis_layanan', 'karantina')
            ->where('tanggal_antrian', '<', $skrg)
            ->where('tanggal_antrian', '>', $HariIni)
            ->orderBy('id', 'desc')
            ->pluck('no_antrian')
            ->first();
        }else{
            $panggilK = DB::table('antrians')
            ->where('jenis_layanan', 'karantina')
            ->where('tanggal_antrian', '>', $waktuAntriK)
            ->orderBy('id', 'desc')
            ->pluck('no_antrian')
            ->first();
        }

        $antrisisaK = DB::table('antrians')
        ->where('jenis_layanan', 'karantina')
        ->where('tanggal_antrian', '>', $skrg)
        ->select('no_antrian', 'no_ppk', 'tanggal_antrian', 'email', 'status')
        ->get();
        $sisaK = count($antrisisaK);

        return view('dashboard.operator.karantina', [
            'title' => 'Dashboard',
            'active' => 'operator',
            'jumlahK' => $jumlahK,
            'panggilK' => $panggilK,
            'nextantriK' => $nextantriK,
            'antrisisaK' => $antrisisaK,
            'sisaK' => $sisaK,
        ]);
    }
    public function dash_opm()
    {
        $HariIni = Carbon::now()->addHours(7)->startOfDay();
        $skrg = Carbon::now()->addHours(7);
        $jedaM = DB::table('waktus')
        ->where('jenis_layanan','mutu')
        ->pluck('jeda')
        ->first();
        $waktuAntriM=Carbon::parse($skrg)->subMinutes($jedaM);

        $antrianM = DB::table('antrians')
            ->where('jenis_layanan', 'mutu')
            ->where('tanggal_antrian', '>', $HariIni)
            ->select('no_antrian', 'no_ppk', 'tanggal_antrian', 'email', 'status')
            ->get();
        $jumlahM = count($antrianM);

        $nextantriM = DB::table('antrians')
        ->where('jenis_layanan', 'mutu')
        ->where('tanggal_antrian', '>', $skrg)
        ->orderBy('id', 'asc')
        ->pluck('no_antrian')
        ->first();

        if(isset($nextantriM)){
            $panggilM = DB::table('antrians')
            ->where('jenis_layanan', 'mutu')
            ->where('tanggal_antrian', '<', $skrg)
            ->where('tanggal_antrian', '>', $HariIni)
            ->orderBy('id', 'desc')
            ->pluck('no_antrian')
            ->first();
        }else{
            $panggilM = DB::table('antrians')
            ->where('jenis_layanan', 'mutu')
            ->where('tanggal_antrian', '>', $waktuAntriM)
            ->orderBy('id', 'desc')
            ->pluck('no_antrian')
            ->first();
        }

        $antrisisaM = DB::table('antrians')
        ->where('jenis_layanan', 'mutu')
        ->where('tanggal_antrian', '>', $skrg)
        ->select('no_antrian', 'no_ppk', 'tanggal_antrian', 'email', 'status')
        ->get();
        $sisaM = count($antrisisaM);

        return view('dashboard.operator.mutu', [
            'title' => 'Dashboard',
            'active' => 'operator',
            'jumlahM' => $jumlahM,
            'panggilM' => $panggilM,
            'nextantriM' => $nextantriM,
            'sisaM' => $sisaM,
        ]);
    }
    public function dash_ocs()
    {
        $HariIni = Carbon::now()->addHours(7)->startOfDay();
        $skrg = Carbon::now()->addHours(7);
        $jedaCS = DB::table('waktus')
        ->where('jenis_layanan','cs')
        ->pluck('jeda')
        ->first();
        $waktuAntriCS=Carbon::parse($skrg)->subMinutes($jedaCS);

        $antrianCS = DB::table('antrians')
            ->where('jenis_layanan', 'cs')
            ->where('tanggal_antrian', '>', $HariIni)
            ->select('no_antrian', 'no_ppk', 'tanggal_antrian', 'email', 'status')
            ->get();
        $jumlahCS = count($antrianCS);

        $nextantriCS = DB::table('antrians')
        ->where('jenis_layanan', 'cs')
        ->where('tanggal_antrian', '>', $skrg)
        ->orderBy('id', 'asc')
        ->pluck('no_antrian')
        ->first();

        if(isset($nextantriCS)){
            $panggilCS = DB::table('antrians')
            ->where('jenis_layanan', 'cs')
            ->where('tanggal_antrian', '<', $skrg)
            ->where('tanggal_antrian', '>', $HariIni)
            ->orderBy('id', 'desc')
            ->pluck('no_antrian')
            ->first();
        }else{
            $panggilCS = DB::table('antrians')
            ->where('jenis_layanan', 'mutu')
            ->where('tanggal_antrian', '>', $waktuAntriCS)
            ->orderBy('id', 'desc')
            ->pluck('no_antrian')
            ->first();
        }

        $antrisisaCS = DB::table('antrians')
        ->where('jenis_layanan', 'cs')
        ->where('tanggal_antrian', '>', $skrg)
        ->select('no_antrian', 'no_ppk', 'tanggal_antrian', 'email', 'status')
        ->get();
        $sisaCS = count($antrisisaCS);

        return view('dashboard.operator.cs', [
            'title' => 'Dashboard',
            'active' => 'operator',
            'jumlahCS' => $jumlahCS,
            'panggilCS' => $panggilCS,
            'nextantriCS' => $nextantriCS,
            'sisaCS' => $sisaCS,
        ]);
    }

    public function dash_admin()
    {
        $HariIni = Carbon::now()->addHours(7)->startOfDay();
        $skrg = Carbon::now()->addHours(7);
        $jedaK = DB::table('waktus')
        ->where('jenis_layanan','karantina')
        ->pluck('jeda')
        ->first();
        $waktuAntriK=Carbon::parse($skrg)->subMinutes($jedaK);

        $antrianK = DB::table('antrians')
            ->where('jenis_layanan', 'karantina')
            ->where('tanggal_antrian', '>', $HariIni)
            ->select('no_antrian', 'no_ppk', 'tanggal_antrian', 'email', 'status')
            ->get();
        $jumlahK = count($antrianK);

        $nextantriK = DB::table('antrians')
        ->where('jenis_layanan', 'karantina')
        ->where('tanggal_antrian', '>', $skrg)
        ->orderBy('id', 'asc')
        ->pluck('no_antrian')
        ->first();

        if(isset($nextantriK)){
            $panggilK = DB::table('antrians')
            ->where('jenis_layanan', 'karantina')
            ->where('tanggal_antrian', '<', $skrg)
            ->where('tanggal_antrian', '>', $HariIni)
            ->orderBy('id', 'desc')
            ->pluck('no_antrian')
            ->first();
        }else{
            $panggilK = DB::table('antrians')
            ->where('jenis_layanan', 'karantina')
            ->where('tanggal_antrian', '>', $waktuAntriK)
            ->orderBy('id', 'desc')
            ->pluck('no_antrian')
            ->first();
        }

        $antrisisaK = DB::table('antrians')
        ->where('jenis_layanan', 'karantina')
        ->where('tanggal_antrian', '>', $skrg)
        ->select('no_antrian', 'no_ppk', 'tanggal_antrian', 'email', 'status')
        ->get();
        $sisaK = count($antrisisaK);

        $jedaM = DB::table('waktus')
        ->where('jenis_layanan','mutu')
        ->pluck('jeda')
        ->first();
        $waktuAntriM=Carbon::parse($skrg)->subMinutes($jedaM);

        $antrianM = DB::table('antrians')
            ->where('jenis_layanan', 'mutu')
            ->where('tanggal_antrian', '>', $HariIni)
            ->select('no_antrian', 'no_ppk', 'tanggal_antrian', 'email', 'status')
            ->get();
        $jumlahM = count($antrianM);

        $nextantriM = DB::table('antrians')
        ->where('jenis_layanan', 'mutu')
        ->where('tanggal_antrian', '>', $skrg)
        ->orderBy('id', 'asc')
        ->pluck('no_antrian')
        ->first();

        if(isset($nextantriM)){
            $panggilM = DB::table('antrians')
            ->where('jenis_layanan', 'mutu')
            ->where('tanggal_antrian', '<', $skrg)
            ->where('tanggal_antrian', '>', $HariIni)
            ->orderBy('id', 'desc')
            ->pluck('no_antrian')
            ->first();
        }else{
            $panggilM = DB::table('antrians')
            ->where('jenis_layanan', 'mutu')
            ->where('tanggal_antrian', '>', $waktuAntriM)
            ->orderBy('id', 'desc')
            ->pluck('no_antrian')
            ->first();
        }

        $antrisisaM = DB::table('antrians')
        ->where('jenis_layanan', 'mutu')
        ->where('tanggal_antrian', '>', $skrg)
        ->select('no_antrian', 'no_ppk', 'tanggal_antrian', 'email', 'status')
        ->get();
        $sisaM = count($antrisisaM);

        $jedaCS = DB::table('waktus')
        ->where('jenis_layanan','cs')
        ->pluck('jeda')
        ->first();
        $waktuAntriCS=Carbon::parse($skrg)->subMinutes($jedaCS);

        $antrianCS = DB::table('antrians')
            ->where('jenis_layanan', 'cs')
            ->where('tanggal_antrian', '>', $HariIni)
            ->select('no_antrian', 'no_ppk', 'tanggal_antrian', 'email', 'status')
            ->get();
        $jumlahCS = count($antrianCS);

        $nextantriCS = DB::table('antrians')
        ->where('jenis_layanan', 'cs')
        ->where('tanggal_antrian', '>', $skrg)
        ->orderBy('id', 'asc')
        ->pluck('no_antrian')
        ->first();

        if(isset($nextantriCS)){
            $panggilCS = DB::table('antrians')
            ->where('jenis_layanan', 'cs')
            ->where('tanggal_antrian', '<', $skrg)
            ->where('tanggal_antrian', '>', $HariIni)
            ->orderBy('id', 'desc')
            ->pluck('no_antrian')
            ->first();
        }else{
            $panggilCS = DB::table('antrians')
            ->where('jenis_layanan', 'mutu')
            ->where('tanggal_antrian', '>', $waktuAntriCS)
            ->orderBy('id', 'desc')
            ->pluck('no_antrian')
            ->first();
        }

        $antrisisaCS = DB::table('antrians')
        ->where('jenis_layanan', 'cs')
        ->where('tanggal_antrian', '>', $skrg)
        ->select('no_antrian', 'no_ppk', 'tanggal_antrian', 'email', 'status')
        ->get();
        $sisaCS = count($antrisisaCS);

        return view('dashboard.admin', [
            'title' => 'Dashboard',
            'active' => 'admin',
            'jumlahK' => $jumlahK,
            'panggilK' => $panggilK,
            'nextantriK' => $nextantriK,
            'sisaK' => $sisaK,
            'jumlahM' => $jumlahM,
            'panggilM' => $panggilM,
            'nextantriM' => $nextantriM,
            'sisaM' => $sisaM,
            'jumlahCS' => $jumlahCS,
            'panggilCS' => $panggilCS,
            'nextantriCS' => $nextantriCS,
            'sisaCS' => $sisaCS,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\Antrian;
use Illuminate\Support\Facades\Auth;


class DaftarAntrianController extends Controller
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

        return view('antrian.daftarAntrian.pengunjung', [
            "title" => "Daftar Antrian",
            'active' => 'daftar antrian',
            'listK'=> $listK,
            'listM'=> $listM,
            'listCS'=> $listCS,
            'panggilK'=> $panggilK,
            'panggilM'=> $panggilM,
            'panggilCS'=> $panggilCS,
        ]);
    }

    public function da_opk()
    {
        $skrg = Carbon::now()->addHours(7);
        $AntrianK = DB::table('antrians')
            ->where('tanggal_antrian', '>', $skrg)
            ->where('jenis_layanan', 'karantina')
            ->orderBy('id', 'asc')
            ->select('id', 'no_antrian', 'no_ppk', 'tanggal_antrian', 'email', 'status')
            ->get();

        $SudahAntriK = DB::table('antrians')
            ->where('tanggal_antrian', '<', $skrg)
            ->where('jenis_layanan', 'karantina')
            ->orderBy('id', 'desc')
            ->select('id', 'no_antrian', 'no_ppk', 'tanggal_antrian', 'email', 'status')
            ->get();
        

        return view('antrian.daftarAntrian.operatorKarantina', [
            'title' => 'Daftar Antrian',
            'active' => 'daftar antrian',
            'AntrianK' => $AntrianK,
            'SudahAntriK' => $SudahAntriK,

        ]);
    }
    public function da_opm()
    {
        $skrg = Carbon::now()->addHours(7);
        $AntrianM = DB::table('antrians')
            ->where('tanggal_antrian', '>', $skrg)
            ->where('jenis_layanan', 'mutu')
            ->orderBy('id', 'asc')
            ->select('id', 'no_antrian', 'no_ppk', 'tanggal_antrian', 'email', 'status')
            ->get();

        $SudahAntriM = DB::table('antrians')
            ->where('tanggal_antrian', '<', $skrg)
            ->where('jenis_layanan', 'mutu')
            ->orderBy('id', 'desc')
            ->select('id', 'no_antrian', 'no_ppk', 'tanggal_antrian', 'email', 'status')
            ->get();

        return view('antrian.daftarAntrian.operatorMutu', [
            'title' => 'Daftar Antrian',
            'active' => 'daftar antrian',
            'AntrianM' => $AntrianM,
            'SudahAntriM' => $SudahAntriM,

        ]);
    }
    public function da_ocs()
    {
        $skrg = Carbon::now()->addHours(7);
        $AntrianCS = DB::table('antrians')
            ->where('tanggal_antrian', '>', $skrg)
            ->where('jenis_layanan', 'cs')
            ->orderBy('id', 'asc')
            ->select('id', 'no_antrian', 'no_ppk', 'tanggal_antrian', 'email', 'status')
            ->get();

        $SudahAntriCS = DB::table('antrians')
            ->where('tanggal_antrian', '<', $skrg)
            ->where('jenis_layanan', 'cs')
            ->orderBy('id', 'desc')
            ->select('id', 'no_antrian', 'no_ppk', 'tanggal_antrian', 'email', 'status')
            ->get();

        return view('antrian.daftarAntrian.operatorCS', [
            'title' => 'Daftar Antrian',
            'active' => 'daftar antrian',
            'AntrianCS' => $AntrianCS,
            'SudahAntriCS' => $SudahAntriCS,

        ]);
    }
    public function da_admin()
    {
        $antrianK = DB::table('antrians')
            ->where('jenis_layanan', 'karantina')
            ->orderBy('id', 'desc')
            ->select('no_antrian', 'no_ppk', 'tanggal_antrian', 'email', 'status')
            ->get();
        $antrianM = DB::table('antrians')
            ->where('jenis_layanan', 'mutu')
            ->orderBy('id', 'desc')
            ->select('no_antrian', 'no_ppk', 'tanggal_antrian', 'email', 'status')
            ->get();
        $antrianCS = DB::table('antrians')
            ->where('jenis_layanan', 'cs')
            ->orderBy('id', 'desc')
            ->select('no_antrian', 'no_ppk', 'tanggal_antrian', 'email', 'status')
            ->get();

        return view('antrian.daftarAntrian.admin', [
            'title' => 'Daftar Antrian',
            'active' => 'daftar antrian',
            'antrianK' => $antrianK,
            'antrianM' => $antrianM,
            'antrianCS' => $antrianCS,
        ]);
    }

    public function statusDiproses($id)
    {
        $id = base64_decode($id);

        Antrian::where('id', $id)->update([
            "status"=>"Diproses"
        ]);
        return redirect('/daftar/antrian/karantina')->with('success');
    }

    public function statusRecall($id)
    {
        $id = base64_decode($id);

        Antrian::where('id', $id)->update([
            "status"=>"Recall"
        ]);
        return redirect('/daftar/antrian/karantina')->with('success');
    }

    public function statusCancel($id)
    {
        $id = base64_decode($id);

        Antrian::where('id', $id)->update([
            "status"=>"Cancel"
        ]);
        return redirect('/daftar/antrian/karantina')->with('success');
    }


    public function statusDiprosesM($id)
    {
        $id = base64_decode($id);

        Antrian::where('id', $id)->update([
            "status"=>"Diproses"
        ]);
        return redirect('/daftar/antrian/mutu')->with('success');
    }

    public function statusRecallM($id)
    {
        $id = base64_decode($id);

        Antrian::where('id', $id)->update([
            "status"=>"Recall"
        ]);
        return redirect('/daftar/antrian/mutu')->with('success');
    }

    public function statusCancelM($id)
    {
        $id = base64_decode($id);

        Antrian::where('id', $id)->update([
            "status"=>"Cancel"
        ]);
        return redirect('/daftar/antrian/mutu')->with('success');
    }

        public function statusDiprosesCS($id)
    {
        $id = base64_decode($id);

        Antrian::where('id', $id)->update([
            "status"=>"Diproses"
        ]);
        return redirect('/daftar/antrian/cs')->with('success');
    }

    public function statusRecallCS($id)
    {
        $id = base64_decode($id);

        Antrian::where('id', $id)->update([
            "status"=>"Recall"
        ]);
        return redirect('/daftar/antrian/cs')->with('success');
    }

    public function statusCancelCS($id)
    {
        $id = base64_decode($id);

        Antrian::where('id', $id)->update([
            "status"=>"Cancel"
        ]);
        return redirect('/daftar/antrian/cs')->with('success');
    }
}

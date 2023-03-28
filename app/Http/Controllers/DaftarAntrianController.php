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
        $skrgmin10 = Carbon::now()->addHours(7)->subMinutes(10);
        $AntrianK = DB::table('antrians')
            ->where('tanggal_antrian', '>', $skrgmin10)
            ->where('jenis_layanan', 'karantina')
            ->orderBy('id', 'asc')
            ->select('no_antrian', 'no_ppk', 'tanggal_antrian', 'email', 'status')
            ->get();

        $SudahAntriK = DB::table('antrians')
            ->where('tanggal_antrian', '<', $skrgmin10)
            ->where('jenis_layanan', 'karantina')
            ->orderBy('id', 'desc')
            ->select('no_antrian', 'no_ppk', 'tanggal_antrian', 'email', 'status')
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
        $skrgmin10 = Carbon::now()->addHours(7)->subMinutes(10);
        $AntrianM = DB::table('antrians')
            ->where('tanggal_antrian', '>', $skrgmin10)
            ->where('jenis_layanan', 'mutu')
            ->orderBy('id', 'asc')
            ->select('no_antrian', 'no_ppk', 'tanggal_antrian', 'email', 'status')
            ->get();

        $SudahAntriM = DB::table('antrians')
            ->where('tanggal_antrian', '<', $skrgmin10)
            ->where('jenis_layanan', 'mutu')
            ->orderBy('id', 'desc')
            ->select('no_antrian', 'no_ppk', 'tanggal_antrian', 'email', 'status')
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
        $skrgmin10 = Carbon::now()->addHours(7)->subMinutes(10);
        $AntrianCS = DB::table('antrians')
            ->where('tanggal_antrian', '>', $skrgmin10)
            ->where('jenis_layanan', 'cs')
            ->orderBy('id', 'asc')
            ->select('no_antrian', 'no_ppk', 'tanggal_antrian', 'email', 'status')
            ->get();

        $SudahAntriCS = DB::table('antrians')
            ->where('tanggal_antrian', '<', $skrgmin10)
            ->where('jenis_layanan', 'cs')
            ->orderBy('id', 'desc')
            ->select('no_antrian', 'no_ppk', 'tanggal_antrian', 'email', 'status')
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
        return view('antrian.daftarAntrian.admin', [
            'title' => 'Daftar Antrian',
            'active' => 'daftar antrian'
        ]);
    }

    // public function editStatus()
    // {
    //     $no_ppk = request()->segment(2);

    //     return view('antrian.editStatus', [
    //         "title" => "Edit Status",
    //         'active' => 'edit status',
    //         'no_ppk' => $no_ppk
    //     ]);
    // }
    // public function submitStatus(Request $request)
    // {
    //     Antrian::where('no_ppk', $request->no_ppk)->update([
    //         "status"=> $request->status,
    //     ]);
    //     return redirect('/daftar/antrian/karantina')->with('success');
    // }

    public function statusDiproses($no_ppk)
    {
        $no_ppk = base64_decode($no_ppk);

        Antrian::where('no_ppk', $no_ppk)->update([
            "status"=>"Diproses"
        ]);
        return redirect('/daftar/antrian/karantina')->with('success');
    }

    public function statusRecall($no_ppk)
    {
        $no_ppk = base64_decode($no_ppk);

        Antrian::where('no_ppk', $no_ppk)->update([
            "status"=>"Recall"
        ]);
        return redirect('/daftar/antrian/karantina')->with('success');
    }

    public function statusCancel($no_ppk)
    {
        $no_ppk = base64_decode($no_ppk);

        Antrian::where('no_ppk', $no_ppk)->update([
            "status"=>"Cancel"
        ]);
        return redirect('/daftar/antrian/karantina')->with('success');
    }


    public function statusDiprosesM()
    {
        $no_ppk = request()->segment(2);

        Antrian::where('no_ppk', $no_ppk)->update([
            "status"=>"Diproses"
        ]);
        return redirect('/daftar/antrian/mutu')->with('success');
    }

    public function statusRecallM()
    {
        $no_ppk = request()->segment(2);

        Antrian::where('no_ppk', $no_ppk)->update([
            "status"=>"Recall"
        ]);
        return redirect('/daftar/antrian/mutu')->with('success');
    }

    public function statusCancelM()
    {
        $no_ppk = request()->segment(2);

        Antrian::where('no_ppk', $no_ppk)->update([
            "status"=>"Cancel"
        ]);
        return redirect('/daftar/antrian/mutu')->with('success');
    }

        public function statusDiprosesCS()
    {
        $no_ppk = request()->segment(2);

        Antrian::where('no_ppk', $no_ppk)->update([
            "status"=>"Diproses"
        ]);
        return redirect('/daftar/antrian/cs')->with('success');
    }

    public function statusRecallCS()
    {
        $no_ppk = request()->segment(2);

        Antrian::where('no_ppk', $no_ppk)->update([
            "status"=>"Recall"
        ]);
        return redirect('/daftar/antrian/cs')->with('success');
    }

    public function statusCancelCS()
    {
        $no_ppk = request()->segment(2);

        Antrian::where('no_ppk', $no_ppk)->update([
            "status"=>"Cancel"
        ]);
        return redirect('/daftar/antrian/cs')->with('success');
    }
}

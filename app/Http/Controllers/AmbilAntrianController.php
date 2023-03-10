<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AntriansController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\Antrian;
use Illuminate\Validation\Rule;

class AmbilAntrianController extends Controller
{
    public function index()
    {
        $email=session('email');
        $skrgmin10 = Carbon::now()->addHours(7)->subMinutes(10);
        $Antrianku = DB::table('antrians')
            ->where('tanggal_antrian', '>', $skrgmin10)
            ->where('email', $email)
            ->orderBy('id', 'asc')
            ->select('no_antrian', 'no_ppk', 'tanggal_antrian')
            ->get();

        return view('antrian.ambilAntrian', [
            "title" => "Ambil Antrian",
            'active' => 'antrian',
            'antrianku' => $Antrianku
        ]);
    }

    public function ambil(Request $request){
        //$antrian = new AntriansController();
        $email=session('email');

        $messages = [
            'required' => ':attribute wajib diisi ',
            'no_ppk.required' => 'Nomor Pengajuan PPK harus diisi!',
            'jenislayanan.required' => 'Pilih Jenis Layanan!',
            'jenislayanan.not_in' => 'Pilih Jenis Layanan!',
            'no_ppk.unique' => 'Nomor Pengajuan PPK sudah digunakan'
        ];

        $this->validate($request, [
            "no_ppk" => 'required|unique:antrians',
            'jenislayanan' => ['required', Rule::notIn(['Pilih Jenis Layanan!'])],
        ], $messages);

        $skrg = Carbon::now()->addHours(7);
        $HariIni = Carbon::now()->addHours(7)->startOfDay();

        $waktuK = DB::table('antrians')
            ->where('jenis_layanan', 'karantina')
            ->orderBy('id', 'desc')
            ->pluck('tanggal_antrian')
            ->first();
        $waktuK10 = Carbon::parse($waktuK)->addMinutes(10);

        $waktuM = DB::table('antrians')
            ->where('jenis_layanan', 'mutu')
            ->orderBy('id', 'desc')
            ->pluck('tanggal_antrian')
            ->first();
        $waktuM10 = Carbon::parse($waktuM)->addMinutes(10);

        $waktuCS = DB::table('antrians')
            ->where('jenis_layanan', 'cs')
            ->orderBy('id', 'desc')
            ->pluck('tanggal_antrian')
            ->first();
        $waktuCS10 = Carbon::parse($waktuCS)->addMinutes(10);

        $antriK = DB::table('antrians')
            ->where('jenis_layanan', 'karantina')
            ->where('tanggal_antrian', '>', $HariIni)
            ->orderBy('id', 'desc')
            ->pluck('no_antrian')
            ->first();

        $antriM = DB::table('antrians')
            ->where('jenis_layanan', 'mutu')
            ->where('tanggal_antrian', '>', $HariIni)
            ->orderBy('id', 'desc')
            ->pluck('no_antrian')
            ->first();

        $antriCS = DB::table('antrians')
            ->where('jenis_layanan', 'cs')
            ->where('tanggal_antrian', '>', $HariIni)
            ->orderBy('id', 'desc')
            ->pluck('no_antrian')
            ->first();

        if ($request->jenislayanan == 'karantina'){
            if(isset($antriK)) {
                $awalanK = substr($antriK, 0, 1); // Mengambil karakter awalan 'K'
                $nomorK = substr($antriK, 1); // Mengambil nomor
                $nomorK++; // Melakukan increment pada nomor
                $no_antriK = $awalanK . $nomorK; // Menggabungkan kembali karakter awalan dan nomor yang sudah di-increment
            } else {
                $no_antriK = 'K1';
            }
            if ($skrg->greaterThan($waktuK10)){
                $inputwaktuK=$skrg;
            }
            else{
                $inputwaktuK=$waktuK10;
            }
            Antrian::insert([
                'no_antrian' => $no_antriK,
                'email' => $email,
                'no_ppk' => $request->no_ppk,
                'jenis_layanan'=> $request->jenislayanan,
                "tanggal_antrian"=> $inputwaktuK,
                "created_at"=> $skrg,
                'status'=>'Menunggu'
            ]);
        }
        elseif ($request->jenislayanan == 'mutu'){
            if(isset($antriM)) {
                $awalanM = substr($antriM, 0, 1); // Mengambil karakter awalan 'M'
                $nomorM = substr($antriM, 1); // Mengambil nomor
                $nomorM++; // Melakukan increment pada nomor
                $no_antriM = $awalanM . $nomorM; // Menggabungkan kembali karakter awalan dan nomor yang sudah di-increment
            } else {
                $no_antriM = 'M1';
            }
            if ($skrg->greaterThan($waktuM10)){
                $inputwaktuM=$skrg;
            }
            else{
                $inputwaktuM=$waktuM10;
            }
            Antrian::insert([
                'no_antrian' => $no_antriM,
                'email' => $email,
                'no_ppk' => $request->no_ppk,
                'jenis_layanan'=> $request->jenislayanan,
                "tanggal_antrian" => $inputwaktuM,
                "created_at"=> $skrg,
                'status'=>'Menunggu'
            ]);
        }
        else{
            if(isset($antriCS)) {
                $awalanCS = substr($antriCS, 0, 1); // Mengambil karakter awalan 'CS'
                $nomorCS = substr($antriCS, 1); // Mengambil nomor
                $nomorCS++; // Melakukan increment pada nomor
                $no_antriCS = $awalanCS . $nomorCS; // Menggabungkan kembali karakter awalan dan nomor yang sudah di-increment
            } else {
                $no_antriCS = 'C1';
            }
            if ($skrg->greaterThan($waktuCS10)){
                $inputwaktuCS=$skrg;
            }
            else{
                $inputwaktuCS=$waktuCS10;
            }       
            Antrian::insert([
                'no_antrian' => $no_antriCS,
                'email' => $email,
                'no_ppk' => $request->no_ppk,
                'jenis_layanan'=> $request->jenislayanan,
                "tanggal_antrian" => $inputwaktuCS,
                "created_at"=> $skrg,
                'status'=>'Menunggu'
            ]);
        }
        return redirect('/ambil/antrian')->with('success');
    }
    public function tampil(Request $request){
        
        $skrg = Carbon::now()->addHours(7);
        $HariIni = Carbon::now()->addHours(7)->startOfDay();

        $antrianK = DB::table('antrians')
            ->where('jenis_layanan', 'karantina')
            ->where('tanggal_antrian', '<', $skrg)
            ->where('tanggal_antrian', '>', $HariIni)
            ->orderBy('id', 'desc')
            ->pluck('no_antrian')
            ->first();
            
        $antrianM = DB::table('antrians')
            ->where('jenis_layanan', 'mutu')
            ->where('tanggal_antrian', '<', $skrg)
            ->where('tanggal_antrian', '>', $HariIni)
            ->orderBy('id', 'desc')
            ->pluck('no_antrian')
            ->first();

        $antrianCS = DB::table('antrians')
            ->where('jenis_layanan', 'cs')
            ->where('tanggal_antrian', '<', $skrg)
            ->where('tanggal_antrian', '>', $HariIni)
            ->orderBy('id', 'desc')
            ->pluck('no_antrian')
            ->first();

        $panggilK = DB::table('antrians')
            ->where('jenis_layanan', 'karantina')
            ->where('tanggal_antrian', '<', $skrg)
            ->where('tanggal_antrian', '>', $HariIni)
            ->orderBy('id', 'desc')
            ->select('no_antrian', 'no_ppk', 'tanggal_antrian')
            ->first();

        $panggilM = DB::table('antrians')
            ->where('jenis_layanan', 'mutu')
            ->where('tanggal_antrian', '<', $skrg)
            ->where('tanggal_antrian', '>', $HariIni)
            ->orderBy('id', 'desc')
            ->select('no_antrian', 'no_ppk', 'tanggal_antrian')
            ->first();

        $panggilCS = DB::table('antrians')
            ->where('jenis_layanan', 'cs')
            ->where('tanggal_antrian', '<', $skrg)
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

        return view('antrian.ambilAntrian', [
            "title" => "Ambil Antrian",
            'active' => 'ambil antrian',
            'antrianK'=> $antrianK,
            'antrianM'=> $antrianM,
            'antrianCS'=> $antrianCS,
            'listK'=> $listK,
            'listM'=> $listM,
            'listCS'=> $listCS,
            'panggilK'=> $panggilK,
            'panggilM'=> $panggilM,
            'panggilCS'=> $panggilCS,
        ]);
    }

    public function cetakAntrian()
    {

        $no_ppk = request()->segment(2);

        $cetak = DB::table('antrians')
        ->where('no_ppk', '=', $no_ppk)
        ->select('no_antrian', 'no_ppk', 'jenis_layanan', 'tanggal_antrian', 'email')
        ->get();

        return view('antrian.cetakAntrian', [
            "title" => "Cetak Antrian",
            'active' => 'cetak antrian',
            'cetak' => $cetak
        ]);
    }

    public function editAntrian()
    {
        $no_ppk = request()->segment(2);

        return view('antrian.editAntrian', [
            "title" => "Edit Antrian",
            'active' => 'edit antrian',
            'no_ppk' => $no_ppk
        ]);
    }

    public function edit(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diisi ',
            'no_ppk.required' => 'Nomor Pengajuan PPK harus diisi!',
            'no_ppk.unique' => 'Nomor Pengajuan PPK sudah digunakan'
        ];

        $this->validate($request, [
            "no_ppk" => 'required|unique:antrians',
        ], $messages);

        Antrian::where('no_ppk', $request->no_ppklama)->update([
            "no_ppk"=> $request->no_ppk,
        ]);
        return redirect('/ambil/antrian')->with('success');
    }

    public function hapusAntrian(Request $request)
    {
        $no_ppk = request()->segment(2);
        $skrg = Carbon::now()->addHours(7);
        $layanan = DB::table('antrians')
            ->where('no_ppk', $no_ppk)
            ->pluck('jenis_layanan')
            ->first();

        Antrian::where('jenis_layanan', $layanan)
        ->where('tanggal_antrian', '>', $skrg)
        ->update([
             'tanggal_antrian' => DB::raw("DATEADD(minute, -10, CONVERT(datetime, tanggal_antrian, 121))"),
             'updated_at' => Carbon::now()
         ]);

        Antrian::where('no_ppk', $no_ppk)->delete();

        return redirect('/ambil/antrian')->with('success');
    }
    
}

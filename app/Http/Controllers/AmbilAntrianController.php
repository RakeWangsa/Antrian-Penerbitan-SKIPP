<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AntriansController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\Antrian;
use App\Models\Waktu;
use Illuminate\Validation\Rule;

class AmbilAntrianController extends Controller
{
    public function index()
    {
        $email=session('email');
        $skrg = Carbon::now()->addHours(7);
        $skrgmin10 = Carbon::now()->addHours(7)->subMinutes(10);
        $Antrianku = DB::table('antrians')
            ->where('tanggal_antrian', '>', $skrgmin10)
            ->where('tanggal_antrian', '<', $skrg)
            ->where('email', $email)
            ->orderBy('id', 'asc')
            ->select('id','no_antrian', 'no_ppk', 'tanggal_antrian','jenis_layanan')
            ->get();
        $Antrianku2 = DB::table('antrians')
            ->where('tanggal_antrian', '>', $skrg)
            ->where('email', $email)
            ->orderBy('id', 'asc')
            ->select('id','no_antrian', 'no_ppk', 'tanggal_antrian','jenis_layanan')
            ->get();
        $PPK = DB::table('v_data_header')
            ->select('no_ppk')
            ->get();

        return view('antrian.ambilAntrian', [
            "title" => "Ambil Antrian",
            'active' => 'antrian',
            'antrianku' => $Antrianku,
            'antrianku2' => $Antrianku2,
            'PPK' => $PPK,
        ]);
    }

    public function ambil(Request $request){
        $email=session('email');
        $PPK = DB::table('v_data_header')->pluck('no_ppk')->toArray();
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

        if($request->jenislayanan!='cs'){
            $messages = [
                'required' => ':attribute wajib diisi ',
                'no_ppk.required' => 'Nomor Pengajuan PPK harus diisi!',
                'jenislayanan.required' => 'Pilih Jenis Layanan!',
                'jenislayanan.not_in' => 'Pilih Jenis Layanan!',
                'no_ppk.unique' => 'Nomor Pengajuan PPK sudah digunakan',
                'no_ppk.in' => 'Nomor Pengajuan PPK tidak valid!',
            ];
    
            $this->validate($request, [
                "no_ppk" => [
                    'required',
                    Rule::in($PPK),
                    Rule::unique('antrians', 'no_ppk')
                ],
                'jenislayanan' => ['required', Rule::notIn(['Pilih Jenis Layanan!'])],
            ], $messages);
        }else{
            $messages = [
                'required' => ':attribute wajib diisi ',
                'jenislayanan.required' => 'Pilih Jenis Layanan!',
                'jenislayanan.not_in' => 'Pilih Jenis Layanan!',
            ];
    
            $this->validate($request, [
                'jenislayanan' => ['required', Rule::notIn(['Pilih Jenis Layanan!'])],
            ], $messages);
        }
        

        $skrg = Carbon::now()->addHours(7);
        $HariIni = Carbon::now()->addHours(7)->startOfDay();

        $waktuK = DB::table('antrians')
            ->where('jenis_layanan', 'karantina')
            ->orderBy('id', 'desc')
            ->pluck('tanggal_antrian')
            ->first();
        $waktuK10 = Carbon::parse($waktuK)->addMinutes($jedaK);

        $waktuM = DB::table('antrians')
            ->where('jenis_layanan', 'mutu')
            ->orderBy('id', 'desc')
            ->pluck('tanggal_antrian')
            ->first();
        $waktuM10 = Carbon::parse($waktuM)->addMinutes($jedaM);

        $waktuCS = DB::table('antrians')
            ->where('jenis_layanan', 'cs')
            ->orderBy('id', 'desc')
            ->pluck('tanggal_antrian')
            ->first();
        $waktuCS10 = Carbon::parse($waktuCS)->addMinutes($jedaCS);

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
                'no_ppk' => '-',
                'jenis_layanan'=> $request->jenislayanan,
                "tanggal_antrian" => $inputwaktuCS,
                "created_at"=> $skrg,
                'status'=>'Menunggu'
            ]);
        }
        return redirect('/ambil/antrian')->with('success');
    }

    public function cetakAntrian($id)
    {

        $id = base64_decode($id);

        $cetak = DB::table('antrians')
        ->where('id', '=', $id)
        ->select('no_antrian', 'no_ppk', 'jenis_layanan', 'tanggal_antrian', 'email')
        ->get();

        return view('antrian.cetakAntrian', [
            "title" => "Cetak Antrian",
            'active' => 'cetak antrian',
            'cetak' => $cetak
        ]);
    }

    public function editAntrian($no_ppk)
    {
        $no_ppk = base64_decode($no_ppk);
        $PPK = DB::table('v_data_header')
            ->select('no_ppk')
            ->get();
        return view('antrian.editAntrian', [
            "title" => "Edit Antrian",
            'active' => 'edit antrian',
            'no_ppk' => $no_ppk,
            'PPK' => $PPK
        ]);
    }

    public function edit(Request $request)
    {
        $PPK = DB::table('v_data_header')->pluck('no_ppk')->toArray();
        $messages = [
            'required' => ':attribute wajib diisi ',
            'no_ppk.required' => 'Nomor Pengajuan PPK harus diisi!',
            'no_ppk.unique' => 'Nomor Pengajuan PPK sudah digunakan',
            'no_ppk.in' => 'Nomor Pengajuan PPK tidak valid!',
        ];

        $this->validate($request, [
            "no_ppk" => [
                'required',
                Rule::in($PPK),
                Rule::unique('antrians', 'no_ppk')
            ],
        ], $messages);

        Antrian::where('no_ppk', $request->no_ppklama)->update([
            "no_ppk"=> $request->no_ppk,
        ]);
        return redirect('/ambil/antrian')->with('success');
    }


    // public function hapusAntrian($id)
    // {
    //     $id = base64_decode($id);
    //     $skrg = Carbon::now()->addHours(7);
    //     $layanan = DB::table('antrians')
    //         ->where('id', $id)
    //         ->pluck('jenis_layanan')
    //         ->first();

    //     $antrianSkrg = DB::table('antrians')
    //                 ->where('tanggal_antrian', '<', $skrg)
    //                 ->where('jenis_layanan', $layanan)
    //                 ->orderBy('tanggal_antrian','desc')
    //                 ->pluck('tanggal_antrian')
    //                 ->first();

    //     $antrians = DB::table('antrians')
    //                 ->where('tanggal_antrian', '>', $antrianSkrg)
    //                 ->where('jenis_layanan', $layanan)
    //                 ->orderBy('tanggal_antrian')
    //                 ->get();

    //     $jumlah = count($antrians);

    //     for ($i = 0; $i < $jumlah; $i++) {
    //         if ($i == 0) {
    //             Antrian::where('id', $antrians[$i]->id)
    //                 ->update([
    //                     'tanggal_antrian' => $antrianSkrg,
    //                     'updated_at' => Carbon::now()
    //                 ]);
    //         } else {
    //             $prevTime = $antrians[$i - 1]->tanggal_antrian;
    //             Antrian::where('id', $antrians[$i]->id)
    //                 ->update([
    //                     'tanggal_antrian' => $prevTime,
    //                     'updated_at' => Carbon::now()
    //                 ]);
    //         }
    //     }

    //     Antrian::where('id', $id)->delete();

    //     return redirect('/ambil/antrian')->with('success');
    // }

    public function hapusAntrian($id)
    {
        $id = base64_decode($id);
        $skrg = Carbon::now()->addHours(7);
        $layanan = DB::table('antrians')
            ->where('id', $id)
            ->pluck('jenis_layanan')
            ->first();

        $antrianIni = DB::table('antrians')
                    ->where('id', $id)
                    ->pluck('tanggal_antrian')
                    ->first();

        $antrians = DB::table('antrians')
                    ->where('tanggal_antrian', '>', $antrianIni)
                    ->where('jenis_layanan', $layanan)
                    ->orderBy('tanggal_antrian')
                    ->get();

        $jumlah = count($antrians);

        for ($i = 0; $i < $jumlah; $i++) {
            if ($i == 0) {
                Antrian::where('id', $antrians[$i]->id)
                    ->update([
                        'tanggal_antrian' => $antrianIni,
                        'updated_at' => Carbon::now()
                    ]);
            } else {
                $prevTime = $antrians[$i - 1]->tanggal_antrian;
                Antrian::where('id', $antrians[$i]->id)
                    ->update([
                        'tanggal_antrian' => $prevTime,
                        'updated_at' => Carbon::now()
                    ]);
            }
        }

        Antrian::where('id', $id)->delete();

        return redirect('/ambil/antrian')->with('success');
    }





    public function setting()
    {
        $jedaK = DB::table('waktus')
            ->where('jenis_layanan', 'karantina')
            ->pluck('jeda')
            ->first();
        $jedaM = DB::table('waktus')
            ->where('jenis_layanan', 'mutu')
            ->pluck('jeda')
            ->first();
        $jedaCS = DB::table('waktus')
            ->where('jenis_layanan', 'cs')
            ->pluck('jeda')
            ->first();
            
        return view('antrian.settingAntrian', [
            "title" => "Setting",
            'active' => 'setting',
            'jedaK' => $jedaK,
            'jedaM' => $jedaM,
            'jedaCS' => $jedaCS,

        ]);
    }
    
    public function saveSetting(Request $request)
    {
        Waktu::where('jenis_layanan', 'karantina')->update([
            "jeda"=> $request->jedaK,
        ]);
        Waktu::where('jenis_layanan', 'mutu')->update([
            "jeda"=> $request->jedaM,
        ]);
        Waktu::where('jenis_layanan', 'cs')->update([
            "jeda"=> $request->jedaCS,
        ]);
        return redirect('/setting/admin');
    }

}

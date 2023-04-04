<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

    public function tambah(Request $request)
    {
        $operator = request()->segment(2);
        return view('register.tambahOperator', [
            'title' => 'Tambah Operator',
            'active' => 'tambah operator',
            'operator' => $operator
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255'
        ]);
        $validatedData['level'] = $request->level;
        //$validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        //$request->session()->flash('success', 'Registration successfully! Please login!');

        return redirect('/login')->with('success', 'Registrasi Berhasil! Silahkan Login!');
    }

}

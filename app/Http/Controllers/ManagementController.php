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
        ->select('id', 'name', 'email')
        ->get();
        $opk = DB::table('Users')
        ->where('level','opk')
        ->select('id', 'name', 'email')
        ->get();
        $opm = DB::table('Users')
        ->where('level','opm')
        ->select('id', 'name', 'email')
        ->get();
        $ocs = DB::table('Users')
        ->where('level','ocs')
        ->select('id', 'name', 'email')
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

        return redirect('/managementUser')->with('success', 'Registrasi Berhasil!');
    }

    public function editUser($id)
    {
        $id = base64_decode($id);
        $user = DB::table('Users')
        ->where('id',$id)
        ->select('id', 'name', 'email')
        ->get();
        return view('managementUser.editUser', [
            "title" => "Edit User",
            'active' => 'edit user',
            'user' => $user,
            'id' => $id
        ]);
    }

    public function updateUser(Request $request, $id)
    {
        $id = base64_decode($id);
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|email:dns|unique:users,email,'.$id,
            'password' => 'nullable|min:5|max:255'
        ]);

        $user = User::findOrFail($id);

        $user->name = $validatedData['nama'];
        $user->email = $validatedData['email'];

        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

        $user->save();

        return redirect('/managementUser')->with('success', 'Data user berhasil diupdate!');
    }


    public function hapusUser($id)
    {
        $id = base64_decode($id);
        User::where('id', $id)->delete();

        return redirect('/managementUser')->with('success');
    }

}

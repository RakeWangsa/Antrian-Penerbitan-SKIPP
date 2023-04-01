<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            'title' => 'Login'
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        
        $email=$request->email;
        $level = DB::table('users')
        ->where('email', $email)
        ->pluck('level')
        ->first();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            session(['email' => $email]);
            if($level=='admin'){
                return redirect('/dashboard/admin');
            }else if($level=='opk'){
                return redirect('/dashboard/operator/karantina');
            }else if($level=='opm'){
                return redirect('/dashboard/operator/mutu');
            }else if($level=='ocs'){
                return redirect('/dashboard/operator/cs');
            }else{
                return redirect('/dashboard');
            }
            
        }
 
        return back()->with('loginError','Login failed!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/dashboard');
    }
}

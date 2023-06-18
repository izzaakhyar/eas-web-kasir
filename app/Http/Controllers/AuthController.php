<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class AuthController extends Controller
{
    public function daftar() {
        return view('auth.registration');
    }
    
    public function registrasi(Request $request) {
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $imageName = $image->getClientOriginalName();
            $imagePath = $image->move(public_path('storage/products'), $imageName);
            $image_url = basename($imagePath);
        } else {
            $imageName = null; // Atau Anda bisa menetapkan nilai default untuk gambar jika tidak ada yang diunggah
        }
        $user = DB::table('users')->get();
        $password = bcrypt($request->password);
        
        DB::table('users')->insert([
            'name'=>$request->name,
            'password'=>$password,
            'email'=>$request->email,
            'avatar' => $image_url,
        ]);

        return redirect('/');
    }

    public function login() {
        return view('auth.login');
    }
    
    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/list');
        }

        return back()->with('loginError', 'Login Failed');
    }

    public function logout(Request $request) {
        Auth::logout();
 
        $request->session()->invalidate();
 
        $request->session()->regenerateToken();
 
        return redirect('/');
    }
}

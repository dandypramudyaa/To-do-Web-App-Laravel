<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;
use App\User;

class LoginController extends Controller
{
    public function getLogin()
    {
        return view('auth/login');
    }

    public function loginCheck(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->firstOrFail();
        // dd($users);

        if ($user->email == $email and Hash::check($password, $user->password)) {
            // Session::put('login', 'Selamat anda berhasil login');
            session(['id' => $user->id_user]);
            return redirect('/dashboard');
        } else {
            // Session::flash('sukses', 'Login failed');
            $request->session()->put('pesan', 'Login failed');
            return redirect('/');
        }
    }

    public function getRegister()
    {
        return view('auth/register');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password1' => 'min:5|required_with:password2',
            'password2' => 'min:5|same:password2'
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        // $password = password_hash($request->input('password'), PASSWORD_DEFAULT);
        $password = Hash::make($request->input('password1'));

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);

        return redirect('/');
    }

    public function logout()
    {
        session()->forget('id');
        return redirect('/');
    }
}

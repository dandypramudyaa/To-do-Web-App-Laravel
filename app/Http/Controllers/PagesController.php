<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class PagesController extends Controller
{
    public function index()
    {
        $id = session()->get('id');
        $user = User::where('id_user', $id)->firstOrFail();

        if (session()->has('id')) {
            return view('pages/index', ['user' => $user]);
        } else {
            return redirect('/');
        }
    }
}

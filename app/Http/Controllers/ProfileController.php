<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $id = session()->get('id');
        $user = User::where('id_user', $id)->firstOrFail();

        if (session()->has('id')) {
            return view('profile/index', ['user' => $user]);
        } else {
            return redirect('/');
        }
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $id = session()->get('id');

        User::where('id_user', $id)
            ->update(['name' => $request->name]);

        return redirect('/profile')->with('status', 'Successfully updated!');
    }

    public function indexPassword()
    {
        $id = session()->get('id');
        $user = User::where('id_user', $id)->firstOrFail();

        if (session()->has('id')) {
            return view('profile/password', ['user' => $user]);
        } else {
            return redirect('/');
        }
    }

    public function updatePassword(Request $request)
    {
        $id = session()->get('id');
        $user = User::where('id_user', $id)->firstOrFail();

        $this->validate($request, [
            'old' => 'required',
            'new' => 'min:5',
            'new1' => 'min:5'
        ]);
        $old = $request->old;
        $new = $request->new;
        $new1 = $request->new1;

        if (!Hash::check($old, $user->password)) {
            return redirect('/changepassword')->with('error', 'Your old password is wrong!');
        } elseif ($new != $new1) {
            return redirect('/changepassword')->with('error', 'New password and retype password must be the same!');
        } else {
            $password = Hash::make($new);
            User::where('id_user', $id)
                ->update(['password' => $password]);

            return redirect('/changepassword')->with('status', 'Successfully updated!');
        }
    }
}

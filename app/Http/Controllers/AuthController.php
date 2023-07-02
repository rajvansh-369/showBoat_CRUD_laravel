<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginView()
    {

        if (auth()->user()) {

            return redirect()->back();
        }

        return view('auth.login');
    }



    public function login(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $checkEmail = User::where('email', $request->email)->first();

        if (!$checkEmail) {
            return redirect()->back()->with('error', 'Email does not match. Please register.');
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();

            return redirect(route('adminIndex'));
        } else {

            // dd("asdasd");
            return redirect()->back()->with('error', 'Invalid email or password.');
        }
    }



    public function logout()
    {

        session()->flush();
        Auth::logout();
        return redirect('/');
    }


    public function registerView()
    {

        if (auth()->user()) {

            return redirect()->back();
        }

        return view('auth.register');
    }
}

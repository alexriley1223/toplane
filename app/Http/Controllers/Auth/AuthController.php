<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        if (!Auth::check()) {
          return view('auth.login');
        } else {
          return redirect('/');
        }
    }

    public function registration()
    {
        if (!Auth::check()) {
          return view('auth.register');
        } else {
          return redirect('/');
        }
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function create(Request $request)
    {
      $user = User::create([
        'name' => $request->username,
        'email' => $request->email,
        'password' => Hash::make($request->password)
      ]);

      return redirect('/');
    }

    public function logout() {
        Session::flush();
        Auth::logout();

        return redirect('/auth/login');
    }
}

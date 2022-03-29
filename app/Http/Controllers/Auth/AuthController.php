<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

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
      $credentials = $request->validate([
        'email'     => ['required', 'email', 'unique:users,email'],
        'username'  => ['required', 'max:20', 'unique:users,name'],
        'password'  => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
      ]);

      $user = new User;

      $user->name = $request->username;
      $user->email = $request->email;
      $user->password = Hash::make($request->password);

      $user->save();

      return redirect('/');
    }

    public function logout() {
        Session::flush();
        Auth::logout();

        return redirect('/auth/login');
    }
}

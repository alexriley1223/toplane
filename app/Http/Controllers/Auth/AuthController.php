<?php
namespace App\Http\Controllers\Auth;

use Hash;
use Session;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;
use App\Models\User;

class AuthController extends Controller
{
    public function login()
    {
      return view('auth.login');
    }

    public function registration()
    {
      return view('auth.register');
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
        'username'  => ['required', 'regex:/^[0-9\p{L} _.]+$/', 'max:20', 'unique:users,name'],
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

    public function forgotView() {
      return view('auth.forgot');
    }

    public function forgotPost(Request $request) {
      $request->validate([
        'email' => ['required', 'email']
      ]);

      $status = \Illuminate\Support\Facades\Password::sendResetLink(
        $request->only('email')
      );

      return $status === \Illuminate\Support\Facades\Password::RESET_LINK_SENT ? back()->with(['status' => __($status)]) : back()->withErrors(['email' => __($status)]);
    }

    public function resetPost(Request $request) {
      $request->validate([
        'token'     => ['required'],
        'email'     => ['required', 'email'],
        'password'  => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
      ]);

      $status = \Illuminate\Support\Facades\Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
          $user->forceFill([
            'password' => Hash::make($password)
          ])->setRememberToken(Str::random(60));

          $user->save();

          event(new PasswordReset($user));
        }
      );

      return $status === \Illuminate\Support\Facades\Password::PASSWORD_RESET ? redirect()->route('auth.login')->with('status', __($status)) : back()->withErrors(['email' => [__($status)]]);
    }
}

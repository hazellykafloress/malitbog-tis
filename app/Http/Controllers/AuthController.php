<?php

namespace App\Http\Controllers;

use App\Models\Establishment;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthController extends Controller
{
  public function login()
  {
    return view('auth.login');
  }

  public function authenticate(Request $request)
  {
    $credentials = $request->only(['email', 'password']);

    
    if (!Auth::attempt($credentials)) {
      return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
      ])->onlyInput('email');
    }
    $checkifactive = User::where('email', $request->email)->first();

    if($checkifactive->status == 'inactive') {      
      return back()->withErrors([
        'email' => 'Your account is not yet approved.',
      ])->onlyInput('email');
    }
    $hasEstablishment = Establishment::where('user_id',$checkifactive->id)->first();
    if(!$hasEstablishment && $checkifactive->role_id != '1') {      
      return back()->withErrors([
        'email' => 'Your account has no active establishment. Pease re-apply!',
      ])->onlyInput('email');
    }

    $request->session()->regenerate();
    return redirect()->intended('/dashboard');
  }

  public function logout(Request $request)
  {
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/login');
  }

  public function forgotPassword()
  {
    return view('auth.forgot-password');
  }

  public function forgotPasswordEvent(Request $request)
  {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
      $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
      ? back()->with(['status' => __($status)])
      : back()->withErrors(['email' => __($status)]);
  }

  public function passwordResetForm(string $token)
  {
    return view('auth.reset-password', ['token' => $token]);
  }

  public function passwordUpdate(Request $request)
  {
    $request->validate([
      'token' => 'required',
      'email' => 'required|email',
      'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
      $request->only('email', 'password', 'password_confirmation', 'token'),
      function (User $user, string $password) {
        $user->forceFill([
          'password' => Hash::make($password)
        ])->setRememberToken(Str::random(60));

        $user->save();

        event(new PasswordReset($user));
      }
    );

    return $status === Password::PASSWORD_RESET
      ? redirect()->route('login')->with('status', __($status))
      : back()->withErrors(['email' => [__($status)]]);
  }
}

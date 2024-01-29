<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {
  /**
   * redirect to domain link
   *
   * @return void
   */
  public function domain() {
    return redirect()->route('admin.login');
  }

  /**
   * redirect to login from
   *
   * @return void
   */
  public function loginForm() {
    if (!Auth::check()) {
      return view('backend.auth.login');
    } else {
      return redirect()->route('cashier');
    }
  }

  /**
   * User Login
   *
   * @return void
   */
  public function userLogin(Request $request) {
    $request->validate([
      'email'    => 'required|string|email',
      'password' => 'required|string',
    ]);

    if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
      return redirect()->route('cashier');
    } else {
      return back()->with('fail', 'Invalid Credentials');
    }
  }

  /**
   * Logout
   *
   * @param  Request $request
   * @return void
   */
  public function logout(Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('admin.login');
  }
}

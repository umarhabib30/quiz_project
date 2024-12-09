<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function SubmitLogin(Request $request)
    {
    // Validate incoming data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');
        if(Auth::user()->role == '1'){
            return redirect()->intended('admin/dashboard');
        } elseif(Auth::user()->role == '2'){
            return redirect()->intended('admin/dashboard');
        } else {
            return redirect()->intended('/user/dashboard');
        }

    // Redirect back with error if login fails
        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }
}

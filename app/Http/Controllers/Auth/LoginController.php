<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Requests\LoginHandleRequest;
use Auth;

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
    // protected $redirectTo = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:health_institution')->except('logout');
    }

    /**
     * COMMON : Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * COMMON : Handle a login request to the application.
     *
     * @param  \Illuminate\Http\LoginHandleRequest  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function handleLogin(LoginHandleRequest $request)
    {
        if( Auth::guard('admin')->attempt($request->only('email', 'password'), $request->get('remember')) ){
            return redirect()->intended('/admin/dashboard');
        }
        elseif (Auth::guard('health_institution')->attempt($request->only('email', 'password'), $request->get('remember')))
        {
            if (Auth::guard('health_institution')->user()->isActive == 0)
            {
                $type = Auth::guard('health_institution')->user()->isHead == 1 ? 'Head' : 'Institution';
                Auth::guard('health_institution')->logout($request);
                return redirect()->back()->withInput($request->only('email', 'remember'))
                        ->withErrors(['error' => 'Your Health '.$type.' account has been deactivated. Please contact Site Administrator.']);
            }
            return redirect()->intended('/institution/dashboard');
        }

        return redirect()->back()
            ->withInput($request->only('email', 'remember'))
            ->withErrors(['error' => 'These credentials do not match our records.']);
    }

    /**
     * Log the user out of the application - Override logout() method
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect()->route('home');
    }
}
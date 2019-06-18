<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;

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

    protected $request;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        // $this->middleware('guest')->except('logout');
    }

    public function showLoginForm() 
    {
        return view('home.index')->with(self::$data);
    }
    
    protected function guard()
    {
        return Auth::guard('admin');
    }

    // protected function sendFailedLoginResponse(Request $request)
    // {
    //     $errors = [$this->username() => trans('auth.failed')];
    //     return redirect($this->redirectTo)->withInput($request->only($this->username(), 'remember'))->withErrors($errors);
    // }

    // protected function redirectTo()
    // {
    //     dd($this->request->fullUrl());
    // }

    // protected function authenticated($request, $user)
    // {
    //     dd($request);
    //     $this->request = $request;
    // }
}

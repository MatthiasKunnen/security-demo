<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Cookie;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $lockoutTimeInMinutes = 2;
    protected $maxLoginAttempts = 4;


    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Handle a login request to the application
     *
     * @param  LoginRequest $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        if ($lockedOut = $this->limiter()->tooManyAttempts(
            $this->throttleKey($request), $this->maxLoginAttempts, $this->lockoutTimeInMinutes
        )) {
            $this->fireLockoutEvent($request);
            $secondsRemaining = $this->limiter()->availableIn($this->throttleKey($request));

            return redirect('login')
                ->with('error', trans_choice('auth.throttle', $secondsRemaining, ['seconds' => $secondsRemaining]))
                ->withInput($request->only('email'));
        }

        $credentials = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ];

        if (!auth()->validate($credentials)) {
            $this->incrementLoginAttempts($request);

            return redirect('login')->with('error', trans('auth.failed'));
        }

        $user = auth()->getLastAttempted();

        auth()->login($user, $request->has('remember'));

        return redirect('/')
            ->withCookie(Cookie::make('LaravelSession', Cookie::get('laravel_session'), 60, null, null, false, false));
    }

    /**
     * Sign out the current signed in user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        auth()->logout();
        return redirect('/')->with('success', trans('auth.logout_success'));
    }
}

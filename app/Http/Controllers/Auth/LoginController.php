<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Cookie;
use DB;
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
        $result = DB::select(sprintf('SELECT id FROM users WHERE username="%s" AND password="%s"',
            $request->get('username'),
            $request->get('password')));
        if (count($result) === 0) {
            return redirect('login')->with('error', trans('auth.failed'));
        }
        $row = (array)$result[0];
        $id = $row['id'];

        $user = User::find($id);

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

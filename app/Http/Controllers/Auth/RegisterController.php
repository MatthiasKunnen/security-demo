<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use DB;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Handle a registration request for the application
     *
     * @param \App\Http\Requests\Auth\RegisterRequest $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        DB::statement(sprintf('INSERT INTO users (username, email, `password`) VALUES
            ("%s", "%s", "%s")', $request->input('username'), $request->input('email'), $request->input('password')));

        $user = User::where('email', $request->input('email'))->first();
        auth()->login($user);
        return redirect('/')->with('success', trans('register.success'));
    }
}

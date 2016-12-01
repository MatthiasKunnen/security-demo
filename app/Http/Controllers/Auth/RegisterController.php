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
        $user = new User();
        $user->email = $request->input('email');
        $user->password = str_rot13($request->input('password'));
        DB::statement("INSERT INTO users (email, `password`) VALUES ({$user->email}, {$user->password})");
        $results = DB::select("SELECT id FROM users WHERE email={$user->email}");

        //TODO put user id in $user

        auth()->login($user);
        return redirect('/')->with('success', trans('register.success'));
    }
}

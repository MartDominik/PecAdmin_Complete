<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'lastname' => ['required', 'string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ],[
            'lastname.required' => 'Vezetéknév megadása kötelező!',
            'lastname.string' => 'Csak szöveg fogadható el!',
            'lastname.min' => 'Legalább két karakter szükséges!',
            'lastname.max' => 'Maximum 255 karakter lehet!.',

            'firstname.required' => 'Keresztnév megadása kötelező!',
            'firstname.string' => 'Csak szöveg fogadható el!',
            'firstname.min' => 'Legalább két karakter szükséges!',
            'firstname.max' => 'Maximum 255 karakter lehet!.',

            'email.required' => 'Email megadása kötelező!',
            'email.string' => 'Email helytelen formátuma!',

            'password.required' => 'Jelszó megadása kötelező!',
            'password.string' => 'Csak szöveg fogadható el!',
            'passwoerd.min' => 'Legalább 8 karakter szükséges!',
            'passwoerd.confirmed' => 'A Jelszó nem egyezik!'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'lastname' => $data['lastname'],
            'firstname' => $data['firstname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}

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
            'name' => ['required', 'string', 'max:255'],
            'gestorName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'address' => ['required', 'string', 'max:255'],
            'cellphone' => [
                'required',
                'string',
                'min:11',
                'max:11',
            ],
            
            'password' => ['required', 'string', 'min:4', 'confirmed'],
            'zone' => ['required', 'string'],
            'institutionType' => ['required', 'string', 'min:4'],
            'publicTypeKids' => ['nullable', 'boolean'],
            'publicTypeYoungs' => ['nullable', 'boolean'],
            'publicTypeAdults' => ['nullable', 'boolean'],
            'publicTypeOlds' => ['nullable', 'boolean'],
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
            'name' => $data['name'],
            'gestorName' => $data['gestorName'],
            'email' => $data['email'],
            'cellphone' => $data['cellphone'],
            'zone' => $data['zone'],
            'address' => $data['address'],
            'institutionType' => $data['institutionType'],
            'publicTypeKids' => isset($data['publicTypeKids']) ? true : false,
            'publicTypeYoungs' => isset($data['publicTypeYoungs']) ? true : false,
            'publicTypeAdults' => isset($data['publicTypeAdults']) ? true : false,
            'publicTypeOlds' => isset($data['publicTypeOlds']) ? true : false,
            'password' => Hash::make($data['password']),
        ]);
    }
}
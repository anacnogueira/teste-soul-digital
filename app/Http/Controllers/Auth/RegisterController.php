<?php

namespace App\Http\Controllers\Auth;

use App\Entities\User;
use App\Entities\Type;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

/**
 * Class RegisterController
 * @package %%NAMESPACE%%\Http\Controllers\Auth
 */
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
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('adminlte::auth.register');
    }

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

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
        $rules = [
            'name'     => 'required|max:255',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|regex:/^(?=.*[a-zA-Z])(?=.*[a-zA-Z])(?=.*\d).+$/|confirmed',
        ];

        $messages = [
            'required' => 'O campo é obrigatório.',
            'max' => 'Tamanho máximo de 255 caracteres excedido',
            'email.unique' => 'E-mail já cadastrado',
            'email.email' => 'Forneça um formato de e-mail válido',
            'password.min' => 'A senha deve conter no minino 6 caracteres',
            'password.regex' => 'A senha deve conter ao menos uma letra e um número',
            'password.confirmed' => 'A confirmação de senha diferente'
        ];

        return Validator::make($data, $rules, $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $type = Type::where('name', 'cliente')->firstOrFail();

        $fields = [
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
            'type_id'  => $type->id,
        ];

        return User::create($fields);
    }
}

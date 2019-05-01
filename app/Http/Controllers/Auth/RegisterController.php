<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Laboratorio;
use App\UsuarioLaboratorio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/home';

    /**
     * Solo dejo crear usuarios a otros usuarios, no a guests.
     */
    public function __construct()
    {
        $this->middleware('auth');
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Sobreescribo el método registered para que,
     * tras guardar al usuario, antes de redireccionar al home, 
     * guarde un registro en UsuarioLaboratorio que enlace a ese usuario
     * con el laboratorio.
     */
    protected function registered(Request $request, $user)
    {
        /* Cojo el laboratorio */
        $lab = Laboratorio::where('lab_nif', '19891050Y')->firstOrFail();

        $usuLab = new UsuarioLaboratorio();
        $usuLab->lab_id = $lab->lab_id;
        $usuLab->usu_id = $user->id;
        $usuLab->save();

        redirect($this->redirectPath());
    }
}

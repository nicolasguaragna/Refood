<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Uso el trait RegistersUsers para manejar el registro de usuarios.
     */

    use RegistersUsers;

    /**
     * Redirección después de un registro exitoso.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Creo una nueva instancia del controlador.
     *
     * Aplico middleware 'guest' para evitar que usuarios autenticados accedan al registro.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Valido los datos de registro del usuario.
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
     * Creo una nueva instancia de usuario después de un registro válido.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // Crear el usuario
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Asignar rol por defecto (por ejemplo, rol_id = 2 para "usuario")
        $user->roles()->attach(2);

        return $user;
    }
}

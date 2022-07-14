<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Models\InformacaoLoja;
use App\Models\PersonalizacaoLoja;
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'cpf' => ['required', 'string','min:11'],
            'whatsapp' => ['required', 'string'], 
            'papel' => ['string'],
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
        try {
            $newUser = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'cpf' => $data['cpf'],
                'whatsapp' => $data['whatsapp'], 
                'papel' => 'logista',

            ]);
    
            if($newUser){
               $infoLoja = InformacaoLoja::create([
                    'user_id' => intval($newUser['id']),
                    'titulo' => $data['titulo'],
                    'subtitulo' => $data['subtitulo'],
                    'endereco' => $data['endereco'],
                    'contato_loja' => $data['contato_loja'],
                    'aberto' => 0
                ]);
    
                PersonalizacaoLoja::create([
                    'informacao_loja_id' => intval($infoLoja['id']),
                    'cor1' => '#8c8c8c',
                    'cor2' => '#5b78e0',
                    'banner1' => '/storage/images/banner1.png',
                    'banner2' => '/storage/images/banner2.png',
                    'logo' => '/storage/images/logo.jpg',
                    'capa' => '/storage/images/capa.jpg'
                ]);
            }
            return $newUser;
                
        } catch (\Throwable $th) {
            echo 'Error', $th->getMessage();
        }

    }
}

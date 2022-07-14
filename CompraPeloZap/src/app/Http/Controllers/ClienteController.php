<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Models\Endereco;

class ClienteController extends Controller
{
    public function index(){
        $endereco = Endereco::select(
            'enderecos.*',
            'users.name'
        )
        ->join('users', 'users.id', '=', 'user_id')
        ->get();

        return view('registercliente', compact('endereco', $endereco));
    }

    public function create(Request $request){
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'cpf' => ['required', 'string','min:11'],
            'whatsapp' => ['required', 'string'],
            'cep' => ['required', 'string'],
            'numero' => ['required', 'numeric'],
            'rua' => ['required', 'string'],
            'bairro' => ['required', 'string'],
            'cidade' => ['required','string'],
            'estado' => ['required','string'],
            'complemento' => ['required','string']
        ]); //refazer essa validação!!

        // dd($request->get("estado"));
            $newUser = User::create(
                [
                    'name' => $request->get("name"),
                    'email' => $request->get("email"),
                    'password' => Hash::make($request['password']),
                    'cpf' => $request->get("cpf"),
                    'whatsapp' => $request->get("whatsapp"),
                    'papel' => "cliente",
                ]);

            if($newUser){
              $endereco = Endereco::create(
                    [
                        'user_id' => intval($newUser["id"]),
                        'cep' => $request->get("cep"),
                        'numero' => $request->get("numero"),
                        'rua' => $request->get("rua"),
                        'bairro' => $request->get("bairro"),
                        'cidade' => $request->get("cidade"),
                        'estado' => $request->get("estado"),
                        'complemento' => $request->get("complemento")
                    ]);
            }

            return redirect()->route('listCliente');
    }

    public function edit($id){
        $endereco = Endereco::find($id);
        $user = User::find($endereco->user_id);

        return view('editclient')->with(compact('endereco','user'));
    }

    public function update(Request $request, $id){
        $endereco = Endereco::find($id);
        $user = User::find($endereco->user_id);

        $endereco->update($request->all());
        $user->name = $request->get("name");
        $user->email = $request->get("email");
        $user->cpf = $request->get("cpf");
        $user->whatsapp = $request->get("whatsapp");
        $user->password = $request->get("password");
        $user->save();

        return redirect()->route('listCliente'); //refinar
    }

    public function delete($id){
        $endereco = Endereco::find($id);

        if(!$endereco){
           dd("error");
        }

        $endereco->delete();

        return redirect()->route('listCliente');
    }
}

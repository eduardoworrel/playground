<?php

namespace App\Http\Controllers;

use App\Models\InformacaoLoja;
use Illuminate\Http\Request;
use App\Models\PersonalizacaoLoja;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PersonalizacaoLojaController extends Controller
{
    public function index()
    {

        $LojaDoUsuarioLogado = Auth::user()->informacaoLoja->id;
        $InfoLoja = InformacaoLoja::find($LojaDoUsuarioLogado);
        $personalizacao = PersonalizacaoLoja::where('informacao_loja_id', $LojaDoUsuarioLogado)->first();

        return view('loja.custom.custom', [
            'personalizacao' => $personalizacao,
            'infoLoja' => $InfoLoja,
            'info' =>$InfoLoja
        ]);
    }

    public function update(Request $request, $id)
    {
        $LojaDoUsuarioLogado = Auth::user()->informacaoLoja->id;
        $InfoLoja = InformacaoLoja::find($LojaDoUsuarioLogado);
        $personalizacao = PersonalizacaoLoja::where('informacao_loja_id', $LojaDoUsuarioLogado)->first();

        //refazer a validação com form request#
        $request->validate([
            'logo' => 'image',
            'titulo' => 'string',
            'subtitulo' => 'string',
            'endereco' =>  'string',
            'contato_loja' => 'string|min:11'
        ]);

        $data = $request->all();

       
        if($request->hasFile('logo') && $request->logo->isValid()){

            if($personalizacao->logo && Storage::exists($personalizacao->logo))
            {
               Storage::delete($personalizacao->logo);
            }

            $imagePath = $request->logo->store('images');
            $data['logo'] = $imagePath;
        }


        $personalizacao->update($data);

        $InfoLoja->update([
            'titulo' => $data['titulo'],
            'subtitulo' => $data['subtitulo'],
            'endereco' =>  $data['endereco'],
            'contato_loja' => $data['contato_loja'],
        ]);

        return redirect()->route('home');
    }
}

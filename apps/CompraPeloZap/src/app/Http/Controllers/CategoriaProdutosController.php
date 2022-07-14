<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CategoriaProdutos;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriaProdutosController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

        $categorias = Auth::user()->informacaoLoja->CategoriaProdutos ?
        Auth::user()->informacaoLoja->CategoriaProdutos : [] ;
        $info = Auth::user()->informacaoLoja;
        return view('loja.create.categoria')->with(compact('categorias','info'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'titulo' => ['required', 'string', 'max:255'],
        ]);
    }

    protected function create(Request $data)
    {
        $categoria = CategoriaProdutos::create(
            [
                'informacao_loja_id' => Auth::user()->informacaoLoja->id,
                'titulo' => $data['categoria'],
            ]
        );

        return redirect("/categoria");
     }

    protected function edit(Request $data)
    {
        $categoria = CategoriaProdutos::find($data['id']);

        if($categoria){
            $categoria->titulo = $data['titulo'];
            $categoria->save();
        }
        return redirect("/categoria");
    }
    protected function delete(Request $data)
    {
        $categoria = CategoriaProdutos::find($data['id']);
        $categoria->delete();

        return redirect("/categoria");
    }
}

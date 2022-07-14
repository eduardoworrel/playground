<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FormaPagamento;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormaPagamentoController extends Controller
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
        $formaPagamentos = Auth::user()->informacaoLoja->formaPagamento;
        $info = Auth::user()->informacaoLoja;

        return view('loja.create.formaPagamento')->with(compact('formaPagamentos','info'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'titulo' => ['required', 'string', 'max:255'],
        ]);
    }

    protected function create(Request $data)
    {
        $forma = FormaPagamento::create(
            [
                'informacao_loja_id' => Auth::user()->informacaoLoja->id,
                'titulo' => $data['formaPagamento'],
            ]
        );

        return redirect("/formaPagamento");
     }

    protected function edit(Request $data)
    {
        $forma = FormaPagamento::find($data['id']);

        if($forma){
            $forma->titulo = $data['titulo'];
            $forma->save();
        }
        return redirect("/formaPagamento");
    }
    protected function delete(Request $data)
    {
        $forma = FormaPagamento::find($data['id']);
        $forma->delete();

        return redirect("/formaPagamento");
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cupom;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CupomController extends Controller
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
        $cupoms = Auth::user()->informacaoLoja->cupom;
        $info = Auth::user()->informacaoLoja;

        foreach ($cupoms as $cupom) {
            $cupom->datahora_inicio_validade = explode(' ', $cupom->datahora_inicio_validade)[0];
            $cupom->datahora_fim_validade = explode(' ', $cupom->datahora_fim_validade)[0];
        }
        return view('loja.create.cupom')->with(compact('cupoms','info'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'codigo' => ['required', 'string', 'max:255'],
            'datahora_inicio_validade' => ['required', 'date'],
            'datahora_fim_validade' => ['required', 'date'],
            'valor' => ['required', 'number'],
        ]);
    }

    protected function create(Request $data)
    {

        $cupom = Cupom::create(
            [
                'informacao_loja_id' => Auth::user()->informacaoLoja->id,
                'codigo' => $data['codigo'],
                'valor' => $data['valor'],
                'datahora_inicio_validade' => $data['datahora_inicio_validade'],
                'datahora_fim_validade' => $data['datahora_fim_validade'],
            ]
        );

        return redirect("/cupom");
    }

    protected function edit(Request $data)
    {
        $cupom = Cupom::find($data['id']);

        if ($cupom) {
            if ($data['codigo']) {
                $cupom->codigo = $data['codigo'];
            }
            if ($data['valor']) {
                $cupom->valor = $data['valor'];
            }
            if ($data['datahora_inicio_validade']) {
                $cupom->datahora_inicio_validade = $data['datahora_inicio_validade'];
            }
            if ($data['datahora_fim_validade']) {
                $cupom->datahora_fim_validade = $data['datahora_fim_validade'];
            }
            $cupom->save();
        }
        return redirect("/cupom");
    }
    protected function delete(Request $data)
    {
        $cupom = Cupom::find($data['id']);
        $cupom->delete();

        return redirect("/cupom");
    }
}

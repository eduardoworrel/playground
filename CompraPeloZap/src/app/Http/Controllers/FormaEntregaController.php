<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FormaEntrega;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormaEntregaController extends Controller
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
        $formaEntregas = Auth::user()->informacaoLoja->formaEntrega;
        $info = Auth::user()->informacaoLoja;

        return view('loja.create.formaEntrega')->with(compact('formaEntregas','info'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'titulo' => ['required', 'string', 'max:255'],
        ]);
    }

    protected function create(Request $data)
    {
        $forma = FormaEntrega::create(
            [
                'informacao_loja_id' => Auth::user()->informacaoLoja->id,
                'titulo' => $data['formaEntrega'],
            ]
        );

        return redirect("/formaEntrega");
     }

    protected function edit(Request $data)
    {
        $forma = FormaEntrega::find($data['id']);

        if($forma){
            $forma->titulo = $data['titulo'];
            $forma->save();
        }
        return redirect("/formaEntrega");
    }
    protected function delete(Request $data)
    {
        $forma = FormaEntrega::find($data['id']);
        $forma->delete();

        return redirect("/formaEntrega");
    }
}

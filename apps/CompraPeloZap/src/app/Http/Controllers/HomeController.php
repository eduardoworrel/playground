<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Pedido;
use App\Models\PedidoProdutoAdicionais;
use App\Models\ProdutoAdicionais;
use App\Models\InformacaoLoja;
use App\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $info = Auth::user()->informacaoLoja;
        $loja = Auth::user()->informacaoLoja->id;
        $pedidos = Pedido::where('informacao_loja_id', $loja)
            ->where('status', 2)
            ->orderBy('status', 'ASC')
            ->orderBy('created_at', 'DESC')->withTrashed()
            ->get();
        $totalObtido = 0.0;
        $totalHoje = 0.0;
        foreach($pedidos as $p){
            $p->total = 0.0;
            foreach($p->produtosPedido as $pp){
                $p->total += floatval($pp->produto->preco) * $pp->quantidade;
                $relacao = PedidoProdutoAdicionais::
                where('pedido_produtos_id',$pp->id)->get();
                $ar = [];
                foreach($relacao as $r){

                    $add = ProdutoAdicionais::
                    find($r->produtoAdicionais_id);
                    $add->quantidade = $r->quantidade;
                    $p->total += floatval($add->valor) * $add->quantidade;
                    $ar[] = $add;

                }
                $pp->produto->adicionais = $ar;
            }
            $totalObtido += $p->total;

            if(explode(" ", $pp->created_at)[0] == explode(" ", Carbon::now())[0]){
                $totalHoje += $p->total;

            }


        }
        $info->totalObtido = $totalObtido;
        $info->totalHoje = $totalHoje;
        return view('home')->with(compact('info'));
    }
    public function estadoDaLoja($i)
    {
        if(!($i == 0 || $i == 1)){
            return -1;
        }
        $info = Auth::user()->informacaoLoja;
        $loja = InformacaoLoja::find($info->id);
        $loja->aberto = $i;
        $loja->save();
        return $i;

    }
}

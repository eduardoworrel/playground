<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\PedidoProdutoAdicionais;
use App\Models\ProdutoAdicionais;
use App\Models\CategoriaProdutos;
use App\Models\Cupom;
use App\Models\InformacaoLoja;
use App\Models\FormaEntrega;
use App\Models\FormaPagamento;
use App\Models\Pedido;
use App\Models\Endereco;
use App\Models\produtosPedido;
use App\User;
use Illuminate\Support\Facades\App;
use Redirect;

class PedidoController extends Controller
{
    public function updateStatus($id, $data)
    {

        if ($data == 1 || $data == 2) {
            $pedido = Pedido::find($id);
            $pedido->update([
                'status' => $data,
            ]);
        }
        return Redirect::route('pedido');
    }
    public function index()
    {
        $in = [];
        $ref = [];
        $info = Auth::user()->informacaoLoja;
        $loja = Auth::user()->informacaoLoja->id;
        $pedidos = Pedido::where('informacao_loja_id', $loja)
            ->orderBy('status', 'ASC')
            ->orderBy('created_at', 'DESC')->withTrashed()
            ->get();
        $categorias = CategoriaProdutos::withTrashed()->where('informacao_loja_id', $loja)->get();
        foreach ($categorias as $c) {
            $in[] = $c->id;
            $ref = $ref + array($c->id => $c->titulo);
        }
        foreach ($pedidos as $p) {
            $p->total = 0.0;
            foreach ($p->produtosPedido as $pp) {
                $p->total += floatval($pp->produto->preco) * $pp->quantidade;
                $relacao = PedidoProdutoAdicionais::where('pedido_produtos_id', $pp->id)->get();
                $ar = [];
                foreach ($relacao as $r) {

                    $add = ProdutoAdicionais::find($r->produtoAdicionais_id);
                    $add->quantidade = $r->quantidade;
                    $p->total += floatval($add->valor) * $add->quantidade;
                    $ar[] = $add;
                }
                $pp->produto->adicionais = $ar;
            }
        }

        return view('loja.custom.painel_pedidos')->with(compact('info', 'pedidos', 'categorias', 'ref'));
    }
    public function checkWhatsapp($whatsapp)
    {
        try {

            $user = User::where('whatsapp', $whatsapp)->orderBy('id', 'desc')->first();
            $endereco = Endereco::where('user_id', $user->id)->first();

            $response = array(
                "nome" => $user->name,
                "numero" => $endereco->numero,
                "cep" => $endereco->cep,
                "rua" => $endereco->rua,
                "bairro" => $endereco->bairro,
                "cidade" => $endereco->cidade,
                "estado" => $endereco->estado,
                "complemento" => $endereco->complemento,
            );
            return json_encode($response);
        } catch (Exception $ex) {
            return array();
        }
    }
    public function loja()
    {

        $in = [];
        $ref = [];

        $loja = 1;

        $info = InformacaoLoja::find($loja);
        $categorias = CategoriaProdutos::where('informacao_loja_id', $info->id)->get();
        foreach ($categorias as $c) {
            $c->produtos =  Produto::where('ativo', 'on')->where('categoria_produtos_id', $c->id)->get();
        }
        $fone = $info->contato_loja;
        $pagamento = FormaPagamento::where('informacao_loja_id', $info->id)->get();
        $entrega = FormaEntrega::where('informacao_loja_id', $info->id)->get();


        //$promocao = Produto::where('ativo','on')->whereIn('categoria_produtos_id', $in)->where('promocao','on')->get();
        //$maisVendidos = Produto::where('ativo','on')->whereIn('categoria_produtos_id', $in)->where('mais_vendido','on')->get();

        session()->put('loja', $info->id);
        return view('loja.pedido')->with(compact('fone', 'categorias', 'ref', 'info', 'entrega', 'pagamento'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'entrega' => ['required', 'int'],
            'pagamento' => ['required', 'int'],
            'produtos.*' => ['required', 'string'],
            'whatsapp' => ['required', 'string'],
            'nome' => ['required', 'string'],
            'endereco' => ['required', 'string'],
            'complemento' => ['string'],
            'observacao' => ['string'],
        ]);
    }

    protected function create(Request $data)
    {
        $loja = session()->get('loja');
        if ($loja != null) {
            if (is_array($data['produtos']) || is_array($data['ads'])) {

                $usr = User::create([
                    'name' => $data["nome"],
                    'password' => 'none',
                    'cpf' => $data["nome"],
                    'email' => $data["nome"] . rand(0, 0123456),
                    'whatsapp' => $data["whatsapp"],
                    'papel' => "cliente",
                ]);

                if ($usr) {

                    $cupom = Cupom::Where('codigo', $data['cupom'])->get();
                    if ($cupom->count() < 1) {
                        $cupom = null;
                    } else {
                        $cupom = $cupom[0]->id;
                    }
                    $pedido = Pedido::create(
                        [
                            'user_id' => $usr["id"],
                            'cupom_id' => $cupom,
                            'informacao_loja_id' => $loja,
                            'forma_pagamento_id' => $data['pagamento'],
                            'forma_entrega_id' => $data['entrega'],
                            'observacao' => $data['observacao'],
                            'status' => 0,
                            'endereco' => $data->get("endereco"),
                        ]
                    );
                    if (is_array($data['produtos'])) {
                        foreach ($data['produtos'] as $produto) {
                            $ar = explode('.', $produto);
                            $produtoPedido = produtosPedido::create([
                                'pedido_id' => $pedido->id,
                                'produto_id' => $ar[0],
                                'quantidade' => $ar[1]
                            ]);
                        }
                    }
                    if (is_array($data['ads'])) {
                        foreach ($data['ads'] as $ads) {
                            $ar = explode('.', $ads);

                            $produtoPedido = produtosPedido::create([
                                'pedido_id' => $pedido->id,
                                'produto_id' => $ar[0],
                                'quantidade' => 1
                            ]);
                            $adDesseGrupo = explode(',', $ar[1]);
                            foreach ($adDesseGrupo as $chaveValor) {
                                if ($chaveValor == "") {
                                    continue;
                                }
                                $chaveValor = explode('-', $chaveValor);
                                $idAdiconal = $chaveValor[0];
                                $qtAdicional = $chaveValor[1];
                                if ($idAdiconal > 0 && $qtAdicional > 0) {
                                    PedidoProdutoAdicionais::create([
                                        'pedido_produtos_id' => $produtoPedido->id,
                                        'produtoAdicionais_id' => $idAdiconal,
                                        'quantidade' =>  $qtAdicional
                                    ]);
                                }
                            }
                        }
                    }
                }

                return 0;
            }
        }
        return 1;
    }
}

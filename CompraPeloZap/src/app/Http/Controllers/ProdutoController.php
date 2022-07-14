<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\ProdutoAdicionais;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdutoController extends Controller
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
        $in = [];
        $ref = [];
        $info = Auth::user()->informacaoLoja;
        $categorias = Auth::user()->informacaoLoja->CategoriaProdutos ? Auth::user()->informacaoLoja->CategoriaProdutos : [];
        foreach($categorias as $c){
            $in[] = $c->id;
            $ref = $ref + array($c->id => $c->titulo);
        }
        $produtos = Produto::whereIn('categoria_produtos_id', $in)->get();

        return view('loja.create.produto')->with(compact('info','produtos', 'categorias','ref'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'categoria_produtos_id' => ['required', 'integer'],
            'titulo' => ['required', 'string', 'max:255'],
            'image' => 'image',
            'descricao' => ['required', 'string', 'max:255'],
            'preco' => ['required', 'string', 'max:255'],
            'ativo' => ['string'],
            'promocao' => ['string'],
            'mais_vendido' => ['string'],
            'nomeAdicional.*' => ['string'],
            'precoAdicional.*' => ['numeric'],
        ]);
    }

    protected function create(Request $data)
    {

        $produto = produto::create(
            [
                'categoria_produtos_id' => $data['categoria_produtos_id'],
                'titulo' => $data['titulo'],
                'descricao' => $data['descricao'],
                'preco' => $data['preco'],
                'ativo' => "on",
                'promocao' => "off",
                'mais_vendido' => "off",
            ]
        );
        if($produto){
            if($data->hasFile('image') && $data->image->isValid()){
                if($produto->image && Storage::exists($produto->image))
                {
                   Storage::delete($produto->image);
                }
                $imagePath = $data->image->store('images');
                $produto->update([
                    'image' => $imagePath,
                ]);
            }
            if(isset($data['adicional'])){
                foreach($data['adicional'] as $adicional){
                $ad = explode('><',$adicional);
                $p = new ProdutoAdicionais;
                $p->nome = $ad[0];
                $p->valor = $ad[1];
                $p->tipo = 0;
                $p->produto_id = $produto->id;
                $p->save();
                }
            }
        }

        return redirect("/produto");
    }

    protected function edit(Request $data)
    {
        $produto = produto::find($data['id']);

        if ($produto) {
            if ($data['categoria_produtos_id']) {
                $produto->categoria_produtos_id = $data['categoria_produtos_id'];
            }
            if ($data['titulo']) {
                $produto->titulo = $data['titulo'];
            }
            if ($data['descricao']) {
                $produto->descricao = $data['descricao'];
            }
            if ($data['preco']) {
                $produto->preco = $data['preco'];
            }
            if($data->hasFile('image') && $data->image->isValid()){
                if($produto->image && Storage::exists($produto->image))
                {
                    Storage::delete($produto->image);
                }
                $imagePath = $data->image->store('images');
                $produto['image'] = $imagePath;
            }


            if($data['adicional']){
                foreach($data['adicional'] as $adicional){
                    $ad = explode('><',$adicional);
                    $p = new ProdutoAdicionais;
                    $p->nome = $ad[0];
                    $p->valor = $ad[1];
                    $p->tipo = 0;
                    $p->produto_id = $produto->id;
                    $p->save();
                }
            }
            if($data['adicionalDeletado']){
                foreach($data['adicionalDeletado'] as $adicional){
                    ProdutoAdicionais::find($adicional)->delete();
                }
            }

            $produto->save();
        }
        return redirect("/produto");
    }
    protected function delete(Request $data)
    {
        $produto = produto::find($data['id']);
        $produto->delete();

        return redirect("/produto");
    }

    protected function switchActive(Request $request, $id)
    {
        $findProduto = Produto::find($id);

        if($findProduto->ativo === 'on'){
            $findProduto->ativo = "off";
            $findProduto->save();
        }else{
            $findProduto->ativo = "on";
            $findProduto->save();
        }

        return redirect("/produto");
    }

    protected function switchPromocao(Request $request, $id)
    {
        $findProduto = Produto::find($id);

        if($findProduto->promocao === 'off'){
            $findProduto->promocao = "on";
            $findProduto->save();
        }else{
            $findProduto->promocao = "off";
            $findProduto->save();
        }

        return redirect("/produto");
    }

    protected function switchVendidos(Request $request, $id)
    {
        $findProduto = Produto::find($id);

        if($findProduto->mais_vendido === 'off'){
            $findProduto->mais_vendido = "on";
            $findProduto->save();
        }else{
            $findProduto->mais_vendido = "off";
            $findProduto->save();
        }

        return redirect("/produto");
    }
}

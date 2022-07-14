@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Produto</div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('createProduto') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="categoria" class="col-md-4 col-form-label text-md-right">Categoria</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="categoria_produtos_id">
                                        @foreach ($categorias as $c)
                                            <option value="{{ $c->id }}">{{ $c->titulo }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="titulo" class="col-md-4 col-form-label text-md-right">Titulo</label>
                                <div class="col-md-6">
                                    <input id="titulo" type="text"
                                        class="form-control @error('titulo') is-invalid @enderror" name="titulo"
                                        value="{{ old('titulo') }}" required autocomplete="titulo" autofocus>
                                    @error('titulo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                    </span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="image" class="col-md-4 col-form-label text-md-right">Imagem</label>
                                <div class="col-md-6">
                                    <input type="file" name="image" class="form-control-file" id="image">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="descricao" class="col-md-4 col-form-label text-md-right">Descrição</label>
                                <div class="col-md-6">
                                    <input id="descricao" type="text"
                                        class="form-control @error('descricao') is-invalid @enderror" name="descricao"
                                        value="{{ old('descricao') }}" required autocomplete="descricao" autofocus>
                                    @error('descricao')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                    </span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="preco" class="col-md-4 col-form-label text-md-right">Preço</label>
                                <div class="col-md-6">
                                    <input id="preco" type="text" class="form-control @error('preco') is-invalid @enderror"
                                        name="preco" value="{{ old('preco') }}" required autocomplete="preco" autofocus>
                                    @error('preco')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                    </span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12 text-center">
                                    <b class="" >Adicionais</b>
                                </div>
                                <div class="col-md-12">
                                    <ul class="list-group">
                                    <li class="list-group-item">
                                        <div class="col-md-5 float-left"><span>Nome</span> <input id="nomeAdicional" type="text" name="nomeAdicional" value="" autocomplete="nomeAdicional" class="form-control "></div>
                                        <div class="col-md-3 float-left"><span>Preço</span> <input id="precoAdicional" type="text" name="precoAdicional" value=""  autocomplete="precoAdicional" class="form-control "></div>
                                        <div class=" float-right"><a onclick="addAdicional()" class="btn btn-secondary"  style='margin-top:20px; color:whitesmoke'>ADICIONAR</a></div>
                                    </li>
                                    </ul>
                                    <ul class="list-group adicionados">
                                    
                                    </ul>

                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        SALVAR
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="container">
                    <div class="row">
                        @foreach ($produtos as $produto)
                            <div class="col-md-4">
                                <div class="card mx-2 my-2">
                                    <img style="width: 70%; margin:0 auto" src="storage/{{ $produto->image }}"
                                        class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <div>
                                            Categoria: <strong>{{ $ref[$produto->categoria_produtos_id] }}</strong><br>
                                            Titulo: <strong>{{ $produto->titulo }}</strong><br>
                                            Descrição: <strong>{{ $produto->descricao }}</strong><br>
                                            Preço: <strong>{{ $produto->preco }}</strong>
                                            <hr>
                                            <div class="row">
                                                <div class="col-12">
                                                    Ativo:
                                                    <form style='display:inline'
                                                        action="{{ action('ProdutoController@switchActive', $produto->id, '/ativo') }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit"
                                                            style="border: none; background: transparent;">
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" name="ativo"
                                                                    {{ $produto->ativo === 'on' ? 'checked' : 'off' }}
                                                                    class="custom-control-input"
                                                                    id="custom{{ $produto->titulo }}">
                                                                <label class="custom-control-label"
                                                                    for="custom{{ $produto->titulo }}"></label>
                                                            </div>
                                                        </button>
                                                    </form>
                                                </div>
                                                <div class="col-12">
                                                    Promoção:
                                                    <form style='display:inline'
                                                        action="{{ action('ProdutoController@switchPromocao', $produto->id, '/promocao') }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit"
                                                            style="border: none; background: transparent;">
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" name="promocao"
                                                                    {{ $produto->promocao === 'on' ? 'checked' : 'off' }}
                                                                    class="custom-control-input"
                                                                    id="promocao{{ $produto->titulo }}">
                                                                <label class="custom-control-label"
                                                                    for="promocao{{ $produto->titulo }}"></label>
                                                            </div>
                                                        </button>
                                                    </form>
                                                </div>
                                                <div class="col-12">
                                                    Mais vendido:
                                                    <form style='display:inline'
                                                        action="{{ action('ProdutoController@switchVendidos', $produto->id, '/mais_vendidos') }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit"
                                                            style="border: none; background: transparent;">
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" name="vendido"
                                                                    {{ $produto->mais_vendido === 'on' ? 'checked' : 'off' }}
                                                                    class="custom-control-input"
                                                                    id="switch{{ $produto->titulo }}">
                                                                <label class="custom-control-label"
                                                                    for="switch{{ $produto->titulo }}"></label>
                                                            </div>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="container">
                                            <div class="row">
                                                <!-- Button to Open the Modal -->
                                                <button type="button" class="btn btn-primary col-6 mb-2" data-toggle="modal"
                                                    data-target="#myModal{{ $produto->id }}">
                                                    EDITAR
                                                </button>

                                                <!-- The Modal -->
                                                <div class="modal" id="myModal{{ $produto->id }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Categoria</h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal">&times;</button>
                                                            </div>

                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <div class="container">
                                                                    <form id="form{{ $produto->id }}"
                                                                        action="{{ route('editProduto') }}" method="POST"
                                                                        enctype="multipart/form-data">
                                                                        @csrf
                                                                        <div class="form-group row">
                                                                            <label for="categoria"
                                                                                class="col-md-4 col-form-label text-md-right">Categoria</label>
                                                                            <div class="col-md-6">
                                                                                <select class="form-control"
                                                                                    name="categoria_produtos_id">
                                                                                    @foreach ($categorias as $c)
                                                                                        <option
                                                                                            value="{{ $c->id }}">
                                                                                            {{ $c->titulo }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group row">
                                                                            <label for="titulo"
                                                                                class="col-md-4 col-form-label text-md-right">Titulo</label>
                                                                            <div class="col-md-6">
                                                                                <input class="form-control" type="text"
                                                                                    value="{{ $produto->titulo }}"
                                                                                    name="titulo">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="image"
                                                                                class="col-md-4 col-form-label text-md-right">Imagem</label>
                                                                            <div class="col-md-6">
                                                                                <input type="file" name="image"
                                                                                    class="form-control-file" id="image">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="descricao"
                                                                                class="col-md-4 col-form-label text-md-right">Descrição</label>
                                                                            <div class="col-md-6">
                                                                                <input class="form-control" type="text"
                                                                                    value="{{ $produto->descricao }}"
                                                                                    name="descricao">
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group row">
                                                                            <label for="preco"
                                                                                class="col-md-4 col-form-label text-md-right">Preço</label>
                                                                            <div class="col-md-6">
                                                                                <input class="form-control" type="text"
                                                                                    value="{{ $produto->preco }}"
                                                                                    name="preco">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-md-12 text-center">
                                                                                <b class="" >Adicionais</b>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <ul class="list-group">
                                                                                <li class="list-group-item">
                                                                                    <div class="col-md-5 float-left"><span>Nome</span> <input id="nomeAdicional{{ $produto->id }}" type="text" name="nomeAdicional" value="" required="required" autocomplete="nomeAdicional" class="form-control "></div>
                                                                                    <div class="col-md-3 float-left"><span>Preço</span> <input id="precoAdicional{{ $produto->id }}" type="text" name="precoAdicional" value="" required="required" autocomplete="precoAdicional" class="form-control "></div>
                                                                                    <div class=" float-right"><a onclick="addAdicional({{ $produto->id }})" class="btn btn-secondary"  style='margin-top:20px; color:whitesmoke'>ADICIONAR</a></div>
                                                                                </li>
                                                                                </ul>
                                                                                <ul class="list-group adicionados{{ $produto->id }}">
                                                                                    @foreach($produto->produtoAdicionais as $adicional )
                                                                                     <li class='itAdicional{{ $produto->id }} list-group-item' data-nome='{{$adicional->nome}}'>
                                                                                        {{$adicional->nome}} - 
                                                                                        {{$adicional->valor}}
                                                                                        <a class='btn btn-danger float-right' onclick='deletaAdicional("{{$adicional->nome}}",{{ $produto->id }},{{$adicional->id}})'>DELETAR</a>
                                                                                    </li> 
                                                                                    @endforeach
                                                                                </ul>
                                            
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <input type="hidden"
                                                                                value="{{ $produto->id }}" name="id">
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>

                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                                <button class="btn btn-warning"
                                                                    onclick=" document.getElementById('form{{ $produto->id }}').submit();">EDITAR</button>
                                                                <button type="button" class="btn btn-danger"
                                                                    data-dismiss="modal">FECHAR</button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <form class=" col-6" action="{{ route('deleteProduto') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" value="{{ $produto->id }}" name="id">
                                                    <button class="btn btn-danger">EXCLUIR</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

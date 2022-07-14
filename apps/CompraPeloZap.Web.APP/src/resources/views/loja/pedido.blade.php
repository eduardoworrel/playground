<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCv7tdYvGz9YtMAhDNh4xlBgvpBEIjMUYA&c">
    </script>
    <script src="{{ asset('js/jquery.mask.js') }}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <script>
        var f = new Intl.NumberFormat('pt-br', {
            style: 'currency',
            currency: 'BRL',
        });
    </script>
    <title>{{ $info->titulo }}</title>
</head>

<body style="max-width: 800px;margin:0 auto">
    <!-- <div class="container">
    <div class="row justify-content-center">
        <h1 style="text-align: center"></h1>

    </div>
</div> -->
    <div class="container" style="
    text-align: center;
    margin-top: 35px;
    font-size: 2em;">
        @if ($info->aberto == 0)
            <small>Offline</small><span
                style="display: inline-block;width: 7px;height: 7px;border-radius:50%;margin-bottom: 3px;margin-left: 6px;background: red;"></span><br>
        @endif
        @if ($info->personalizacaoLoja->logo)
            <div class="col-3" style="float: left">
                <div class="image-cropper" style="margin-top: 7px;">
                    <img
                    onerror="this.src='semFoto.jpg';"
                    src="storage/{{ $info->personalizacaoLoja->logo }}" width="80px">
                </div>
            </div>

            <div class="col-9" style="float: left">
                <a style="color: black;
            text-decoration: none;
            font-weight:700;
            font-family: system-ui;">
                    {{ $info->titulo }}
                </a>
                <h5 style="text-align: center">{{ $info->subtitulo }}</h5>
                <h6 style="text-align: center; display:block;
    padding-bottom: 25px;">{{ $info->endereco }}</h6>
            </div>
        @else
            <a style="color: black;
        text-decoration: none;
        font-weight:700;
        font-family: system-ui;">
                {{ $info->titulo }}
            </a>
            <h5 style="text-align: center">{{ $info->subtitulo }}</h5>
            <h6 style="text-align: center; display:block;
padding-bottom: 25px;">{{ $info->endereco }}</h6>
        @endif

    </div>
    <div class="container itens" style="
    background: #f3f3f3;
    border-top-left-radius: 35px;
    border-top-right-radius: 35px;
    padding-top: 25px;
    padding-bottom: 50px;
    overflow:auto;
    height:60%;
    position:relative;
    ">
        <div class="row justify-content-center ">
            {{-- @foreach ($maisVendidos as $produto)
                @if ($loop->first)
                    <h5 class="text-center">Mais vendidos</h5>
                @endif
                @if (count($produto->ProdutoAdicionais) > 0)
                    <div class="col-12 adicionavelmv{{ $produto->id }}" style="margin-top:25px">
                        <div style="box-shadow: 0px 0px 20px -13px rgb(0 0 0);border-radius:15px; background:white; margin:-5px;padding:10px;heigth:100px"
                            class="row">
                            <div class="col-3">
                                <div class="image-cropper">
                                    <img src="storage/{{ $produto->image }}" class="profile-pic">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="titulo{{ $produto->id }} t">
                                    {{ $produto->titulo }}
                                </div>
                                <div class="preco{{ $produto->id }} p">
                                        <script>
                                            document.write(f.format('{{ $produto->preco }}'));

                                        </script>
                                </div>
                                <div class="preco{{ $produto->id }} d small">
                                    {{ $produto->descricao }}
                                </div>
                            </div>
                            <div class="col-3 text-center">

                                <a class="btn btn-light" style="width: 100%" data-toggle="collapse"
                                    data-target="#mProdutomv{{ $produto->id }}"><span class="material-icons">
                                        add
                                    </span></a>
                                <input class="quantidademv{{ $produto->id }} qt" type="hidden"
                                    data-who="{{ $produto->titulo }}" data-id="{{ $produto->id }}"
                                    data-desc="{{ $produto->descricao }}" data-img="{{ $produto->image }}"
                                    value="0" disabled="disabled">


                            </div>
                            <div class="collapse" id="mProdutomv{{ $produto->id }}">
                                <p class="small text-center">Opções para o seu {{ $produto->titulo }}</p>

                                <ul class="list-group adicionadosmv{{ $produto->id }}">
                                    @foreach ($produto->produtoAdicionais as $adicional)
                                        <li class=' list-group-item'>
                                            <div class="row">
                                                <span class="col-6">
                                                    <span class="t">{{ $adicional->nome }}</span>
                                                    <span class="p">
                                                        <script>
                                                            document.write(f.format('{{ $adicional->valor }}'));

                                                        </script>
                                                    </span>
                                                </span>
                                                <span class="col-6">
                                                    <a class="btn btn-light" style="width: 32%;float:left"
                                                        onclick="maisAdicional('mv{{ $produto->id }},{{ $adicional->id }},{{ $adicional->valor }})"><span
                                                            class="material-icons">
                                                            add
                                                        </span></a>
                                                    <input style="width: 33%;float:left"
                                                        class="form-control text-center child{{ $produto->id }} quantidadeAd{{ $produto->id }}-{{ $adicional->id }} qt"
                                                        type="text" data-who="{{ $adicional->nome }}"
                                                        data-id="{{ $adicional->id }}" value="0" disabled="disabled"
                                                        style="width:60px">

                                                    <a class="btn btn-light" style="width:32%;float:left"
                                                        onclick="menosAdicional({{ $produto->id }},{{ $adicional->id }},{{ $adicional->valor }})"><span
                                                            class="material-icons">
                                                            remove
                                                        </span></a>
                                                </span>
                                                <div>
                                        </li>
                                    @endforeach

                                    <button type="button" class="btn btn-primary"
                                        onclick="novoProdutoComAdicional({{ $produto->id }},{{ $produto->preco }})">Concluir</button>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-12" style="margin-top:25px">
                        <div style="box-shadow: 0px 0px 20px -13px rgb(0 0 0);
            border-radius:15px; background:white; margin:-5px;padding:10px;heigth:100px" class="row">
                            <div class="col-3">
                                <div class="image-cropper">
                                    <img 
                                    
                                    src="storage/{{ $produto->image }}" class="profile-pic">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="titulo{{ $produto->id }} t">
                                    {{ $produto->titulo }}
                                </div>
                                <div class="preco{{ $produto->id }} p">
                                    <script>
                                        document.write(f.format('{{ $produto->preco }}'));

                                    </script>
                                </div>
                                <div class="preco{{ $produto->id }} d small">
                                    {{ $produto->descricao }}
                                </div>
                            </div>
                            <div class="col-3 text-center">

                                <a class="btn btn-light" style="width: 100%"
                                    onclick="mais({{ $produto->id }},{{ $produto->preco }})"><span
                                        class="material-icons">
                                        add
                                    </span></a>

                                <input style="width: 100%"
                                    class="form-control text-center quantidade qt{{ $produto->id }}" type="text"
                                    data-who="{{ $produto->titulo }}" data-id="{{ $produto->id }}" value="0"
                                    disabled="disabled" style="width:60px">

                                <a class="btn btn-light" style="width: 100%"
                                    onclick="menos({{ $produto->id }},{{ $produto->preco }})"><span
                                        class="material-icons">
                                        remove
                                    </span></a>

                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
            @foreach ($promocao as $produto)
                @if ($loop->first)
                    <h5 style="margin-top: 30px" class="text-center">Promoção</h5>
                @endif
                @if (count($produto->ProdutoAdicionais) > 0)
                    <div class="col-12 adicionavel{{ $produto->id }}" style="margin-top:25px">
                        <div style="box-shadow: 0px 0px 20px -13px rgb(0 0 0);border-radius:15px; background:white; margin:-5px;padding:10px;heigth:100px"
                            class="row">
                            <div class="col-3">
                                <div class="image-cropper">
                                    <img  
                    onerror="this.src='semFoto.jpg';" src="storage/{{ $produto->image }}" class="profile-pic">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="titulo{{ $produto->id }} t">
                                    {{ $produto->titulo }}
                                </div>
                                <div class="preco{{ $produto->id }} p">
                                    <script>
                                        document.write(f.format('{{ $produto->preco }}'));

                                    </script>
                                </div>
                                <div class="preco{{ $produto->id }} d small">
                                    {{ $produto->descricao }}
                                </div>
                            </div>
                            <div class="col-3 text-center">

                                <a class="btn btn-light" style="width: 100%" data-toggle="collapse"
                                    data-target="#mProduto{{ $produto->id }}"><span class="material-icons">
                                        add
                                    </span></a>
                                <input class="quantidade{{ $produto->id }} qt" type="hidden"
                                    data-who="{{ $produto->titulo }}" data-id="{{ $produto->id }}"
                                    data-desc="{{ $produto->descricao }}" data-img="{{ $produto->image }}"
                                    value="0" disabled="disabled">


                            </div>
                            <div class="collapse" id="mProduto{{ $produto->id }}">
                                <p class="small text-center">Opções para o seu {{ $produto->titulo }}</p>

                                <ul class="list-group adicionados{{ $produto->id }}">
                                    @foreach ($produto->produtoAdicionais as $adicional)
                                        <li class=' list-group-item'>
                                            <div class="row">
                                                <span class="col-6">
                                                    <span class="t">{{ $adicional->nome }}</span>
                                                    <span class="p">
                                                        <script>
                                                            document.write(f.format('{{ $adicional->valor }}'));

                                                        </script>
                                                    </span>
                                                </span>
                                                <span class="col-6">
                                                    <a class="btn btn-light" style="width: 32%;float:left"
                                                        onclick="maisAdicional({{ $produto->id }},{{ $adicional->id }},{{ $adicional->valor }})"><span
                                                            class="material-icons">
                                                            add
                                                        </span></a>
                                                    <input style="width: 33%;float:left"
                                                        class="form-control text-center child{{ $produto->id }} quantidadeAd{{ $produto->id }}-{{ $adicional->id }} qt"
                                                        type="text" data-who="{{ $adicional->nome }}"
                                                        data-id="{{ $adicional->id }}" value="0" disabled="disabled"
                                                        style="width:60px">

                                                    <a class="btn btn-light" style="width:32%;float:left"
                                                        onclick="menosAdicional({{ $produto->id }},{{ $adicional->id }},{{ $adicional->valor }})"><span
                                                            class="material-icons">
                                                            remove
                                                        </span></a>
                                                </span>
                                                <div>
                                        </li>
                                    @endforeach

                                    <button type="button" class="btn btn-primary"
                                        onclick="novoProdutoComAdicional({{ $produto->id }},{{ $produto->preco }})">Concluir</button>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-12" style="margin-top:25px">
                        <div style="box-shadow: 0px 0px 20px -13px rgb(0 0 0);
            border-radius:15px; background:white; margin:-5px;padding:10px;heigth:100px" class="row">
                            <div class="col-3">
                                <div class="image-cropper">
                                    <img 
                    onerror="this.src='semFoto.jpg';" src="storage/{{ $produto->image }}" class="profile-pic">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="titulo{{ $produto->id }} t">
                                    {{ $produto->titulo }}
                                </div>
                                <div class="preco{{ $produto->id }} p">
                                    <script>
                                        document.write(f.format('{{ $produto->preco }}'));

                                    </script>
                                </div>
                                <div class="preco{{ $produto->id }} d small">
                                    {{ $produto->descricao }}
                                </div>
                            </div>
                            <div class="col-3 text-center">

                                <a class="btn btn-light" style="width: 32%;float:left"
                                    onclick="mais({{ $produto->id }},{{ $produto->preco }})"><span
                                        class="material-icons">
                                        add
                                    </span></a>

                                <input style="width: 32%;float:left"
                                    class="form-control text-center quantidade qt{{ $produto->id }}" type="text"
                                    data-who="{{ $produto->titulo }}" data-id="{{ $produto->id }}" value="0"
                                    disabled="disabled" style="width:60px">

                                <a class="btn btn-light" style="width: 32%;float:left"
                                    onclick="menos({{ $produto->id }},{{ $produto->preco }})"><span
                                        class="material-icons">
                                        remove
                                    </span></a>

                            </div>
                        </div>
                    </div>
                @endif
            @endforeach --}}
            <div style="display: block; width:100%">
                <h5 class="text-center">Produtos</h5>
            </div>
            @foreach ($categorias as $c)

                @if (count($c->produtos) > 0)
                    <b style="margin-top: 20px">{{ $c->titulo }}</b>
                @endif
                @foreach ($c->produtos as $produto)
                    @if (count($produto->ProdutoAdicionais) > 0)
                        <div class="col-12 adicionavel{{ $produto->id }}" id="avel{{ $produto->id }}"
                            style="margin-top:25px">
                            <div style="box-shadow: 0px 0px 20px -13px rgb(0 0 0);border-radius:15px; background:white; margin:-5px;padding:10px;heigth:100px"
                                class="row">
                                <div class="col-3">
                                    <div class="image-cropper">
                                        <img 
                    onerror="this.src='semFoto.jpg';" src="storage/{{ $produto->image }}" class="profile-pic">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="titulo{{ $produto->id }} t">
                                        {{ $produto->titulo }}
                                    </div>
                                    <div class="preco{{ $produto->id }} p">
                                        <script>
                                            document.write(f.format('{{ $produto->preco }}'));

                                        </script>
                                    </div>
                                    <div class="preco{{ $produto->id }} d small">
                                        {{ $produto->descricao }}
                                    </div>
                                </div>
                                <div class="col-3 text-center">

                                    <a class="btn btn-light open{{ $produto->id }}" style="width: 100%"
                                        data-toggle="collapse" onclick="showCloser('{{ $produto->id }}')"><span
                                            class="material-icons">
                                            add
                                        </span></a>
                                    <a class="btn btn-light close{{ $produto->id }}"
                                        style="width: 100%; display:none"
                                        onclick="hideCloser('{{ $produto->id }}')"><span class="material-icons">
                                            remove
                                        </span></a>
                                    <input class="quantidade{{ $produto->id }} qt" type="hidden"
                                        data-who="{{ $produto->titulo }}" data-id="{{ $produto->id }}"
                                        data-desc="{{ $produto->descricao }}" data-img="{{ $produto->image }}"
                                        value="0" disabled="disabled">


                                </div>
                                <div class="collapse" id="mProduto{{ $produto->id }}">
                                    <br>
                                    <div class="small text-center">Opções para o seu {{ $produto->titulo }}</div>

                                    <ul class="list-group adicionados{{ $produto->id }}">
                                        @foreach ($produto->produtoAdicionais as $adicional)
                                            <li class=' list-group-item'>
                                                <div class="row">
                                                    <span class="col-6">
                                                        <span class="t">{{ $adicional->nome }}</span><br>
                                                        <span class="p">
                                                            <script>
                                                                document.write(f.format('{{ $adicional->valor }}'));

                                                            </script>
                                                        </span>
                                                    </span>
                                                    <span class="col-6">
                                                        <a class="btn btn-light" style="width: 32%;float:left"
                                                            onclick="maisAdicional({{ $produto->id }},{{ $adicional->id }},'{{ $adicional->valor }}')"><span
                                                                class="material-icons">
                                                                add
                                                            </span></a>
                                                        <input style="width: 33%;float:left"
                                                            class="form-control text-center child{{ $produto->id }} quantidadeAd{{ $produto->id }}-{{ $adicional->id }} qt"
                                                            type="text" data-who="{{ $adicional->nome }}"
                                                            data-id="{{ $adicional->id }}" value="0"
                                                            disabled="disabled" style="width:60px">

                                                        <a class="btn btn-light" style="width:32%;float:left"
                                                            onclick="menosAdicional({{ $produto->id }},{{ $adicional->id }},'{{ $adicional->valor }}')"><span
                                                                class="material-icons">
                                                                remove
                                                            </span></a>
                                                    </span>
                                                    <div>
                                            </li>
                                        @endforeach

                                        <button type="button" class="btn btn-primary"
                                            onclick="novoProdutoComAdicional({{ $produto->id }},'{{ $produto->preco }}')">Concluir</button>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-12" style="margin-top:25px">
                            <div style="box-shadow: 0px 0px 20px -13px rgb(0 0 0);
                border-radius:15px; background:white; margin:-5px;padding:10px;heigth:100px" class="row">
                                <div class="col-3">
                                    <div class="image-cropper">
                                        <img 
                    onerror="this.src='semFoto.jpg';" src="storage/{{ $produto->image }}" class="profile-pic">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="titulo{{ $produto->id }} t">
                                        {{ $produto->titulo }}
                                    </div>
                                    <div class="preco{{ $produto->id }} p">
                                        <script>
                                            document.write(f.format('{{ $produto->preco }}'));

                                        </script>
                                    </div>
                                    <div class="preco{{ $produto->id }} d small">
                                        {{ $produto->descricao }}
                                    </div>
                                </div>
                                <div class="col-3 text-center">

                                    <a class="btn btn-light" style="width: 100%"
                                        onclick="mais({{ $produto->id }},{{ $produto->preco }})"><span
                                            class="material-icons">
                                            add
                                        </span></a>

                                    <input style="width: 100%"
                                        class="form-control text-center quantidade qt{{ $produto->id }}" type="text"
                                        data-who="{{ $produto->titulo }}" data-id="{{ $produto->id }}" value="0"
                                        disabled="disabled" style="width:60px">

                                    <a class="btn btn-light" style="width: 100%"
                                        onclick="menos({{ $produto->id }},{{ $produto->preco }})"><span
                                            class="material-icons">
                                            remove
                                        </span></a>

                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endforeach

        </div>
    </div>
    <div class="footer" style="
    height: 100px;
    width: 100%;
    border-top-left-radius: 35px;
    border-top-right-radius: 35px;
    background:white;
">
        <div class="hide etapa2" style="width: 80%; margin: 0 auto;">
            <h2 class="text-center">
                <span class="material-icons">
                    person
                </span>
            </h2>
            <br>
            <div class="form-group row">
                <label for="whatsapp" class="col-md-4 col-form-label text-md-right">Whatsapp *</label>

                <div class="col-md-6">
                    <input id="whatsapp" type="tel" class="form-control " name="whatsapp" value="" required="true"
                        placeholder="Exclusivo para o atendimento" autocomplete="tel"
                        onkeyup="buscaCadastroPorWhatsapp('#whatsapp')">
                </div>
            </div>
            <div class="form-group row ">
                <label for="name" class="col-md-4 col-form-label text-md-right">Nome *</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control " onkeyup="callbackNome()" name="name" value=""
                        required="" placeholder="Como gostaria de ser chamado?" autocomplete="name">
                </div>
            </div>
            <hr>
            <div class="etapa22 hide">
                <br>
                <h2 class="text-center">
                    <span class="material-icons">
                        place
                    </span>

                </h2>
                <br>
                <hr>
                <h5>Forma de Entrega</h5>
                @foreach ($entrega as $e)
                    <div class="">
                        <br>
                        <label>
                            <input type="radio" class="entrega" name="e" value="{{ $e->titulo }}"
                                data-id="{{ $e->id }}">
                            {{ $e->titulo }}
                        </label>
                    </div>
                @endforeach
                <br>

                <div class="form-group row enderecoEscondido" style="display: none">
                    <label for="end" class="col-md-4 col-form-label text-md-right">Endereço com número</label>
                    <div class="col-md-6">
                        <input id="searchTextField" type="text" class="form-control" name="searchTextField">
                    </div>
                </div>
                <br>
                <br>
                <h5>Forma de Pagamento</h5>
                @foreach ($pagamento as $e)
                    <div class="">
                        <br>

                        <label>
                            <input type="radio" class="pagamento" name="p" value="{{ $e->titulo }}"
                                data-id="{{ $e->id }}">
                            {{ $e->titulo }}
                        </label>
                    </div>
                @endforeach

                <hr>
                <h5>Observação</h5>
                    <div class="form-group">
                        <textarea class="form-control" id="observacao" name="observacao" rows="3"></textarea>
                    </div>

                <a style="box-shadow: rgb(0, 0, 0) 3px 3px 20px -7px;
            background-color: rgb(62, 69, 170);
            color: rgb(161, 219, 245);
            border-top-left-radius: 30px;
            border-top-right-radius: 30px;
            border-bottom-right-radius: 30px;
            border-bottom-left-radius: 30px;
            margin-top:40px;" class="btn btn-block btn-lg finalizaPedido"
                    onclick="send('{{ csrf_token() }}')">Finalizar Pedido</a>

            </div>
            <div style="margin-top:30px" class="carrinho etapa2 hide">
            </div>
        </div>
        <div class="etapa3 hide text-center" style="width: 80%;margin:0 auto;">
            <span class="material-icons" style="font-size: 13em; color:greenyellow">
                check_circle_outline
            </span>

            <h4>Seu pedido foi recebido, em breve entraremos em contato.</h4>
            <br>
            <b>Que tal reforçar seu pedido pelo Whatsapp?</b>
            <a style="box-shadow: rgb(0, 0, 0) 3px 3px 20px -7px;
                background-color: rgb(62, 170, 67);
                color: rgb(161, 245, 172);
                border-top-left-radius: 30px;
                border-top-right-radius: 30px;
                border-bottom-right-radius: 30px;
                border-bottom-left-radius: 30px;
                margin-top:40px;" class="btn btn-block btn-lg " onclick="msg('{{ $fone }}')">
                Enviar Mensagem
                <span class="material-icons" style="float: right;
                margin-right: 15px;">
                    send
                </span>
            </a>
            <a style="box-shadow: rgb(0, 0, 0) 3px 3px 20px -7px;
                background: #3e45aa;
                color: #a1dbf5;
                border-top-left-radius: 30px;
                border-top-right-radius: 30px;
                border-bottom-right-radius: 30px;
                border-bottom-left-radius: 30px;
                margin-top:40px;" class="btn btn-block btn-lg " href="/">

                Novo Pedido
                <span class="material-icons" style="float: right;
                margin-right: 15px;">
                    shopping_cart
                </span>
            </a>

        </div>
        <div class="totales">
            <a style="

@if ($info->aberto == 1) color: #3e45aa; @endif
                @if ($info->aberto == 0)
                    color: #202121
                @endif

                float: left;
                margin-left: 40px;
                margin-top: 20px;
                "><span style="font-size:3em;" class="total">0.00</span><small>R$</small>
            </a>
        </div>

        <a class="main-button go" onclick="showFooter({{ $info->aberto }});" style="
            box-shadow: 3px 3px 20px -7px rgb(0 0 0);
            @if ($info->aberto == 1) background: #3e45aa;
            color: #a1dbf5;
            margin-top: 30px; @endif
            @if ($info->aberto == 0)
                margin-top: -50px;
                background: #79797d;
                color: #202121;
            @endif
            border-radius: 30px;
            padding: 12px;
            float: right;
            margin-right: 30px;
            position: relative;`
            "><span class="material-icons">
                @if ($info->aberto == 1)
                    local_grocery_store
                @endif
                @if ($info->aberto == 0)
                    airplanemode_inactive
                @endif
            </span>
        </a>
        <a class="main-button cancel" onclick="hideFooter();" style="
            box-shadow: 3px 3px 20px -7px rgb(0 0 0);
            background: #3e45aa;
            color: #a1dbf5;
            border-radius: 30px;
            padding: 12px;
            float: right;
            margin-right: 30px;
            margin-top: 30px;
            position: relative;
            display:none;
            "><span class="material-icons">
                close
            </span></a>

    </div>
    <script>
        var input = document.getElementById('searchTextField');
        new google.maps.places.Autocomplete(input);

        jQuery("#whatsapp")
            .mask("(99) 99999-9999")
            .focusout(function(event) {
                var target, phone, element;
                target = (event.currentTarget) ? event.currentTarget : event.srcElement;
                phone = target.value.replace(/\D/g, '');
                element = $(target);
                element.unmask();
                element.mask("(99) 99999-9999");

            });

    </script>
</body>

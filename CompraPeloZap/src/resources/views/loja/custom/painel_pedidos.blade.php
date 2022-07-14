@extends('layouts.admin') @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="container">
                    <h5>Pedidos</h5>
                    <div class="container">
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="">Por Status</label>
                                <select class="form-control porStatus" onchange="porStatus(this);">
                                    <option value="abertos">Abertos</option>
                                    <option value="todos">Todos</option>
                                    <option value="cancelados">Cancelados</option>
                                    <option value="finalizados">Finalizados</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Por Palavra-Chave</label>
                                <input class="form-control porPalavra" onkeyup="porPalavra(this);">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="container">
                    <div class="row">
                        @foreach ($pedidos as $pedido)
                            <div class="col-md-4 " style='
                        @if ($pedido->status != 0) display:none @endif
                        '>
                                @if ($pedido->status == 1)
                                    <div style="background: thistle;" class="card SearchIn cancelados todos">
                                @endif
                                @if ($pedido->status == 2)
                                    <div style="background: springgreen" class="card  SearchIn finalizados todos">
                                @endif
                                @if ($pedido->status == 0)
                                    <div class="SearchIn abertos todos card ">
                                @endif
                                <div class="card-header">
                                    Cliente: <strong>{{ $pedido->user->name }}</strong><br>
                                    Telefone: <strong>{{ $pedido->user->whatsapp }}</strong><br>
                                    Total: <strong>{{ 'R$ '.number_format($pedido->total, 2, ',', '.') }}</strong>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <!-- Button to Open the Modal -->
                                        <button type="button" class="btn btn-primary col-12 mb-2" data-toggle="modal"
                                            data-target="#myModal{{ $pedido->id }}">
                                            DETALHES
                                        </button>

                                        <!-- The Modal -->
                                        <div class="modal" id="myModal{{ $pedido->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4>{{ 'R$ '.number_format($pedido->total, 2, ',', '.') }} em Produtos</h4>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <div class="container">
                                                            <div class="row justify-content-center">
                                                                <table class="table">
                                                                    <tr>
                                                                        <th>Categoria</th>
                                                                        <th>Titulo</th>
                                                                        <th>Preço</th>
                                                                        <th>Quantidade</th>
                                                                    </tr>
                                                                    @foreach ($pedido->produtosPedido as $produto)
                                                                        <tr>
                                                                            <td>
                                                                                <b>{{ $ref[$produto->produto->categoria_produtos_id] }}</b>
                                                                            </td>
                                                                            <td>
                                                                                <b>{{ $produto->produto->titulo }}</b>
                                                                            </td>
                                                                            <td>
                                                                                <b> {{ 'R$ '.number_format($produto->produto->preco, 2, ',', '.') }} </b>
                                                                            </td>
                                                                            <td>
                                                                                <b>{{ $produto->quantidade }}</b>
                                                                            </td>
                                                                        </tr>
                                                                        @foreach ($produto->produto->adicionais as $add)
                                                                            <tr>
                                                                                <td>
                                                                                    <b>Adicional</b>
                                                                                </td>
                                                                                <td>
                                                                                    <b>{{ $add->nome }}</b>
                                                                                </td>
                                                                                <td>
                                                                                    <b>
                                                                                           {{ 'R$ '.number_format($add->valor, 2, ',', '.') }}

                                                                                    </b>
                                                                                </td>
                                                                                <td>
                                                                                    <b>{{ $add->quantidade }}</b>
                                                                                </td>
                                                                            </tr>

                                                                        @endforeach
                                                                    @endforeach
                                                                </table>
                                                            </div>
                                                            <hr>
                                                            <h5>Observação</h5>

                                                            <div class="form-group">
                                                                <textarea disabled="disabled" class="form-control"
                                                                    rows="3">{{ $pedido->observacao }}</textarea>
                                                            </div>

                                                            <hr>

                                                            <h5>Forma de Entrega</h5>
                                                            <div class="">
                                                                <b>{{ $pedido->formaEntrega->titulo }}</b>
                                                            </div>
                                                            <br>
                                                            <h5>Forma de Pagamento</h5>
                                                            <div class="">
                                                                <b>{{ $pedido->formaPagamento->titulo }}</b>
                                                            </div>
                                                            <br>
                                                            <h5>Endereço</h5>
                                                            <div class="">
                                                                {{ $pedido->endereco }}<br>
                                                                <br>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default btn-block"
                                                            data-dismiss="modal">FECHAR</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div>
                                        @if ($pedido->status == 0)
                                            <td>
                                                <a class="btn btn-danger col-12 mb-2"
                                                    href="/updateStatusPedido/{{ $pedido->id }}/1">CANCELAR</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-success col-12"
                                                    href="/updateStatusPedido/{{ $pedido->id }}/2">FINALIZAR</a>
                                            </td>
                                        @endif
                                        @if ($pedido->status == 1)
                                            <td>
                                                CANCELADO
                                            </td>
                                            <td>
                                            </td>
                                        @endif
                                        @if ($pedido->status == 2)
                                            <td>
                                                <a class="btn btn-danger col-12 mb-2"
                                                    href="/updateStatusPedido/{{ $pedido->id }}/1">CANCELAR</a>
                                            </td>
                                            <td>
                                                FINALIZADO
                                            </td>
                                        @endif
                                    </div>
                                </div>
                            </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

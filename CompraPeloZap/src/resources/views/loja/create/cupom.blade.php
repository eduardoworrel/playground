@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Cupom</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('createCupom') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="codigo" class="col-md-4 col-form-label text-md-right">Código</label>

                            <div class="col-md-6">
                                <input id="codigo" type="text" class="form-control @error('codigo') is-invalid @enderror" name="codigo" value="{{ old('codigo') }}" required autocomplete="codigo" autofocus> @error('codigo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span> @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="valor" class="col-md-4 col-form-label text-md-right">Valor</label>

                            <div class="col-md-6">
                                <input id="valor" type="number" class="form-control @error('valor') is-invalid @enderror" name="valor" value="{{ old('valor') }}" required autocomplete="valor" autofocus> @error('valor')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span> @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="datahora_inicio_validade" class="col-md-4 col-form-label text-md-right">Inicio Validade</label>

                            <div class="col-md-6">
                                <input id="datahora_inicio_validade" type="date" class="form-control @error('datahora_inicio_validade') is-invalid @enderror" name="datahora_inicio_validade" value="{{ old('datahora_inicio_validade') }}" required autocomplete="datahora_inicio_validade" autofocus> @error('datahora_inicio_validade')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="datahora_fim_validade" class="col-md-4 col-form-label text-md-right">Fim validade</label>

                            <div class="col-md-6">
                                <input id="datahora_fim_validade" type="date" class="form-control @error('datahora_fim_validade') is-invalid @enderror" name="datahora_fim_validade" value="{{ old('datahora_fim_validade') }}" required autocomplete="datahora_fim_validade" autofocus> @error('datahora_fim_validade')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span> @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Salvar
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
        @foreach($cupoms as $cupom)
        <div class="col-md-4">
            <div class="card mx-2 my-2">
                <div class="card-header">
                    {{$cupom->codigo}}
                </div>
                <div class="card-body">
                    <div>
                        Valor: <b>{{ $cupom->valor }}</b>
                        <hr>
                        Data Inicio: <b>{{$cupom->datahora_inicio_validade}}</b>
                        <hr>
                        Data Fim: <b>{{$cupom->datahora_fim_validade}}</b>
                    </div>
                    <hr>
                    <div>
                        <!-- Button to Open the Modal -->
                        <button type="button" class="btn btn-primary col-12 mb-2" data-toggle="modal" data-target="#myModal">
                            EDITAR
                          </button>

                          <!-- The Modal -->
                          <div class="modal" id="myModal">
                            <div class="modal-dialog">
                              <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                  <h4 class="modal-title">Categoria</h4>
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <div class="container">
                                    <form  id="form{{$cupom->id}}"  action="{{route('editCupom')}}" method="POST">
                                        @csrf
                                            <div class="form-group row">
                                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Código</label>
                                                <div class="col-md-6">
                                                    <input class="form-control" type="text" value="{{$cupom->codigo}}" name="titulo">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="valor" class="col-md-4 col-form-label text-md-right">Valor</label>
                                                <div class="col-md-6">
                                                    <input class="form-control" type="number" value="{{$cupom->valor}}" name="valor">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inicio" class="col-md-4 col-form-label text-md-right">Inicio Validade</label>
                                            <div class="col-md-6">
                                                <input class="form-control"
                                                 type="date" value="{{$cupom->datahora_inicio_validade}}" name="datahora_inicio_validade">
                                            </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="fim" class="col-md-4 col-form-label text-md-right">Fim Validade</label>
                                            <div class="col-md-6">
                                                <input class="form-control"
                                                 type="date" value="{{$cupom->datahora_fim_validade}}" name="datahora_fim_validade">
                                            </div>
                                        </div>

                                        <div class="row">
                                        <input type="hidden" value="{{$cupom->id}}" name="id"  >
                                        </div>
                                    </form>
                                    </div>
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button class="btn btn-warning"onclick=" document.getElementById('form{{$cupom->id}}').submit();">EDITAR</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>

                              </div>
                            </div>
                          </div>

                          <div>
                              <form action="{{route('deleteCupom')}}" method="POST">
                                  @csrf
                                  <input type="hidden" value="{{$cupom->id}}" name="id">
                                  <button class="btn btn-danger col-12">EXCLUIR</button>
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
@endsection

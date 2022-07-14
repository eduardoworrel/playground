@extends('layouts.admin') @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Formas de Pagamento</div>
                <div class="card-body">
                <form method="POST" action="{{ route('createFormaPagamento') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="formaPagamento" class="col-md-4 col-form-label text-md-right">Titulo</label>

                            <div class="col-md-6">
                                <input id="formaPagamento" type="text" class="form-control @error('formaPagamento') is-invalid @enderror" name="formaPagamento" value="{{ old('formaPagamento') }}" required autocomplete="formaPagamento" autofocus> @error('formaPagamento')
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
            <div class="row">
        @foreach($formaPagamentos as $formaPagamento)
            <div class="col-md-4">
                <div class="card mx-2 my-2">
                    <div class="card-header">
                        {{$formaPagamento->titulo}}
                    </div>
                    <div class="card-body">
                            <div>
                                <form id="editFormaPagamento{{$formaPagamento->id}}" action="{{route('editFormaPagamento')}}" method="POST">
                                    @csrf

                                    <input class="form-control" type="text" value="{{$formaPagamento->titulo}}" name="titulo">
                                    <hr>
                                    <input type="hidden" value="{{$formaPagamento->id}}" name="id">
                                    <button class="btn btn-warning col-12 mb-2">EDITAR</button>
                                </form>
                            </div>
                            <div>
                                 <form id="editFormaPagamento{{$formaPagamento->id}}" action="{{route('deleteFormaPagamento')}}" method="POST">
                                     @csrf
                                     <input type="hidden" value="{{$formaPagamento->id}}" name="id">
                                     <button class="btn btn-danger col-12">EXCLUIR</button>
                                 </form>
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

@extends('layouts.admin') @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Formas de Entrega</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('createFormaEntrega') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="formaEntrega" class="col-md-4 col-form-label text-md-right">Titulo</label>

                            <div class="col-md-6">
                                <input id="formaEntrega" type="text" class="form-control @error('formaEntrega') is-invalid @enderror" name="formaEntrega" value="{{ old('formaEntrega') }}" required autocomplete="formaEntrega" autofocus> @error('formaEntrega')
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
        @foreach($formaEntregas as $formaEntrega)
        <div class="col-md-4">
            <div class="card mx-2 my-2">
                <div class="card-header">
                    {{$formaEntrega->titulo}}
                </div>
                <div class="card-body">
                        <div>
                            <form id="editFormaEntrega{{$formaEntrega->id}}" action="{{route('editFormaEntrega')}}" method="POST">
                                @csrf
                                <input class="form-control" type="text" value="{{$formaEntrega->titulo}}" name="titulo">
                                <hr>
                                <input type="hidden" value="{{$formaEntrega->id}}" name="id">
                                <button class="btn btn-warning col-12 mb-2">EDITAR</button>
                            </form>
                        </div>
                        <div>
                            <form id="editFormaEntrega{{$formaEntrega->id}}" action="{{route('deleteFormaEntrega')}}" method="POST">
                                @csrf
                                <input type="hidden" value="{{$formaEntrega->id}}" name="id">
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

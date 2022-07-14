@extends('layouts.admin') @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Categoria</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('createCategoria') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="categoria" class="col-md-4 col-form-label text-md-right">Titulo</label>

                            <div class="col-md-6">
                                <input id="categoria" type="text" class="form-control @error('categoria') is-invalid @enderror" name="categoria" value="{{ old('categoria') }}" required autocomplete="categoria" autofocus> @error('categoria')
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
        <div class="col-md-8">
            <div class="container">
                <div class="row justify-content-center">
                    @foreach($categorias as $categoria)
                        <div class="col-md-4">
                            <div class="card mx-2 my-2">
                                <div class="card-header">
                                    {{$categoria->titulo}}
                                </div>
                                <div class="card-body">
                                    <div>
                                        <form id="editCategoria{{$categoria->id}}" action="{{route('editCategoria')}}" method="POST">
                                            @csrf
                                            <input class="form-control" type="text" value="{{$categoria->titulo}}" name="titulo">
                                            <input type="hidden" value="{{$categoria->id}}" name="id">
                                            <hr>
                                            <button class="btn btn-warning col-12 mb-2">EDITAR</button>
                                        </form>
                                    </div>
                                    <div>
                                        <form id="editCategoria{{$categoria->id}}" action="{{route('deleteCategoria')}}" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{$categoria->id}}" name="id">
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

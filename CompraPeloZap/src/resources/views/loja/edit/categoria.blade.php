@extends('layouts.app') @section('content')
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
<div class="container">
    <div class="row justify-content-center">
        <table class="table">
            <tr>
                <th>Titulo</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
            @foreach($categorias as $categoria)
            <tr>
                <td>
                    <b>{{$categoria->titulo}}</b>
                </td>
                <td>
                    <form id="editCategoria{{$categoria->id}}" action="{{route('editCategoria')}}" method="POST">
                        @csrf
                        <div class="row">
                            <input class="form-control col-4" type="text" value="{{$categoria->titulo}}" name="titulo">
                        <input type="hidden" value="{{$categoria->id}}" name="id">
                        <button class="btn btn-warning col-2">EDITAR</button>
                        </div>
                    </form>
                </td>
                <td>
                    <form id="editCategoria{{$categoria->id}}" action="{{route('deleteCategoria')}}" method="POST">
                        @csrf
                        <input type="hidden" value="{{$categoria->id}}" name="id">
                        <button class="btn btn-danger">EXCLUIR</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
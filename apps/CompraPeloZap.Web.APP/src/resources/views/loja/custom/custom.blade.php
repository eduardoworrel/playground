@extends('layouts.admin')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      @if($errors->any())
        <ul>
          @foreach($errors->all() as $error)
          <li>{{$error}}</li>
          @endforeach
        </ul>
      @endif
      <div class="card">
         <div class="card-header">Personalização da loja</div>
            <div class="card-body">
              <form action="{{ route('personalizacaoUpdate', $personalizacao->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                  <div class="form-group">
                    <label for="logo">Logo</label>
                    <input type="file" name="logo" class="form-control-file" id="logo">
                  </div>
                  <hr>
                  <div class="form-group row">
                    <label for="titulo" class="col-md-4 col-form-label text-md-right">{{ __('Titulo da loja') }}</label>

                    <div class="col-md-6">
                    <input id="titulo" type="text" class="form-control" value="{{ $infoLoja->titulo }}" name="titulo" required autocomplete="titulo">
                    </div>
                </div>

                <div class="form-group row">
                   <label for="subtitulo" class="col-md-4 col-form-label text-md-right">{{ __('Subtitulo da loja') }}</label>
                  <div class="col-md-6">
                      <input id="subtitulo" type="text" class="form-control" value="{{$infoLoja->subtitulo }}" name="subtitulo" required autocomplete="subtitulo">
                  </div>
                </div>

                <div class="form-group row">
                    <label for="contato_loja" class="col-md-4 col-form-label text-md-right">{{ __('Contato da loja') }}</label>

                    <div class="col-md-6">
                        <input id="contato_loja" type="text" class="form-control" value="{{ $infoLoja->contato_loja }}" name="contato_loja" required autocomplete="contato_loja">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="endereco" class="col-md-4 col-form-label text-md-right">{{ __('Endereço da loja') }}</label>

                    <div class="col-md-6">
                        <input id="endereco" type="text" class="form-control" value="{{ $infoLoja->endereco }}" name="endereco" required>
                    </div>
                </div>

                  <button type="submit" class="btn btn-success">Atualizar</button>
              </form>
          </div>
        </div>
      </div>

     </div>
  </div>
</div>



@endsection

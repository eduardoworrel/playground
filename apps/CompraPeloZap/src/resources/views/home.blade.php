@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                    <div class="visible-print text-center">
                        <p>Minha loja</p>

                        @if($info->aberto == 1)
                            <div class="isOpenLoja aberto" style="text-align: center">
                                <h4 id="legendaIsOp">
                                    <span class="material-icons">
                                        light_mode
                                        </span><br>
                                        ABERTO
                                </h4>
                                <div onclick="openLoja(this)" data-value='0' class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
                                    FECHAR
                                </div>
                            </div>
                        @endif
                        @if($info->aberto == 0)
                            <div class="isOpenLoja fechado" style="text-align: center">
                                <h4 id="legendaIsOp">
                                    <span class="material-icons">
                                        airplanemode_inactive
                                        </span><br>FECHADO
                                </h4>
                                <div onclick="openLoja(this)" data-value='1'  class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
                                    ABRIR
                                </div>
                            </div>
                        @endif
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <h4>Faturamento hoje<br> <b>{{ 'R$ '.number_format($info->totalHoje, 2, ',', '.') }}</b></h4>
            <h5>Faturamento total<br> <b>{{ 'R$ '.number_format($info->totalObtido, 2, ',', '.') }}</b></h5>
        </div>
    </div>
</div>

@endsection

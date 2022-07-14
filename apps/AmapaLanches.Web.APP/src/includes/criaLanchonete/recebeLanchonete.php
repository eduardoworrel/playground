<?php

session_start();
include_once '../includes/input_filter.php';
include_once '../includes/modelo/conexao.php';
include_once '../includes/classes/lanchonete.php';
include_once '../includes/classes/usuario.php';

$param = post("param");
if ($param == 4) {
    $lan = unserialize(session('lanchonete'));
    if ($lan != null) {

        $segredo = post("segredo");
        if ($segredo === "[]") {
            $lan->titulo = post("titulo");
            $lan->subTitulo = post('subtitulo');
            $lan->bairro = post('bairro');
            $lan->informativo = post('info');
            $lan->horaAbre = post('hora_abre');
            $lan->horaFecha = post('hora_fecha');
            $lan->telefone = post('telefone');
            $lan->entrega = post('entrega');
            $lan->aceita_cartao = post('cartao');
            $lan->latitude = post("lat");
            $lan->longitude = post("lng");
            $c = new conexao();
            $arr = [$lan];
            $return = $c->getObject($arr, "autenticarLanchonete");
            if ($return == 1) {
                echo "0";
            } else {
                echo "1";
            }
        }
    }
}







    
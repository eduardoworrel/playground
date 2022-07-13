<?php

include_once '../modelo.php';
include_once '../input_filter.php';
session_start();
$param = post('param');
$idL = session("IDD_LANCHONETE");
if ($param == 1) {
    $c = new conexao();
    $arr = [$idL, post('tipo'), post('titulo'), post('preco'), post('ingredientes')];
    echo $c->getObject($arr, 'salvaLanche');
}




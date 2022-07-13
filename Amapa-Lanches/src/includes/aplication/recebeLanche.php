<?php

include_once '../input_filter.php';
include_once '../modelo/conexao.php';
include_once '../classes/lanche.php';
include_once '../classes/lanchonete.php';
include_once '../classes/cardapio.php';
session_start();
$param = post('param');
if ($param == 1) {
    $lanche = new lanche();
    $lanche->titulo = post('titulo');
    $lanche->preco = post('preco');
    $lanche->ingredientes = post('ingredientes');
    $arr = [$lanche->titulo, $lanche->preco, $lanche->ingredientes];
    $lanchonete = unserialize(session('lanchonete'));
    $lanchonete->cardapio->addLanche($lanche);
    $_SESSION['lanchonete'] = serialize($lanchonete);
    include '../estrutura/listaLanches.php';
}




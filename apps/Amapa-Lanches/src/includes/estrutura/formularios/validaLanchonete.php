<?php

include_once '../../input_filter.php';
include_once '../../modelo/conexao.php';
include_once '../../classes/lanchonete.php';
include_once '../../classes/cardapio.php';
include_once '../../classes/lanche.php';
session_start();
$lanchonete = new lanchonete();
$lat = post('lat');
$lng = post('lng');
$lanchonete->latitude = $lat;
$lanchonete->longitude = $lng;
$_SESSION['lanchonete'] = serialize($lanchonete);
include 'continueLanchonete.html';

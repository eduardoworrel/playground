<?php

session_start();
include_once '../classes/lanchonete.php';
include_once '../classes/usuario.php';
include_once '../input_filter.php';
include_once '../modelo/conexao.php';
$lan = unserialize(base64_decode(session("lanchonete")));

if (isset($lan)) {
    $v = post('v');
    $c = new conexao();
    $lanchonete = $c->getObject([$lan->id], 'buscaLanchoneteById');

    $post_data = json_encode(array("id" => $lan->id, "lat" => $lanchonete->latitude, "lng" => $lanchonete->longitude));
    Header('Content-type: text/json;utf-8');
    print($post_data);
} else {
    print('erro');
}
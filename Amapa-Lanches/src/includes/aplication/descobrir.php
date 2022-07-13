<?php

session_start();
include_once '../classes/usuario.php';
include_once '../modelo/conexao.php';
include_once '../input_filter.php';
$param = (string) post('param');
$lat = post('lat');
$lng = post('lng');
if ($param == 1) {
    $c = new conexao();
    $TOPlanchonetes = $c->getObject([], 'top5');
    $NEARlanchonetes = $c->getObject([$lat, $lng], 'proximas5');
    if (is_array($TOPlanchonetes)) {
        $xml = new SimpleXMLElement('<dados/>');
        foreach ($TOPlanchonetes as $lanchonete) {
            $avaliacao = $c->getObject([$lanchonete['ID_LANCHONETE']], 'getAvaliation');
            $obj = $xml->addChild('lanchonete');
            $obj->addChild("id", $lanchonete['ID_LANCHONETE']);
            $obj->addChild("titulo", $lanchonete['TITULO']);
            $obj->addChild("subTitulo", $lanchonete['SUBTITULO']);
            $obj->addChild("horaAbre", $lanchonete['HORA_ABRE']);
            $obj->addChild("horaFecha", $lanchonete['HORA_FECHA']);
            $obj->addChild("avaliacao", $avaliacao);
        }
    }

    if (is_array($NEARlanchonetes)) {
        foreach ($NEARlanchonetes as $lanchonete) {
            $avaliacao = $c->getObject([$lanchonete['ID_LANCHONETE']], 'getAvaliation');
            $obj = $xml->addChild('lanchonete');
            $obj->addChild("id", $lanchonete['ID_LANCHONETE']);
            $obj->addChild("titulo", $lanchonete['TITULO']);
            $obj->addChild("subTitulo", $lanchonete['SUBTITULO']);
            $obj->addChild("horaAbre", $lanchonete['HORA_ABRE']);
            $obj->addChild("horaFecha", $lanchonete['HORA_FECHA']);
            $obj->addChild("avaliacao", $avaliacao);
        }
        Header('Content-type: text/xml;utf-8');
        print($xml->asXML());
    }
}
 
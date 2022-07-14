<?php

session_start();
include '../aplication/util.php';
include '../modelo/conexao.php';
include '../classes/lanchonete.php';
include '../classes/usuario.php';
include '../input_filter.php';
include 'util/isOpen.php';

$c = new conexao();
$lanchonetes = lanchonete::todas($c->getconexao());

$_ = array();
if (is_array($lanchonetes)) {
    foreach ($lanchonetes as $lanchonete) {
        $avaliacao = $c->getObject([$lanchonete->id], 'getAvaliation');
        $hs = lanchonete::visto($lanchonete->id, $c->getconexao());
        $isOpen = isOpen(substr($lanchonete->horaAbre, 0, -3), substr($lanchonete->horaFecha, 0, -3));
        $_[] = array
            (
            "id" => $lanchonete->id,
            "isOpen" => $isOpen,
            "titulo" => $lanchonete->titulo,
            "subTitulo" => $lanchonete->subTitulo,
            "bairro" => $lanchonete->bairro,
            "horaAbre" => $lanchonete->horaAbre,
            "horaFecha" => $lanchonete->horaFecha,
            "lat" => $lanchonete->latitude,
            "lng" => $lanchonete->longitude,
            "avaliacao" => $avaliacao,
            "hasSee" => $hs,
            "aceita_cartao" => $lanchonete->aceita_cartao,
            "entrega" => $lanchonete->entrega,
            "hasSee" => $hs,
        );
    }
}

               
$post_data = json_encode(array("todas" => $_));
Header('Content-type: text/json;utf-8');
print($post_data);


<?php

session_start();
include '../classes/lanchonete.php';
include '../classes/comentario.php';
include '../classes/usuario.php';
include '../input_filter.php';
include '../modelo/conexao.php';
include '../../owasp-php-filters/testing/sanitize.php';
include 'util/isOpen.php';

$c = new conexao();
$word = (string) get("word");
if (check_html_string($word, 1, 30)) {
    $lanchonetes = $c->getObject([$word], 'caixaDePesquisa');
    $_ = array();
    if (is_array($lanchonetes)) {
        foreach ($lanchonetes as $lanchonete) {
            $avaliacao = $c->getObject([$lanchonete['ID_LANCHONETE']], 'getAvaliation');
            $howMuch = lanchonete::visto($lanchonete['ID_LANCHONETE'], $c->getconexao());
//            $isOpen = isOpen( $lanchonete['HORA_ABRE'], $lanchonete['HORA_FECHA']);
            $_[] = array
                (
                "id" => $lanchonete['ID_LANCHONETE'],
                "isOpen" => 1,
                "titulo" => $lanchonete['TITULO'],
                "subTitulo" => $lanchonete['SUBTITULO'],
                "bairro" => $lanchonete['BAIRRO'],
                "horaAbre" => $lanchonete['HORA_ABRE'],
                "horaFecha" => $lanchonete['HORA_FECHA'],
                "avaliacao" => $avaliacao,
                "hasSee" => $howMuch,
                "lat" => $lanchonete['LATITUDE'],
                "lng" => $lanchonete['LONGITUDE'],
                "aceita_cartao" => $lanchonete->aceita_cartao,
//            "telefone" => $lanchonete->telefone,
                "entrega" => $lanchonete->entrega,
            );
        }
    }
    $post_data = json_encode(array("lanchonetes" => $_));
    Header('Content-type: text/json;utf-8');
    print($post_data);
} else {
    $post_data = json_encode(array("lanchonetes" => []));
    print($post_data);
}



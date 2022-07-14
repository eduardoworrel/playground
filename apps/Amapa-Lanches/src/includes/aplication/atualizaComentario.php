<?php

session_start();
include '../../owasp-php-filters/testing/sanitize.php';
include '../aplication/util.php';
include_once '../input_filter.php';
include_once '../modelo/conexao.php';
include_once '../classes/usuario.php';
include_once '../classes/sessao.php';
include_once '../classes/comentario.php';
include_once '../classes/lanchonete.php';



$ss = unserialize(base64_decode(session('sessao')));
$ft;
if (isset($ss)) {
    $usr = $ss->usuario;
    if ($usr->permissao > 0) {
        $tk = unserialize(base64_decode(session('ask')));
        $tkInputed = post('data');

        if (isset($tkInputed)) {
            if ($tk === $tkInputed) {
                $lanchonete = unserialize(base64_decode(session("lanchonete")));
                if (isset($lanchonete)) {
                    $id = (int) $lanchonete->id;
                    $c = new conexao();
                    $coments = lanchonete::comentarios($id, 3, $c->getconexao());
                    $post_data = json_encode(array("comentarios" => $coments));
                    Header('Content-type: text/json;utf-8');
                    print($post_data);
                } else {
                    echo 3; // no lanchonete
                }
            } else {
                echo 4; // no tokenized
            }
        }
    } else {
        echo 5; // no permission
    }
} else {
    echo 6; 
}


<?php

session_start();
include_once '../../modelo/conexao.php';
include_once '../../classes/usuario.php';
include_once '../../classes/sessao.php';
include_once '../../input_filter.php';

$ss = unserialize(base64_decode(session('sessao')));
//var_dump($_SESSION);
$ft;
if (isset($ss)) {
    $c = new conexao();
    if ($ss->status == 0) {
        echo -2;
    } else {
        if ($ss->check($c->getconexao())) {
            echo $ss->usuario->signo;
            exit();
        } else {
            echo -3;
        }
    }
} else {
    echo -1;
}


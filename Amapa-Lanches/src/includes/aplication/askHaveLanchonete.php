<?php

include_once '../input_filter.php';
include_once '../modelo/conexao.php';
include_once '../classes/lanchonete.php';
include_once '../classes/cardapio.php';
include_once '../classes/lanche.php';
session_start();
$lat = post('lat');
$lng = post('lng');
$c = new conexao();
$int = $c->getObject([$lat, $lng], 'haveOther');

if (post("ac") == "del") {
    $c = new conexao();
    $int = $c->getObject([$lat, $lng], 'delNearAll');
    if ($int > 0) {
        echo '0';
    } else {
        echo '1';
    }
} else {
    $c = new conexao();
    $firtId = $c->getObject([$lat, $lng], 'isNearAll');
    if ($firtId > 0) {
        include '../estrutura/confirmHaveLanchonete.php';
    } else {
        ?>
        <script>
            $(".nova-lanchonete").modal('hide');
            atualizaLanchonetes();
        </script>
        <?php

    }
}
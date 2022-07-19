<?php

session_start();
include '../classes/lanchonete.php';
include '../classes/comentario.php';
include '../classes/usuario.php';
include '../input_filter.php';
include '../modelo/conexao.php';
include 'util/isOpen.php';

if (isset($_SESSION['foo']) && isset($_GET['foo'])) {
    $foo = unserialize(base64_decode(session('foo')));
    $ffoo = get('foo');
    if ($ffoo === $foo) {
        $lan = unserialize(base64_decode(session('lanchonete')));
        $id = $lan->id;
        $c = new conexao();
        $lanchonetes = $c->getObject([$id], 'myNear');
        $_ = array();
        if (is_array($lanchonetes)) {
            foreach ($lanchonetes as $lanchonete) {
                $avaliacao = $c->getObject([$lanchonete['ID_LANCHONETE']], 'getAvaliation');
                $howMuch = lanchonete::visto($lanchonete['ID_LANCHONETE'], $c->getconexao());
                $isOpen = isOpen($lanchonete['HORA_ABRE'],$lanchonete['HORA_FECHA']);
                $_[] = array
                    (
                    "id" => $lanchonete['ID_LANCHONETE'],
                    "isOpen" => $isOpen,
                    "titulo" => $lanchonete['TITULO'],
                    "lat" => $lanchonete['LATITUDE'],
                    "lng" => $lanchonete['LONGITUDE'],
                    "subTitulo" => $lanchonete['SUBTITULO'],
                    "bairro" => $lanchonete['BAIRRO'],
                    "horaAbre" => $lanchonete['HORA_ABRE'],
                    "horaFecha" => $lanchonete['HORA_FECHA'],
                    "avaliacao" => $avaliacao,
                    "hasSee" => $howMuch,
                    "aceita_cartao" => $lanchonete['ACEITA_CARTAO'],
//            "telefone" => $lanchonete->telefone,
                    "entrega" => $lanchonete['ENTREGA'],
                );
            }
        }
        $post_data = json_encode(array("lanchonetes" => $_));
        Header('Content-type: text/json;utf-8');
        print($post_data);
    } else {

        print('erro');
    }
} else {
    print(0);
}
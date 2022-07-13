<?php

session_start();

require_once '../../owasp-php-filters/testing/sanitize.php';
include '../classes/comentario.php';
include '../classes/usuario.php';
include '../classes/sessao.php';
include '../classes/lanchonete.php';
include '../aplication/util.php';
include_once '../modelo/conexao.php';
include_once '../input_filter.php';
if (isset($_SESSION['foo']) && isset($_GET['foo'])) {

    $foo = unserialize(base64_decode(session('foo')));
    $ffoo = get('foo');
    if ($ffoo === $foo) {

        $lan = unserialize(base64_decode(session("lanchonete")));

        $id = $lan->id;
        if (!isset($id) && !check_int($id, 1, 11)) {
            echo 2;
            exit();
        }

        $c = new conexao();
        if (check_int(get('action'), 1, 999)) {
            $limit = get('action');
            $coments = lanchonete::comentarios($id, $limit, $c->getconexao());
        }

        $post_data = json_encode(array("comentarios" => $coments));
        Header('Content-type: text/json;utf-8');
        print($post_data);
    } else {
        print('erro');
    }
} else {
    print(0);
}
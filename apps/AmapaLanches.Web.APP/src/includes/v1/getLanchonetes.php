<?php

session_start();

require_once '../../owasp-php-filters/testing/sanitize.php';
include '../classes/lanche.php';
include '../classes/cardapio.php';
include '../classes/usuario.php';
include '../classes/sessao.php';
include '../classes/comentario.php';
include '../classes/lanchonete.php';
include '../aplication/util.php';
include_once '../modelo/conexao.php';
include_once '../input_filter.php';
include 'util/isOpen.php';

$id = (int) post("id");
$v = (int) post("v");

if (!isset($id) && !check_int($id, 1, 11)) {
    echo 2;
    exit();
}
if (!isset($v) && !check_int($v, 1, 2)) {
    echo 3;
    exit();
}
$c = new conexao();
$ss = unserialize(base64_decode(session("sessao")));
$ft = "";

lanchonete::vistoByUsuario(session_id(), $id, $c->getconexao());
if (isset($ss) && $ss) {
    if ($ss->check($c->getconexao())) {
        $_SESSION['ask'] = "";
        unset($_SESSION['ask']);
        $ft = takeCryp(microtime(true) * 1000 . SECURITY_HASH, getRandonSalt());
        $_SESSION['ask'] = base64_encode(serialize($ft));
    } else {
        $ft = 0;
    }
}

$foo = takeCryp(microtime(true) * 2 . SECURITY_HASH, getRandonSalt());
$_SESSION['foo'] = base64_encode(serialize($foo));

$lanchonete = lanchonete::detalhe($id, $c->getconexao());
$hs = lanchonete::visto($id, $c->getconexao());
$avaliacao = lanchonete::avaliacao($id, $c->getconexao());
$nc = lanchonete::countComentario($id, $c->getconexao());
$isOpen = isOpen(substr($lanchonete->horaAbre, 0, -3), substr($lanchonete->horaFecha, 0, -3));

$_SESSION['lanchonete'] = base64_encode(serialize($lanchonete));
unset($_SESSION['limit']);

$post_data = json_encode(array('lanchonete' =>
    array
        (
        "isOpen" => $isOpen,
        "titulo" => $lanchonete->titulo,
        "subTitulo" => $lanchonete->subTitulo,
        "informativo" => $lanchonete->informativo,
        "bairro" => $lanchonete->bairro,
        "latitude" => $lanchonete->latitude,
        "longitude" => $lanchonete->longitude,
        "horaAbre" => $lanchonete->horaAbre,
        "horaFecha" => $lanchonete->horaFecha,
        "aceita_cartao" => $lanchonete->aceita_cartao,
        "telefone" => $lanchonete->telefone,
        "entrega" => $lanchonete->entrega,
        "avaliacao" => $avaliacao,
        "permissao" => ($ss->usuario->permissao) ? $ss->usuario->permissao : -1,
        "hasSee" => $hs,
        "view" => $v,
        "ft" => $ft,
        "nc" => $nc,
        "foo" => $foo,
    )
        ), JSON_FORCE_OBJECT);

Header('Content-type: text/json;utf-8');
print($post_data);

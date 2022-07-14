<?php

session_start();
require_once 'util.php';
require_once '../signo.php';
require_once '../../owasp-php-filters/testing/sanitize.php';
include_once '../classes/usuario.php';
include_once '../classes/sessao.php';
include_once '../modelo/conexao.php';
include_once '../input_filter.php';
$c = new conexao();
$numero = (string) post('numero');
$data = (string) post('data');
if (!check_sql_string($numero, 1, 45)) {
    echo 2;
    exit();
}
if (!check_sql_string($data, 1, 45)) {
    echo 3;
    exit();
}

$key = 0;
while ($key == 0) {
    $keyMaster = substr(uniqid(rand()), 0, 5);
    $key = $c->getObject([$keyMaster]
            , 'checkKeyMaster');
}

$ipv4 = $_SERVER["REMOTE_ADDR"];
$salt = getRandonSalt();
$senha = takeCryp(post('senha'), $salt);

$dt = explode("/", $data);
$signo = getSigno($dt[0], $dt[1]);
$dataDB = implode("-", array_reverse($dt));
$int = $c->getObject([null, null, $numero, $senha, $salt, $keyMaster, $ipv4, date('Y-m-d H:i:s'), $signo
    , $dataDB]
        , 'salvaUsuario');

if ($int == 1) {

    $_SESSION['CAN_DO_LOGIN'] = true;
    $_SESSION['CAN_DO_SALT'] = $salt;
    $_SESSION['CAN_DO_NUMERO'] = $numero;

    include '../SMS/sendSMS.php';
    sendSMS($numero, "CÓDIGO DE ATIVAÇÃO: " . $keyMaster);
    echo "$signo";
} else {
    echo 0;
}



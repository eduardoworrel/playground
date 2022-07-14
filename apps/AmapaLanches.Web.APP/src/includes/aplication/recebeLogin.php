<?php

session_start();
include_once '../classes/sessao.php';
require_once '../../owasp-php-filters/testing/sanitize.php';
//require_once '../../rc/lib/random.php';
include '../aplication/util.php';
include_once '../input_filter.php';
include_once '../modelo/conexao.php';
include_once '../classes/usuario.php';
$c = new conexao();

$login = (string) post('login');
if (!check_sql_string($login, 1, 45)) {
    echo 2;
    exit();
}

$pdo = $c->getconexao();
$sql = "SELECT SALT,ATIVO,NUMERO FROM usuario WHERE NUMERO=:NUMERO ";
$stm = $pdo->prepare($sql);
$stm->bindParam(":NUMERO", $login, PDO::PARAM_STR);
$stm->execute();
$arrays = $stm->fetchAll();
$response = 0;
if ($stm->rowCount() == 1) {
    if ($arrays[0][1] == 0) {
        $response = 2;
    } else {
        $response = 1;
    }
    $_SESSION['CAN_DO_LOGIN'] = true;
    $_SESSION['CAN_DO_SALT'] = $arrays[0][0];
    $_SESSION['CAN_DO_NUMERO'] = $arrays[0][2];
} else {
    $response = 3;
}

echo $response;

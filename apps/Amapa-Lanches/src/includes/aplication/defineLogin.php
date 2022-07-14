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

if ($_SESSION['CAN_DO_LOGIN']) {
    $pdo = $c->getconexao();

    $token = (string) post('token');
    $senha = (string) post('senha');

    if (!check_sql_string($senha, 1, 105)) {
        echo 3;
        exit();
    }
    if (!check_sql_string($token, 1, 300)) {
        echo 4;
        exit();
    }
    $salt = $_SESSION['CAN_DO_SALT'];
    $login = $_SESSION['CAN_DO_NUMERO'];
    $hash = takeCryp($senha, $salt);

    $sql = "SELECT u.ID_USUARIO, u.NUMERO,u.SIGNO,pu.ID_PERMISSAO,u.CHAVE_MESTRA,u.ATIVO FROM "
            . "usuario u ,permissao_usuario pu"
            . "  WHERE u.SENHA = :SENHA AND u.ID_USUARIO = pu.ID_USUARIO";
    $stm = $pdo->prepare($sql);
    $stm->bindParam(":SENHA", $hash, PDO::PARAM_STR);
    $stm->execute();
    if ($stm->rowCount() > 1) {
//echo "WTF";
    } else if ($stm->rowCount() == 1) {
        $result = $stm->fetch();
        if ($result['ATIVO'] == 1 && $login === $result['NUMERO']) {
            $time = date('Y-m-d H:i:s');
            $usr = new usuario ();
            $usr->permissao = $result['ID_PERMISSAO'];
            $usr->signo = $result['SIGNO'];
            $usr->id = $result['ID_USUARIO'];
            $usr->token = takeCryp($time . SECURITY_HASH, getRandonSalt());
            $ipv4 = $_SERVER["REMOTE_ADDR"];
            $ss = new sessao
                    ([
                $usr->token, $ipv4, $_SERVER['HTTP_USER_AGENT'], $usr->token, $time, $usr
            ]);
            $pdo = $c->getconexao();

            $pst = $pdo->prepare("INSERT INTO acesso "
                    . " (ID_USUARIO,DATAHORA, IPV4, USERAGENT, PRIMEIRO_TOKEN, ULTIMO_TOKEN, ULTIMA_INTERACAO_SESSAO)"
                    . " VALUES"
                    . " (:ID_USUARIO,:DATAHORA,:IPV4,:USERAGENT,:PRIMEIRO_TOKEN,:ULTIMO_TOKEN,:ULTIMA_INTERACAO_SESSAO)");
            $pst->bindParam(":ID_USUARIO", $usr->id, PDO::PARAM_INT);
            $pst->bindParam(":IPV4", $ipv4, PDO::PARAM_STR);
            $pst->bindParam(":DATAHORA", $time, PDO::PARAM_STR);
            $pst->bindParam(":USERAGENT", $_SERVER['HTTP_USER_AGENT'], PDO::PARAM_STR);
            $pst->bindParam(":PRIMEIRO_TOKEN", $ss->primeiro_token, PDO::PARAM_STR);
            $pst->bindParam(":ULTIMO_TOKEN", $ss->ultimo_token, PDO::PARAM_STR);
            $pst->bindParam(":ULTIMA_INTERACAO_SESSAO", $time, PDO::PARAM_STR);
            $pst->execute();
            $_SESSION['sessao'] = base64_encode(serialize($ss));
            $response = 1;
        } else if ($result['ATIVO'] == 0 && $login === $result['NUMERO']) {
            $hashedKey = $result['CHAVE_MESTRA'];
            if ($token === "token") {
                
            } else
            if ($token == $hashedKey) {

                $stm = $pdo->prepare("UPDATE usuario SET ATIVO = 1 WHERE CHAVE_MESTRA = :CM ");
                $stm->bindParam(":CM", $result['CHAVE_MESTRA'], PDO::PARAM_STR);
                $stm->execute();
                if ($stm->rowCount() == 1) {
                    $time = date('Y-m-d H:i:s');
                    $usr = new usuario ();
                    $usr->permissao = $result['ID_PERMISSAO'];
                    $usr->signo = $result['SIGNO'];
                    $usr->id = $result['ID_USUARIO'];
                    $usr->token = takeCryp($time . SECURITY_HASH, getRandonSalt());
                    $ipv4 = $_SERVER["REMOTE_ADDR"];
                    $ss = new sessao
                            ([
                        $usr->token, $ipv4, $_SERVER['HTTP_USER_AGENT'], $usr->token, $time, $usr
                    ]);



                    $pdo = $c->getconexao();
                    $pst = $pdo->prepare("INSERT INTO acesso "
                            . " (ID_USUARIO,DATAHORA, IPV4, USERAGENT, PRIMEIRO_TOKEN, ULTIMO_TOKEN, ULTIMA_INTERACAO_SESSAO)"
                            . " VALUES"
                            . " (:ID_USUARIO,:DATAHORA,:IPV4,:USERAGENT,:PRIMEIRO_TOKEN,:ULTIMO_TOKEN,:ULTIMA_INTERACAO_SESSAO)");
                    $pst->bindParam(":ID_USUARIO", $usr->id, PDO::PARAM_INT);
                    $pst->bindParam(":IPV4", $ipv4, PDO::PARAM_STR);
                    $pst->bindParam(":DATAHORA", $time, PDO::PARAM_STR);
                    $pst->bindParam(":USERAGENT", $_SERVER['HTTP_USER_AGENT'], PDO::PARAM_STR);
                    $pst->bindParam(":PRIMEIRO_TOKEN", $ss->primeiro_token, PDO::PARAM_STR);
                    $pst->bindParam(":ULTIMO_TOKEN", $ss->ultimo_token, PDO::PARAM_STR);
                    $pst->bindParam(":ULTIMA_INTERACAO_SESSAO", $time, PDO::PARAM_STR);
                    $pst->execute();
                    $_SESSION['sessao'] = base64_encode(serialize($ss));
                    $response = 1;
                } else {
                    
                }
            } else {
                $response = -1;
            }
        } else {
            
        }
    } else {
        $response = 2;
    }
} else {
    $response = 3;
}
echo $response;

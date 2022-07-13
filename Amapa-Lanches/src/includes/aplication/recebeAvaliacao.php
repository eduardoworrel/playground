<?php

session_start();
include '../../owasp-php-filters/testing/sanitize.php';
include '../aplication/util.php';
include_once '../input_filter.php';
include_once '../modelo/conexao.php';
include_once '../classes/usuario.php';
include_once '../classes/sessao.php';
include_once '../classes/lanchonete.php';


$ss = unserialize(base64_decode(session('sessao')));

$ft;
if (isset($ss)) {
    $c = new conexao();
    if ($ss->status == 0) {
        echo 'fail';
    } else {

        if ($ss->check($c->getconexao())) {

            if ($ss->usuario->permissao > 0) {
                $tk = unserialize(base64_decode(session('ask')));
                $tkInputed = post('tk');
                if (isset($tkInputed)) {
                    if ($tk === $tkInputed) {

                        $_SESSION['ask'] = "";
                        unset($_SESSION['ask']);
                        $ft = takeCryp(round(microtime(true) * 1000) . SECURITY_HASH, getRandonSalt());
                        $_SESSION['ask'] = base64_encode(serialize($ft));
                        $lanchonete = unserialize(base64_decode(session("lanchonete")));
                        if (isset($lanchonete)) {
                            $id = (int) $lanchonete->id;
                            $av = (int) post("av");
                            if ($av == -1 or $av == 1) {
                                $c = new conexao();
                                $_SESSION['lanchonete'] = base64_encode(serialize($lanchonete));
                                $time = date('Y-m-d H:i:s') . "." . round(microtime(true) * 1000);
                                $return = lanchonete::salvaAvaliacao([$av, $id, $ss->usuario->id, $time], $c->getconexao());
                                echo $ft;
                            } else {
                                echo 99;
                                exit();
                            }
                        }
                    } else {
                        echo 4;
                        exit();
                    }
                } else {
                    echo 5;
                    exit();
                }
            } else {
                echo 6;

                exit();
            }
        } else {
            echo 7;

            exit();
        }
    }
}
<?php

require_once 'rc/lib/random.php';
require_once 'includes/aplication/util.php';
require_once 'includes/input_filter.php';
require_once 'includes/modelo/conexao.php';

$i = 0;
$usr;

if (isset($_SESSION['sessao'])) {
    $ss = unserialize(base64_decode(session('sessao')));
    if (isset($ss)) {
        $c = new conexao();
        if ($ss->check($c->getconexao())) {
            if ($ss->usuario->permissao > 0) {
                $i = 1;
            } else {
                $i = 0;
            }
        } else {
            if (session_status() !== PHP_SESSION_ACTIVE) {
                session_destroy();
                session_start();                
            }
            
            $usr = new usuario();
            $usr->permissao = -1;
            $ss = new sessao([$usr]);
            $_SESSION['sessao'] = base64_encode(serialize($ss));
            $i = 0;
        }
    }
} else {
    $usr = new usuario();
    $usr->permissao = -1;
    $ss = new sessao([$usr]);
    $_SESSION['sessao'] = base64_encode(serialize($ss));
    $i = 0;
}
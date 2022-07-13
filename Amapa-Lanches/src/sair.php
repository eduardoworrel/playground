<?php

include_once './includes/classes/usuario.php';
include_once './includes/classes/sessao.php';

if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    
}
session_destroy();
session_start();
$usr = new usuario();
$usr->permissao = -1;
$ss = new sessao([$usr]);
$_SESSION['sessao'] = base64_encode(serialize($ss));
$i = 0;
include './includes/estrutura/formularios/login.php';

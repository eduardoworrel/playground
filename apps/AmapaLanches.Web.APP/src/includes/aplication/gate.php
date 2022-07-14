<?php

include_once '../input_filter.php';
include_once '../classes/usuario.php';
session_start();
$usr;
if (isset($_SESSION['usuario'])) {
    $usr = unserialize(session('usuario'));
    if ($usr->isGate == 0) {
        $usr->isGate = 1;
    } else {
        $usr->isGate = 0;
    }
    $_SESSION['usuario'] = serialize($usr);
    echo 0;
} else {
    echo 1;
}

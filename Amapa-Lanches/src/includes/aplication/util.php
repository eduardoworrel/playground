<?php

function unificaEspacoString($string) {
    $array = explode(" ", $string);
    $words = array();
    foreach ($array as $promessa) {
        if (strlen($promessa) > 0) {
            $words[] = $promessa;
        }
    }
    return implode(" ", $words);
}

function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match('/@.+\./', $email);
}

function getRandonSalt() {
    $basic = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
    $size = 32;
    $return = ""; // Salvando caracteres
    for ($count = 0; $size > $count; $count++) {
        //Gera um caracter aleatorio
        $return .= $basic[rand(0, strlen($basic) - 1)];
    }
    return $return;
}

function takeCryp($palavra, $salt) {
    $custo = "08";
    return crypt($palavra, '$2a$' . $custo . '$' . $salt . '$');
}

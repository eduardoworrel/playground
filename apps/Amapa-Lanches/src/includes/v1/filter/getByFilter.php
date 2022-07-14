<?php

include_once '../../modelo/conexao.php';
include_once '../../classes/usuario.php';
include_once '../../input_filter.php';


$param = post("args");
$array;
if (strpos($param, ",") > 0) {
    $temp = explode(",", $param);
    foreach ($temp as $possivelInteiro){
        if(!is_numeric($possivelInteiro)){
            exit(0);
        }
        $array[] = intval($possivelInteiro);
    }
}

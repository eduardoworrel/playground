<?php

include './modelo/conexao.php';
$c = new conexao();
$pdo= $c->getconexao();

if (isset($_POST['cadastrar'])){
    $nome_l = $_POST['titulo'];
    $sub_l = $_POST['subtitulo'];
    $hora_a =  $_POST['hora_a'];
    $hora_f =  $_POST['hora_f'];
    $id =  $_POST['id'];
    $status = 1;
    
    
    $at = $pdo->prepare("UPDATE lanchonetes"
            . " SET  TITULO = :titulo, SUBTITULO = :subtitulo,"
            . " HORA_ABRE = :hora_a, HORA_FECHA = :hora_f, STATUS = :status, WHERE ID_LANCHONETE = :id");
    
    $at->bindParam(":titulo",$nome_l, PDO::PARAM_STR);
    $at->bindParam(":subtitulo",$sub_l, PDO::PARAM_STR);
    $at->bindParam(":hora_a",$hora_a, PDO::PARAM_STR);
    $at->bindParam(":hora_f",$hora_f, PDO::PARAM_STR);
    $at->bindParam(":status",$status, PDO::PARAM_STR);
    $at->bindParam(":id",$id, PDO::PARAM_STR);
   
    $total = $at->rowCount();
    
    if ($total > 0){
        echo 'lanchonete cadastrada';
    }else{
            echo 'não foi possivel cadastrar';
    }
}

    
 


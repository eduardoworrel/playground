<?php

session_start();

require_once '../../owasp-php-filters/testing/sanitize.php';
include '../aplication/util.php';
include_once '../modelo/conexao.php';
include_once '../input_filter.php';
include 'util/isOpen.php';

$_ = [];
try{
    
$pst = $pdo->prepare("SELECT * from usuario");
        
        $pst->execute();
        var_dump($pst->rowCount());
        if ($pst->rowCount() > 0) {
            foreach($pst->fetchAll() as $usuario){
            
            $_[] = array
                (
                "nome" => $usuario['nome'],
                "idade" => $usuario['idade'],
                "genero" => $usuario['genero'],
            );
            }
        }
    }catch(SQLException $e){
        echo $e->getMessage();
    }

        Header('Content-type: text/json;utf-8');       
        $post_data = json_encode(array("todas" => $_));
        print($post_data);
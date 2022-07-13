<?php

include_once './includes/modelo/conexao.php';
$c = new conexao();
$instancia = $c->getconexao();
$b = $_GET['b'];
$i = $_GET['i'];
$pst = $instancia->prepare("UPDATE lanchonetes SET BAIRRO = :bairro WHERE ID_LANCHONETE = :id");
$pst->bindParam(":bairro", $b,PDO::PARAM_STR);
$pst->bindParam(":id", $i,PDO::PARAM_INT);
$pst->execute();
var_dump($pst->rowCount());


<?php
include_once '../modelo/conexao.php';
include_once '../input_filter.php';
$param = post('param');
if ($param == 1) {

    $c = new conexao();
    $array = $c->getObject([], 'sugestao');
    if (is_array($array)) {
        ?>
<h4 style="font-family: 'Fredoka One', cursive; text-align: center">DESTAQUES</h4>
        <ul class="demo-list-two mdl-list">

                <?php
                foreach ($array as $lanchonete) {
                    include '../estrutura/atalhoLanchonete.php';
                }
                ?>
        </ul>
    <?php
    }
}    
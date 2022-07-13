<?php
include_once '../../modelo/conexao.php';
include_once '../../classes/usuario.php';
include_once '../../input_filter.php';



$c = new conexao();
$ins = $c->getconexao();
$rs = $ins->query("SELECT * FROM tipos ORDER BY ativo DESC, tipo ASC");
foreach ($rs->fetchAll() as $unidade) {
    ?>
<div onclick="achar(<?= $unidade["ID_TIPO"] ?>)"class="col-xs-12 
         tipo<?= $unidade["ID_TIPO"] ?> selectTipo "data-param="<?= $unidade["ID_TIPO"] ?>"
         style="
         <?php
         if ($unidade["ATIVO"] == 1) {
             ?>
             text-align: justify;
             margin-top: 8px;
             padding: 5px;
             width: 100%;
             font-size: 16px;
             background: #f3c69d    ;
             border-radius: 5px;
             box-shadow: 0 1px 1.5px 0 rgba(0,0,0,.12), 0 1px 1px 0 rgba(0,0,0,.24);
             color: #131a21;"

             <?php
         } else {
             ?>
             text-align: justify;
             margin-top: 8px;
             padding: 5px;
             width: 100%;
             font-size: 16px;
             background: #131a21;
             border-radius: 5px;
             box-shadow: 0 1px 1.5px 0 rgba(0,0,0,.12), 0 1px 1px 0 rgba(0,0,0,.24);
             color: #868472;"
             onclick="notie.alert({
             type: 3,
             text: 'Em breve',
             time: 2, position: 'bottom'
             });
             "
             <?php
         }
         ?>
         >
         <div class="col-xs-2 noPadding">
            <img class="
            <?php
            if ($unidade["ATIVO"] == 1) {
                ?>

                     <?php
                 } else {
                     ?>
                     noColorImage
                     <?php
                 }
                 ?>
                 " src="assets/$_imgs/l/<?= $unidade["ID_TIPO"] ?>.svg" width="80%">
        </div>
        <div class="col-xs-10">
            <span style="font-size: 22px"><?= $unidade["TIPO"] ?></span><br>
            <small><?= $unidade["DESC"] ?></small>
        </div>
        <?php
        if ($unidade["ATIVO"] == 1) {
            ?>
         
            <?php
        } else {
            ?>
         
            <?php
        }
        ?>
    </div>
    <?php
}
<?php
$usuarios = $c->getObject([], "_usuarios");
$lanchonetes = $c->getObject([], "_lanchonetes");
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-2">
        </div>
        <div class="col-lg-8">
        <div class="page-header">
            <h3>
                Painel de controle
            </h3>
            <a class="btn btn-default _config"><span class="text-right"><i class="fa fa-map-o fa-2x"></i></span></a>
            </div>
            <ul class="nav nav-pills" role="tablist">
                <li role="presentation" class="active"><a href="#usuarios" data-toggle="tab">Usuarios</a></li>
                <li role="presentation"><a href="#lanchonetes"  data-toggle="tab">Lanchonetes</a></li>
            </ul>
            <div class="tab-content" style=" padding: 10px;">
                <div role="tabpanel" class="tab-pane active" id="usuarios">

                    <div class="container-fluid">
                        <div class="row">
                            <?php
                            foreach ($usuarios as $u) {
                                ?>
                                <span class="dropdown">
                                    <button data-toggle="dropdown" class="btn btn-lg <?php
                                    if ($u->permissao == 2) {
                                        ?>btn-default<?php
                                            } else {
                                                ?>btn-info<?php
                                            }
                                            ?>
                                            " aria-expanded="false">
                                                <?= $u->nome ?>
                                        <i class="fa fa-cog"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a><i class="fa fa-pencil"></i> EDITAR</a></li>
                                        <li><a><i class="fa fa-trash-o"></i> DELETAR</a></li>
                                    </ul>
                                </span>


                                <?php
                            }
                            ?>


                        </div>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane" id="lanchonetes">
                        <?php
                        foreach ($lanchonetes as $l) {
                            ?>
                            <span class="dropdown">
                                <button data-toggle="dropdown" class="btn btn-lg <?php
                                if ($l->status == 0) {
                                    ?>btn-warnning<?php
                                        } elseif ($l->status == 1) {
                                            ?>btn-default<?php
                                        } else {
                                            ?>btn-danger<?php
                                        }
                                        ?>
                                        " aria-expanded="false">
                                            <?= $l->titulo ?>
                                    <i class="fa fa-cog"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a><i class="fa fa-pencil"></i> EDITAR</a></li>
                                    <li><a><i class="fa fa-trash-o"></i> DELETAR</a></li>
                                </ul>
                            </span>


                            <?php
                        }
                        ?>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php

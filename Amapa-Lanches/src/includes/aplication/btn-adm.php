<?php
if (!isset($permissao)) {
    session_start();
    include '../input_filter.php';
    include '../classes/usuario.php';
    include '../classes/sessao.php';
    $ss = unserialize(base64_decode(session('sessao')));
    $permissao = $ss->usuario->permissao;
}

if ($permissao == 1) {
    ?>
    <button  class=" _config mdl-button mdl-js-button smdl-js-ripple-effect">
        <i class="material-icons">library_books</i>
    </button>

    <button  id="_nl" class="mdl-button mdl-js-button mdl-js-ripple-effect">
        <i class="material-icons">add_location</i>
    </button>

    <?php
}
if ($permissao == 2) {
    ?>

    <!--    <a class="btn btn-default btn-lg myList" >
            <i class="fa fa-flag"></i>
        </a>    -->
    <?php
}
?>
<button  id="bye" style="color: crimson;  " 
         class="mdl-button mdl-js-button ">
   <i class="material-icons">keyboard_backspace</i>
    SAIR
</button>



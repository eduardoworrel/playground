<?php
response.addHeader("Access-Control-Allow-Origin", "*");
?>
<div class="form-group">
    <div class="col-lg-6 col-xs-12">
        <div class="mdl-textfield mdl-js-textfield">
            <input class="mdl-textfield__input " type="text"  id="titulo_lc">
            <label class="mdl-textfield--floating-label" for="titulo">Titulo:</label>
        </div>
    </div>

    <div class="col-lg-6 col-xs-12">
        <div class="mdl-textfield mdl-js-textfield">
            <input class="mdl-textfield__input " type="text" id="preco_lc">
            <label class="mdl-textfield--floating-label" for="preço">Preço:</label>
        </div>
    </div>
    <div class="mdl-textfield mdl-js-textfield">
        <textarea class="mdl-textfield__input" type="text" rows="1" id="ingredientes_lc"></textarea>
        <label class="mdl-textfield--floating-label" for="ingredientes">Ingredientes</label>
    </div>

    <button onclick="salvaLanche()"class="pull-right mdl-button mdl-js-button mdl-button--fab ">
        <i class="material-icons">done</i>
    </button>
</div>
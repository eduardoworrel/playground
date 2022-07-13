<ul class="demo-list-two mdl-list">

    <?php
    if ($lanchonete == null) {
        $lachonete = unserialize(session('lanchonete'));
    }
    $lanches = $lanchonete->cardapio->lanches;
    if (count($lanches) > 0) {
        foreach ($lanches as $lanche) {
            ?>
            <li class="mdl-list__item mdl-list__item--two-line">
                <span class="mdl-list__item-primary-content">
                    <span><?= $lanche->titulo ?></span>
                    <span class="mdl-list__item-sub-title"><?= $lanche->ingredientes ?></span>
                </span>
                <span class="mdl-list__item-secondary-content">
                    <span class="mdl-list__item-secondary-info"> <?= $lanche->preco ?></span>
                </span>
            </li>

            <?php
        }
        ?>
        <button onclick="novoLanche()" class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab">
            <i class="material-icons">add</i>
        </button>

        <button onclick="finaliza();" class="pull-right  mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab">
            <i class="material-icons">done all</i>
        </button>

    </ul>
    <?php
}
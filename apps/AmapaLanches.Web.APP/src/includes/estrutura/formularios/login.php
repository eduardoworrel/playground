<div class="container-fluid">
    <div class="row">
        <button class=" pull-right mdl-button mdl-js-button"
                id="backw">VOLTAR
        </button>
    </div>
</div>
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
        <div class="container-fluid">
            <div class="row">
                <div class="group">
                <label class="l_input" for="Login">Login</label>
                    <input class="input_defaut" type="text" id="login">
                </div>
                <div class="group">
                <label class="l_input" for="Senha">Senha</label>
                    <input class="input_defaut" type="password" id="senha_ac">
                </div>
                <div class="page-header">
                </div>
                
                <button href="#profile" data-toggle="tab" class="mdl-button mdl-js-button _coc">
                    Criar Conta
                </button>
                <button class=" pull-right mdl-button mdl-js-button"
                        id="_tryLogin">ENTRAR
                </button>
            </div>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="profile">
        <div class="container-fluid">
            <div class="row">
                <?php include 'novoCliente.php'; ?>
            </div>
        </div>
    </div>
</div>


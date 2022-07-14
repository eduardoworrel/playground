var scrollToElement = function(el, ms){
    var speed = (ms) ? ms : 600;
    $('.itens').animate({
        scrollTop: $(el).position().top
    }, speed);
}

function addAdicional(value){
    value = value ? value : "";
    let nome = $('#nomeAdicional'+value).val();
    let preco = $('#precoAdicional'+value).val();
    if(parseInt(preco) == NaN){
        alert("Apenas número e ponto.");
                return false;
    }
    if(nome.trim().length > 0){
        $('.itAdicional'+value).each(function(){
            if($(this).data('nome') == nome){
                alert("Já existe um adicional com esse nome cadastrado.");
                return false;
            }
        });
        $('#nomeAdicional'+value).val("");
        $('#precoAdicional'+value).val("");

        $(".adicionados"+value).prepend(`
            <li class='itAdicional list-group-item' data-nome='${nome}'>
                ${nome} - ${floatToReal(preco)} <a class='btn btn-danger float-right' onclick='deletaAdicional("${nome}")'>DELETAR</a>
                <input type='hidden' name='adicional[]' value='${nome}><${preco}'>
            </li>
        `);

    }
}
function deletaAdicional(nome, value,id){

        value = value ? value : "";
        $('.itAdicional'+value).each(function(){
            if($(this).data('nome') == nome){
                $(this).remove();
            }
        });
        if(value != ""){
            $(".adicionados"+value).append(`
            <input type='hidden' name='adicionalDeletado[]' value='${id}'>
            `);
        }

}

function buscaCadastroPorWhatsapp(_this) {
    let whatsapp = $(_this).val();
    if (whatsapp.length > 10) {
        setTimeout(() => {
            if ($(_this).val().length != whatsapp.length) {
                buscaCadastroPorWhatsapp(_this);
                return;
            }
            $.getJSON(
                "/checkWhatsapp/" + whatsapp,
                (data) => {
                    console.log(data.nome);
                    $("#name").val(data.nome);
                    callbackNome();
                    $(".etapa222").show();
                });
        }, 1000);
    }
}
function menos(id,valor){
    if(parseInt($(".qt"+id).val()) == 0){

    }else{
        $(".qt"+id).val(parseInt($(".qt"+id).val())  - 1);
        $(".total").html((parseFloat($(".total").html()) - parseFloat(valor)).toFixed(2));
    }
}
function mais(id,valor){
    $(".qt"+id).val(parseInt($(".qt"+id).val()) + 1);
    $(".total").html((parseFloat($(".total").html()) + parseFloat(valor)).toFixed(2));
}

var tempAdicionais = 0.0;
var carrinhoComAdicional = [];

function removeProdutoAdicionado(pId ,chaveUnica, preco){

    $(".filho"+pId+chaveUnica).remove();
    let arr = [];
    for(i in carrinhoComAdicional[pId]){
        if(i != chaveUnica){
            arr[i] = (carrinhoComAdicional[pId][i]);
        }else{

        }
    }
    carrinhoComAdicional[pId] = arr;
    $(".total").html((parseFloat($(".total").html()) - parseFloat(preco)).toFixed(2));
}
function chaveUnica(identificador){
    let rand = Math.floor(Math.random() * 100);
    if(typeof carrinhoComAdicional[identificador][rand] != 'undefined'){
        return chaveUnica(identificador);
    }
    return rand;
}
function showCloser(pId){

    $("#mProduto"+pId).collapse('show');
    $(".open"+pId).hide();
    $(".close"+pId).show();
    document.location.href = "#avel"+pId;
}
function hideCloser(pId){
    $("#mProduto"+pId).collapse('hide');
    $(".close"+pId).hide();
    $(".open"+pId).show();
    document.location.href = "#avel"+pId;
}
function novoProdutoComAdicional(pId,preco){
    preco = parseFloat(preco);
        if(typeof carrinhoComAdicional[pId] == 'undefined'){
            carrinhoComAdicional[pId] = [];
        }
        rand = chaveUnica(pId);
        if(carrinhoComAdicional.indexOf(rand) > 0){

        }else{
        let titulo = $(`.quantidade${pId}`).data('who');
        let desc = $(`.quantidade${pId}`).data('desc');
        let img = $(`.quantidade${pId}`).data('img');
        let text = "";

        carrinhoComAdicional[pId][rand] = [];

        $(`.child${pId}`).each((a,b)=>{

                let qt = $(b).val();
                if(qt > 0){
                    let id = $(b).data('id');
                    let titulo = $(b).data('who');
                    text += ` + ${qt} ${titulo}`;
                    carrinhoComAdicional[pId][rand].push(titulo+'><'+qt+'><'+id);
                    $(b).val(0);
                }
        });

        $(".adicionavel"+pId).after(`
                <div class="col-12 filho${pId}${rand}" data-rand="${rand}" style="margin-top:25px">
                <div style="box-shadow: 0px 0px 20px -13px rgb(0 0 0);
                border-radius:15px; background: rgb(221, 221, 255); margin:-5px;padding:5px;heigth:80px" class="row">
                    <div class="col-3">
                    <div class="image-cropper">
                                <img src="storage/${img}"
                                    class="profile-pic">
                            </div>
                    </div>
                    <div class="col-6">
                        <div class="titulo${titulo} t">
                        ${titulo}
                        </div>
                        <div class="preco${pId} p">

                        ${f.format(tempAdicionais + preco)}

                        </div>
                        <div class="preco${pId}d small">
                            ${desc}<br>
                            <b>Adicionais:</b>${text}
                        </div>
                    </div>
                    <div class="col-3 text-center">
                    <a class="btn btn-light" style="width: 100%"
                        onclick="removeProdutoAdicionado(${pId},${rand},'${tempAdicionais + preco}')"><span
                            class="material-icons">
                            remove
                        </span></a>
                    </div>
                </div>
            </div>
                `);
                $(".total").html( (parseFloat($(".total").html()) + parseFloat(tempAdicionais)
                + parseFloat(preco)).toFixed(2)
                );
                tempAdicionais = 0.00;
                hideCloser(pId);
    }
}

function maisAdicional(id,idAdicional,valor){
    $(".quantidadeAd"+id+"-"+idAdicional).val(parseInt($(".quantidadeAd"+id+"-"+idAdicional).val()) + 1);
    tempAdicionais += parseFloat(valor);
}

function menosAdicional(id,idAdicional,valor){
    if(parseInt($(".quantidadeAd"+id+"-"+idAdicional).val()) == 0){

    }else{
        $(".quantidadeAd"+id+"-"+idAdicional).val(parseInt($(".quantidadeAd"+id+"-"+idAdicional).val())  - 1);
        tempAdicionais -= parseFloat(valor);
    }
}
function openLoja(_this){
    $('#legendaIsOp').html(`
   ...<br>carregando
    `);
    let i = $(_this).data('value');
    $.ajax({url:"/estadoDaLoja/"+i,success:(data)=>{
        if(data == 0){
            $(_this).data('value',1).html('ABRIR');
            $('#legendaIsOp').html(`
            <span class="material-icons">
                    airplanemode_inactive
            </span><br>FECHADO
            `);

        }else if (data == 1){
            $(_this).data('value',0).html('FECHAR');
            $('#legendaIsOp').html(`
            <span class="material-icons">
                light_mode
            </span><br>
            ABERTO
            `);

        }else{
            alert('Algo deu errado, alerte o administrador');
        }
    }})
}
visibleEndereco = false;
$(document).on('change','.entrega',()=>{
    visibleEndereco = false;
    let val = $("input:radio.entrega:checked").val();
    for(i of ['entrega','delivery','moto','carro','encomenda','presentear','agendar']){
        if(val.toLocaleLowerCase().includes(i.toLocaleLowerCase())){
            $(".enderecoEscondido").show();
            visibleEndereco = true;
        }

    }
    if(!visibleEndereco){
        $(".enderecoEscondido").hide();
    }

});
$(document).on('keyup', '#cep', function () {
    var cep = $(this).val().replace(/\D/g, '');
    if (cep.length == 8) {
        var validacep = /^[0-9]{8}$/;

        if (validacep.test(cep)) {
            $.ajax({
                url: `https://viacep.com.br/ws/${cep}/json/`,
                type: "get",
                dataType: "json",
                success: function (data) {
                    $("#rua").val(data.logradouro);
                    $("#bairro").val(data.bairro);
                    $("#cidade").val(data.localidade);
                    $("#estado").val(data.uf);
                    $(".etapa222").show();
                }
            });
        }


    } else {
        $("#rua").val("");
        $("#bairro").val("");
        $("#cidade").val("");
        $("#estado").val("");
        $(".etapa222").hide();
    }
});
function porPalavra(_this) {

    $(".SearchIn").parent().css("display", "none");
    let clas = $(".porStatus").find(":selected").val();
    val = $(_this).val();
    $(".SearchIn").filter("." + clas).find("td").filter(function () {
        return this.textContent.toUpperCase().indexOf(val.toUpperCase()) !== -1;
    }).parent().parent().css("display", "block")
}

function porStatus(_this) {
    let val = $(_this).val();
    $(".SearchIn").parent().css("display", "none");
    $(".SearchIn").filter("." + val).parent().css("display", "block")
}

function send(t) {
    if($("#whatsapp").val().length < 8){
        alert("Whatsapp invalido");
        return;
    }
    let data = {};
    let text =
        "*Pedido*: %0a";
    let prod = [];
    let ads = [];
    $(".quantidade").each(function () {
        titulo = $(this).data('who');
        let val = $(this).val();
        if (val > 0) {
            text += `${val} x ${titulo} %0a`;
            id = $(this).data('id');
            prod.push(`${id}.${val}`);
        }
    });
    for(i in carrinhoComAdicional){
        let paraUmId = carrinhoComAdicional[i];
        if(paraUmId.length > 0){
            for(index in paraUmId){
                let titulo = `1 x `+ $(`.quantidade${i}`).data('who') + `%0a`;
                let s = paraUmId[index];
                if(s.length < 1){
                    ads.push(`${i}.0-0`)
                }else{
                    let tx  = "";
                    for(str in s){
                        str = s[str].split("><");
                        let t = str[0];
                        let qt =str[1];
                        let id =str[2];
                        tx += `${id}-${qt},`;
                        titulo += `     + ${qt} ${t} `;

                    }
                    ads.push(`${i}.${tx}`);
                }
                text += `${titulo} %0a`;
            }
        }

    }
    if (!prod.length && !ads.length) {
        alert("adicione produtos para concluir");
        return;
    }
    data.produtos = prod;

    let pagamento = $(".pagamento").filter(":checked").length > 0 ? $(".pagamento").filter(":checked") : 0
    if (pagamento < 1) {
        alert("Escolha a forma de pagamento");
        return;
    }
    data.pagamento = pagamento.data('id');
    text += `Pagamento: *${$(pagamento[0]).val()}* %0a`;


    let entrega = $(".entrega").filter(":checked").length > 0 ? $(".entrega").filter(":checked") : 0;
    if (entrega < 1) {
        alert("Escolha a forma de entrega");
        return;
    }
    data.entrega = entrega.data('id');
    text += `Entrega: *${$(entrega[0]).val()}*`;

    text += `%0a%0a ${$("#searchTextField").val()}  `;
    text += `%0a%0a%0a%0a%0a Obs: *${$("#observacao").val()}*`;


    data.whatsapp = $("#whatsapp").val();
    data.nome = $("#name").val();
    if(visibleEndereco && $("#searchTextField").val().length < 1){
        alert("Endereço em branco");
        return;
    }

    if(visibleEndereco){
        data.endereco = $("#searchTextField").val();
    }else{
        data.endereco = "Sem endereco";
    }


    data.observacao = $("#observacao").val();
    data.cupom = $("#cupom").val();
    data.ads = ads;
    data._token = t;
    $(".finalizaPedido").html("...");
    $.ajax({
        url: "/pedido",
        type: "POST",
        data: data,
        success: (data) => {
            if(data == 0){
                mostraFinal(text);
            }else{
                $(".finalizaPedido").html("Finalizar Pedido");
                alert('Algo deu errado, confirme os dados.');
            }
        }

    });
}
var _text = "";
function msg(numero){
    let text = _text;
    let url = `https://api.whatsapp.com/send?phone=55${numero}&text=${text}&source=&data=&app_absent=`;
    window.open(url, '_blank');
}
function mostraFinal(text){
    _text = text;
    $('.etapa2,.cancel,.totales').hide();
    $('.etapa3').show();
}
function toggle() {
    $('#sidebar').toggleClass('active');
}
function montaCarrinho(){
    let prod = [];
    let jafoi = [];
    $(".carrinho").html("");
    $(".quantidade").each(function () {
        titulo = $(this).data('who');
        let val = $(this).val();
        if (val > 0) {
            id = $(this).data('id');
            if(!jafoi.includes(id)){
                jafoi.push(id);
                $(".carrinho").append(`${val} x ${titulo} <br>`);
            }
        }
    });
    for(i in carrinhoComAdicional){
        let paraUmId = carrinhoComAdicional[i];
        if(paraUmId.length > 0){
            for(index in paraUmId){
                let titulo = `1 `+ $(`.quantidade${i}`).data('who');
                let s = paraUmId[index];
                for(str in s){
                    str = s[str].split("><");
                    let qt =str[1];
                    let t = str[0];
                    titulo += ` + ${qt} x ${t}`;
                }
                $(".carrinho").append(`${titulo} <br>`);
            }
        }

    }

}

function showFooter(aberto){
    if(aberto == 1){
    $(".footer").css("height","90%");
    $(".itens").css("filter","opacity(0)");
    $(".itens").animate({"height":"0"});
    $(".itens").animate({"padding-bottom":"0px"});
    $(".etapa2").show();
    $('.cancel').show();
    $('.go').hide();
    if($("#name").val().length > 3){
        $(".etapa22").show();
    }
    montaCarrinho();
    }else{
        alert('Sentimos muito. Estamos descansando agora! Que tal voltar mais tarde? ;)');
    }
}
function floatToReal(valor){
    var formatter = new Intl.NumberFormat('pt-br', {
        style: 'currency',
        currency: 'BRL',
      });
      return formatter.format(valor);
}
function hideFooter(){
    $(".footer").css("height","100px");
    $(".itens").css("filter","opacity(1)");
    $(".itens").animate({"height":"450px"});
    $(".itens").animate({"padding-bottom":"25px"});
    $('.cancel').hide();
    $('.go').show();
    $(".etapa2").hide();

    $(".etapa22").hide();

}
function callbackNome(event){
   var name = $("#name").val();
   if(name.length > 3){
       $(".etapa22").show();
   }
}

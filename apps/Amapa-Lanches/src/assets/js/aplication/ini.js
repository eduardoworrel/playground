function filtraFuncaoParaHtml(arrayDeObjetos) {
    if (typeof arrayDeObjetos === 'object') {
        var i = 0;
        while (i < arrayDeObjetos.length) {
            var obj = arrayDeObjetos[i];
            if (typeof obj === 'object') {
                $(document).on(obj.evento, obj.seletor, obj.funcao)
            }
            i++
        }
    }
}
function chamaBT(data) {
    var data_ = data;
    if (data_.r1 === '1') {
        $.ajax({url: "includes/aplication/btn-adm.php", success: function (data) {
                $(".meuLugar").html(data);
                $(".eu").html(data_.r2)
            }})
    }
}
$(document).on("show.bs.modal", ".modal", function () {
    setTimeout(function () {
        $('body').addClass('modal-open')
    }, 500)
});
function setStyleMap(u) {
        u.map.changeStyle(1);
}
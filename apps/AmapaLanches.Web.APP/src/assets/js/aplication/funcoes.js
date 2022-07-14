pode = true;

function achar(tipo) {
    if (tipo == 1) {
        $(".oo div").removeClass("bs").addClass("bus");
        $(".naqqq").addClass("bs").removeClass("bus");
        $(".buscar").fadeIn("fast");
        $(".filtro").fadeOut("fast");
        $(".menu").fadeOut("fast");
        slideTop(".buscar");
    }
}
var canSendPassword = false;
var limit;

function isScrolledIntoView(elem) {
    var docViewTop = $(window).scrollTop();
    var docViewBottom = docViewTop + $(window).height();
    var elemTop = $(elem).offset().top;
    var elemBottom = elemTop + $(elem).height();
    return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
}

function slideTop(where) {
    $(where).animate({ scrollTop: 0 }, 300);
}

function analisa() {
    var status = {
        open: 0,
        dy: 0,
        cartao: 0,
        dis: 10
    };
    this.check = function(how, param) {
        if (how === "open") {
            status.open = param;
        }
        if (how === "dy") {
            status.dy = param;
        }
        if (how === "cartao") {
            status.cartao = param;
        }
        if (how === "dis") {
            status.dis = param;
        }

        let json = u.getLoc();
        all = firstAll.reduce((lv, ob) => {
            let can = true;
            if (status.open === 1) {
                if (ob.isOpen != 1) {
                    can = false;
                }
            }
            if (status.dy === 1) {
                if (ob.entrega != 1) {
                    can = false;
                }
            }
            if (status.cartao === 1) {
                if (ob.aceita_cartao != 1) {
                    can = false;
                }
            }
            if (status.dis === 6) {
                if (distance(json.lat, json.lng, ob.lat, ob.lng, "K") > 6.3) {
                    can = false;
                }
            } else if (status.dis === 4) {
                if (distance(json.lat, json.lng, ob.lat, ob.lng, "K") > 4.3) {
                    can = false;
                }

            } else if (status.dis === 1) {
                if (distance(json.lat, json.lng, ob.lat, ob.lng, "K") > 1.3) {
                    can = false;
                }
            }
            if (can) {
                lv.push(ob);
            }
            return lv;
        }, []);
        let int = all.length;
        let type = (int > 0) ? 4 : 3;
        var prototipo = getModelo("I.proximas");
        setPorBairros(groupByArray(all, 'bairro'), prototipo);
        setPorCartao(groupByArray(all, 'aceita_cartao'), prototipo);
        setPorEntrega(groupByArray(all, 'entrega'), prototipo);
        formataProximas(prototipo, all, ".sugestoes", 2, "all");
        u.map.setTodas(all);
        setTimeout(() => {

            notie.alert({
                type: type,
                text: "(" + int + ") Lanchonetes",
                time: 1.5,
                position: "bottom"
            });
        }, 300);
    }
}
var analisa = new analisa();

function distance(lat1, lon1, lat2, lon2, unit) {
    var radlat1 = Math.PI * lat1 / 180
    var radlat2 = Math.PI * lat2 / 180
    var theta = lon1 - lon2
    var radtheta = Math.PI * theta / 180
    var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
    if (dist > 1) {
        dist = 1;
    }
    dist = Math.acos(dist)
    dist = dist * 180 / Math.PI
    dist = dist * 60 * 1.1515
    if (unit == "K") {
        dist = dist * 1.609344
    }
    if (unit == "N") {
        dist = dist * 0.8684
    }
    return dist
}
var groupBy = function(xs, key) {
    return xs.reduce(function(rv, x) {
        (rv[x[key]] = rv[x[key]] || []).push(x);
        return rv;
    }, {});
};

function groupByArray(xs, key) {
    return xs.reduce(function(rv, x) {
        let v = key instanceof Function ? key(x) : x[key];
        let el = rv.find((r) => r && r.key === v);
        if (el) {
            el.values.push(x);
        } else {
            rv.push({ key: v, values: [x] });
        }

        return rv;
    }, []);
}

$(window).on("navigate", function(event, data) {
    var direction = data.state.direction;
    if (direction == 'back') {
        if ($('.modal').hasClass('in')) {

            $(".modal").modal("hide");
        }

    }
    if (direction == 'forward') {
        // do something else
    }
});

const ONCLICK = "click";
const ONCHANGE = "change";
function getArray() {
    return [{
            evento: ONCLICK,
            seletor: "._config",
            funcao: function() {
                $.ajax({
                    url: "includes/aplication/gate.php",
                    success: function(data) {
                        if (parseInt(data) == 0) {
                            window.location.reload(!0)
                        }
                    }
                })
            }
        }, {
            evento: ONCLICK,
            seletor: "._ver-box",
            funcao: function() {
                const box = $(".coment-box");
                if (!$(this).hasClass("view")) {
                    box.css('display', 'inline');
                    $(this).addClass("view").html("<i class='material-icons'>cancel</i> Cancelar</span>")
                } else {
                    box.css('display', 'none');
                    $(this).removeClass("view").html("<i class='material-icons'>chat</i> Comentar</span>")
                }
            }
        }, {
            evento: ONCHANGE,
            seletor: "#changeStyle",
            funcao: function(e) {
                changeStyle(e)
            }
        }, {
            evento: ONCLICK,
            seletor: "#card",
            funcao: function(e) {
                $("#home").toggle("normal");
            }
        }, {
            evento: ONCLICK,
            seletor: "#proximas",
            funcao: function(e) {
                $("#prox").toggle("normal");
            }
        }, {
            evento: ONCLICK,
            seletor: "#bb",
            funcao: function(e) {
                $(this).find("i").toggleClass("toBack");
                $(".cont-" + $(this).data('param')).toggle("normal");
            }
        }, {
            evento: ONCLICK,
            seletor: "._coc",
            funcao: function() {
                $(".login").collapse('hide')
            }
        }, {
            evento: ONCLICK,
            seletor: "._pa",
            funcao: function() {
                $("#menu").modal('hide');
                var id = $(this).find('.myId').val();
                getDetalhes(id, 1)
            }
        }, {
            evento: ONCLICK,
            seletor: ".tt",
            funcao: function() {
                var value = parseInt($(this).data("param"));
                if (value > -1 && value < 2) {
                    if ($(this).hasClass("boxUnSelected")) {
                        $(".tt").removeClass("boxSelected").addClass("boxUnSelected");
                        $(this).removeClass("boxUnSelected").addClass("boxSelected");
                        analisa.check("open", value);
                    }
                }
            }
        }, {
            evento: ONCLICK,
            seletor: ".tt2",
            funcao: function() {
                var value = parseInt($(this).data("param"));
                console.log(value);
                if (value > -1 && value < 2) {
                    if ($(this).hasClass("boxUnSelected")) {
                        $(".tt2").removeClass("boxSelected").addClass("boxUnSelected");
                        $(this).removeClass("boxUnSelected").addClass("boxSelected");
                        analisa.check("dy", value);
                    }
                }
            }
        }, {
            evento: ONCLICK,
            seletor: ".oo",
            funcao: function() {
                var value = parseInt($(this).data("o"));
                let el = $(this).find("div");
                if (value > -1 && value < 3) {
                    if (el.hasClass("bus")) {
                        $(".oo div").removeClass("bs").addClass("bus");
                        el.removeClass("bus").addClass("bs");
                        if (value == 0) {
                            $(".buscar").fadeIn("fast");
                            $(".filtro").fadeOut("fast");
                            $(".menu").fadeOut("fast");
                        } else if (value == 1) {
                            $(".buscar").fadeOut("fast");
                            $(".filtro").fadeIn("fast");
                            $(".menu").fadeOut("fast");
                        } else {
                            $(".buscar").fadeOut("fast");
                            $(".filtro").fadeOut("fast");
                            $(".menu").fadeIn("fast");
                        }
                    }
                }
            }
        }, {
            evento: ONCLICK,
            seletor: ".tt3",
            funcao: function() {
                var value = parseInt($(this).data("param"));
                if (value > -1 && value < 2) {
                    if ($(this).hasClass("boxUnSelected")) {
                        $(".tt3").removeClass("boxSelected").addClass("boxUnSelected");
                        $(this).removeClass("boxUnSelected").addClass("boxSelected");
                        analisa.check("cartao", value);
                    }
                }
            }
        },
        {
            evento: ONCLICK,
            seletor: ".tt4",
            funcao: function() {
                if (canRoute) {
                    var value = parseInt($(this).data("param"));
                    if (value > 0 && value < 10) {
                        if ($(this).hasClass("boxUnSelected")) {
                            $(".tt4").removeClass("boxSelected").addClass("boxUnSelected");
                            $(this).removeClass("boxUnSelected").addClass("boxSelected");
                            analisa.check("dis", value);
                        }
                    }
                } else {
                    myLocation();
                    setTimeout(function() {
                        if (canRoute) {
                            var value = parseInt($(this).data("param"));
                            if (value > 0 && value < 10) {
                                if ($(this).hasClass("boxUnSelected")) {
                                    $(".tt4").removeClass("boxSelected").addClass("boxUnSelected");
                                    $(this).removeClass("boxUnSelected").addClass("boxSelected");
                                    analisa.check("dis", value);
                                }
                            }
                        }
                    }, 800);
                }
            }
        },
        {
            evento: ONCLICK,
            seletor: ".entenda",
            funcao: function() {
                $("#gestao").modal('hide');
                setTimeout(function() {
                    $("#sobre").modal('show');
                }, 700);
            }
        }, {
            evento: ONCLICK,
            seletor: "._orcrux",
            funcao: function() {
                $(".lanchonetes").modal('hide');
                var id = $(this).find('.myId').val();
                var from = $(this).find('.from').val();
                var where = $(this).find('.whereback').val();
                getDetalhes(id, from, where);
                $('.modal').animate({
                    scrollTop: 0
                }, 'fast')
            }
        }, {
            evento: ONCLICK,
            seletor: "._vpm",
            funcao: function() {
                $('.detalhe-lanchonete').modal('hide');
                $("#menu").modal('show')
            }
        }, {
            evento: ONCLICK,
            seletor: "._loc",
            funcao: function() {
                $(".cadastro").collapse('hide')
            }
        }, {
            evento: ONCLICK,
            seletor: "#_nl",
            funcao: function() {
                let ok = 0;
                if (ok === 0) {
                    $(this).html("<i class='fa fa-refresh fa-spin'></i>");
                    ok++
                }
                if (ok > 0) {
                    ok--;
                    navigator.geolocation.getCurrentPosition(function(pos) {
                        var lat = pos.coords.latitude;
                        var lng = pos.coords.longitude;
                        $.ajax({
                            url: "includes/estrutura/formularios/validaLanchonete.php",
                            type: 'POST',
                            data: {
                                lat: lat,
                                lng: lng
                            },
                            success: function(data) {
                                $("#_nlContent").html(data);
                                $(".nova-lanchonete").modal('show')
                            }
                        }, function() {})
                    })
                }
            }
        }, {
            evento: ONCLICK,
            seletor: "._vm",
            funcao: function() {
                $(".aplication").hide("fast").html(null);
                $(".meuLugar,.place").show('fast')
            }
        }, {
            evento: ONCHANGE,
            seletor: "#myAv",
            funcao: function() {
                i = 0;
                var val = $(this).val();
                if (val < 6 && val >= 0) {
                    var str = "";
                    while (i < 5) {
                        if (i >= val) {
                            str += "<i class='fa fa-star-o'></i>"
                        } else {
                            str += "<i style='color:yellow' class='fa fa-star'></i>"
                        }
                        i++
                    }
                    $(".myAvCoplation").html(str)
                }
            }
        }, {
            evento: ONCLICK,
            seletor: "._cnu",
            funcao: function() {
                if (pode) {
                    const numeroTel = $(".numeroTel").val();
                    const dataNasci = $(".dataNasci").val();
                    const senha = $(".senha").val();
                    var erro = 0;
                    var btClose = "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" + "<span aria-hidden='true'>&times;</span>" + "</button>";
                    if (senha.length < 3 || senha.length > 32) {
                        var str = "<div class='alert alert-danger'>" + btClose + "Senha precisa ter mais de <b>3</b> e menos de  <b>32</b> caracterers.</div>";
                        $(".fdbk").html(str);
                        var erro = 1
                    }

                    if (erro === 0) {
                        pode = false;
                        $.ajax({
                            url: "includes/aplication/recebeUsuario.php",
                            type: "POST",
                            data: {
                                numero: numeroTel,
                                data: dataNasci,
                                senha: senha
                            },
                            success: function(data) {
                                if (parseInt(data) === 0) {
                                    alert("erro ao salvar no banco de dados ;/");
                                } else {
                                    $(".frist").hide();
                                    $(".beforeSend").show();
                                }
                                pode = true;
                            }
                        })
                    } else {}
                }
            }
        }, {
            evento: "click",
            seletor: "#_sl",
            funcao: function() {

                var g = $(".g-recaptcha-response").val();
                if (g.length > 1)
                    $.ajax({
                        url: "includes/aplication/recebeLanchonete.php",
                        type: 'POST',
                        data: {
                            param: 2,
                            r: g
                        },
                        success: function(data) {
                            if (parseInt(data) == 0) {
                                $("#_nlContent").html("<i class='fa fa-spin fa-refresh'></i>");
                                setTimeout(function() {
                                    $(".nova-lanchonete").modal('hide');
                                    $("#menu").modal('show')
                                }, 2000)
                            }
                        }
                    });
                grecaptcha.reset()
            }
        }, {
            evento: "click",
            seletor: ".selectTipo",
            funcao: function() {
                //
            }
        }, {
            evento: "click",
            seletor: "#levaOcara",
            funcao: function() {
                var v = $("#levaOcara").data("param2");
                $.ajax({
                    url: "includes/v1/getRota.php",
                    type: 'POST',
                    data: {
                        v: v
                    },
                    success: function(data) {
                        $(".modal").modal('hide');
                        $(".modal-backdrop").remove();
                        $("#lanchoneteOnSelect").fadeIn('fast');
                        $("#lanchoneteOnSelect .a").html("<i class='fa fa-spin fa-refresh'></i>");
                        $("#lanchoneteOnSelect .b").html("<i class='fa fa-spin fa-refresh'></i>");
                        str = "<a class='pull-right mdl-button mdl-js-button  mdl-js-ripple-effect' style='font-size: 2em;' id='returnNavigation' " +
                            "data-param='" + data.id + "' data-param2='1' >FECHAR <i class='material-icons'>cancel</i></a>";
                        $(".forButton").html(str);
                        let lat = data.lat;
                        let lng = data.lng;
                        var destination = new google.maps.LatLng(lat, lng);
                        setDirection(destination)
                    }
                })
            }
        }, {
            evento: "click",
            seletor: "#_nlc",
            funcao: function() {
                $.ajax({
                    url: "includes/estrutura/formularios/newLanche.html",
                    success: function(data) {
                        $('.forForm').html(data);
                        $('.lanches').slideUp('fast')
                    }
                })
            }
        }, {
            evento: "click",
            seletor: "#_el",
            funcao: function() {
                $(this).html("<i class='fa fa-spin fa-refresh'></i>")
                $.ajax({
                    url: "includes/aplication/recebeLanchonete.php",
                    type: 'POST',
                    data: {
                        param: 4
                    },
                    success: function(data) {
                        window.location.reload()
                    }
                })
            }
        }, {
            evento: "click",
            seletor: "#_fl",
            funcao: function() {
                $.ajax({
                    url: "includes/aplication/recebeLanchonete.php",
                    type: 'POST',
                    data: {
                        param: 5
                    },
                    success: function(data) {
                        var int = parseInt(data);
                        if (int == 0) {
                            $(".contDe").html("<div class='alert alert-info'>Obrigado</div>")
                        }
                    }
                })
            }
        }, {
            evento: "click",
            seletor: "._fl",
            funcao: function() {
                $.ajax({
                    url: "includes/aplication/recebeLanchonete.php",
                    type: 'POST',
                    data: {
                        param: 6
                    },
                    success: function(data) {
                        if (parseInt(data) === 0) {
                            if (navigator.geolocation) {
                                navigator.geolocation.getCurrentPosition(function(position) {
                                    var lat = position.coords.latitude;
                                    var lng = position.coords.longitude;
                                    $.ajax({
                                        url: "includes/aplication/askHaveLanchonete.php",
                                        type: 'POST',
                                        data: {
                                            ac: "del",
                                            lat: lat,
                                            lng: lng
                                        },
                                        success: function(data) {
                                            if (parseInt(data) === 0) {
                                                $.ajax({
                                                    url: "getMap.php",
                                                    type: 'POST',
                                                    data: {
                                                        param: 1
                                                    },
                                                    success: function(data) {
                                                        $('#formap').html(data)
                                                    }
                                                });
                                                $(".nova-lanchonete").modal("hide")
                                            }
                                        }
                                    })
                                })
                            }
                        }
                    }
                })
            }
        }, {
            evento: "click",
            seletor: "._vld",
            funcao: function() {
                var titulo = $("#titulo").val();
                var subtitulo = $("#subtitulo").val();
                var hora_abre = $("#hora_abre").val();
                var hora_fecha = $("#hora_fecha").val();
                var telefone = $("#telefone").val();
                var entrega = 0;
                if ($('#entrega').is(":checked")) {
                    entrega = 1
                }
                var cartao = 0;
                if ($('#cartao').is(":checked")) {
                    cartao = 1
                }
                $.ajax({
                    url: "includes/aplication/recebeLanchonete.php",
                    type: 'POST',
                    data: {
                        param: 3,
                        titulo: titulo,
                        subtitulo: subtitulo,
                        hora_abre: hora_abre,
                        hora_fecha: hora_fecha,
                        telefone: telefone,
                        entrega: entrega,
                        cartao: cartao
                    },
                    success: function(data) {
                        if (parseInt(data) === 0) {
                            $.ajax({
                                url: "includes/estrutura/formularios/cadastraLanches.html",
                                success: function(data) {
                                    $(".primeInfos").hide().after(data)
                                }
                            })
                        }
                    }
                })
            }
        }, {
            evento: "click",
            seletor: ".bt-sobre",
            funcao: function() {
                $("#gestao").modal('hide');
                $("#sobre").modal('show')
            }
        }, {
            evento: "click",
            seletor: ".bt-sol",
            funcao: function() {
                $("#sobre").modal('show')
            }
        },
        {
            evento: "click",
            seletor: "#exploraL",
            funcao: function() {
                //                $(".principalModal").toggleClass("especialModal");
                $(".placeLanchonetes, .aplication").toggle("normal");
            }
        },
        {
            evento: "click",
            seletor: "#exploraUser",
            funcao: function() {
                //                $(".principalModal").toggleClass("especialModal");
                $(".touser, .aplication").toggle("normal");
            }
        },
        {
            evento: "click",
            seletor: "#estilizar",
            funcao: function() {
                //                $(".principalModal").toggleClass("especialModal");
                $(".toestilo, .aplication").toggle("normal");
            }
        },
        {
            evento: "click",
            seletor: "#filtrar",
            funcao: function() {
                //                $(".principalModal").toggleClass("especialModal");
                $(".tofilter, .aplication").toggle("normal");
            }
        },
        {
            evento: "click",
            seletor: "#instalar",
            funcao: function() {
                //                $(".principalModal").toggleClass("especialModal");
                $(".toinstal, .aplication").toggle("normal");
            }
        },
        {
            evento: "click",
            seletor: "#exploraContato",
            funcao: function() {
                //                $(".principalModal").toggleClass("especialModal");
                $(".tocontato, .aplication").toggle("normal");
            }
        },
        {
            evento: "click",
            seletor: ".android",
            funcao: function() {
                $(".t-android").toggle("normal");
                $(".t-ios").hide("normal");
            }
        },
        {
            evento: "click",
            seletor: ".ios",
            funcao: function() {

                $(".t-ios").toggle("normal");
                $(".t-android").hide("normal");
            }
        },
        {
            evento: "click",
            seletor: ".btTryCad",
            funcao: function() {
                let value = $(".getCodeConv").val();
                if (value) {
                    $.ajax({
                        url: "includes/v1/cc/getConvite.php",
                        data: { value: value },
                        success: function(data) {
                            if (data == 1) {
                                $.ajax({
                                    url: "includes/v1/cc/startCadastro.html",
                                    data: { value: value },
                                    success: function(data) {
                                        $(".etapa1").hide();
                                        $(".etapa2").html(data).removeClass("hide");
                                        $(".numeroTel").val($("#login").val());
                                    }
                                });
                            } else {
                                notie.alert({
                                    type: 2,
                                    text: "INDISPONÍVEL",
                                    time: 3,
                                    position: "bottom"
                                });
                            }
                        }
                    });
                } else {

                    alert("REJEITADO");
                }

            }
        },
        {
            evento: "click",
            seletor: ".returnTM",
            funcao: function() {

                //                $(".principalModal").toggleClass("especialModal");
                $(".touser,.toinstal,.tocontato,.toestilo,.tofilter").hide("fast");
                $(".aplication").toggle("normal");
            }
        },
        {
            evento: "click",
            seletor: ".chanages",
            funcao: function() {
                var p = $(this).data('param');
                if (p > 0 && p < 4) {
                    changeStyle(p);
                }
            }
        },
        {
            evento: "click",
            seletor: ".cc",
            funcao: function() {

                $(this).toggleClass("activetion");
            }
        },
        {
            evento: "click",
            seletor: "#exploraBairro",
            funcao: function() {

                $(this).find("i").toggleClass("toBack");
                $("#returnedBairros").toggle("normal");
            }
        },
        {
            evento: "click",
            seletor: "#exploraProximas",
            funcao: function() {
                let ar1 = [];
                let ar2 = [];
                let ar3 = [];
                let ar4 = [];
                all.reduce((lv, ob) => {
                    let me = u.getLoc();
                    let dis = distance(me.lat, me.lng, ob.lat, ob.lng, "K");
                    if (dis <= 1) {
                        ar1.push(ob);
                    }
                    if (dis > 1 && dis <= 4) {
                        ar2.push(ob);
                    }
                    if (dis > 4 && dis <= 6) {
                        ar3.push(ob);
                    }
                    if (dis > 6 && dis <= 10) {
                        ar4.push(ob);
                    }
                });
                var prototipo = getModelo("I.proximas");
                formataProximas(prototipo, ar1, "#d1", 2, "dis");
                formataProximas(prototipo, ar2, "#d2", 2, "dis");
                formataProximas(prototipo, ar3, "#d3", 2, "dis");
                formataProximas(prototipo, ar4, "#d4", 2, "dis");
                $(this).find("i").toggleClass("toBack");
                $("#returnedProximas").toggle("normal");
            }
        },
        {
            evento: "click",
            seletor: ".seeD",
            funcao: function() {

                $(this).find("i").toggleClass("toBack");
                $("#d" + $(this).data("param")).toggle("normal");
            }
        },
        {
            evento: "click",
            seletor: "#exploraDelivery",
            funcao: function() {

                $(this).find("i").toggleClass("toBack");
                $("#returnedDelivery").toggle("normal");
            }
        },
        {
            evento: "click",
            seletor: "#exploraCartao",
            funcao: function() {

                $(this).find("i").toggleClass("toBack");
                $("#returnedCartao").toggle("normal");
            }
        }, {
            evento: "keyup",
            seletor: "#buscaWord",
            funcao: function() {
                let v1 = $(this).val();
                if (v1.length > 0) {
                    setTimeout(() => {
                        let v2 = $(this).val();
                        if (v1 === v2) {
                            $('.fors').addClass("loading");
                            $.ajax({
                                url: "includes/v1/getCaixaDePesquisa.php",
                                data: { word: v1 },
                                success: (data) => {
                                    const prot = getModelo("I.proximas");
                                    formataProximas(prot, data.lanchonetes, ".place", 2, "busca");
                                    $(".forFind").removeClass("none");
                                    $(".resultQT").html(data.lanchonetes.length);
                                    $('.fors').removeClass("loading");
                                }
                            });
                        }
                    }, 1000);
                } else {
                    $(".forFind").addClass("none");
                }
            }
        },
        {
            evento: "click",
            seletor: ".avisos button",
            funcao: function() {
                $(this).toggleClass("op");
            }
        }, {
            evento: "click",
            seletor: ".bt-pan",
            funcao: function() {
                pan()
            }
        }, {
            evento: "click",
            seletor: ".bt-lanchonetes",
            funcao: function() {
                $(".lanchonetes").modal("show");
            }
        }, {
            evento: "click",
            seletor: ".bt-login",
            funcao: function() {
                $("#gestao").modal('hide');
                $("#__login").modal('show');
                $("#login").focus()
            }
        }, {
            evento: "click",
            seletor: ".bt-menu",
            funcao: function() {
                $("#gestao").modal('hide');
                $("#menu").modal('show')
            }
        }, {
            evento: "click",
            seletor: ".bt-menu",
            funcao: function() {
                $("#menu").modal('show')
            }
        }, {
            evento: "click",
            seletor: ".bt-gestao",
            funcao: function() {
                $("#gestao").modal('show')
            }
        }, {
            evento: "click",
            seletor: "#backw",
            funcao: function() {
                $(".modal").modal('hide');
                $("#gestao").modal('show')
            }
        }, {
            evento: "click",
            seletor: "._alc",
            funcao: function() {
                var _s = "_lc";
                var titulo = $("#titulo" + _s).val();
                var preco = $("#preco" + _s).val();
                var ingredientes = $("#ingredientes" + _s).val();
                $.ajax({
                    url: "includes/aplication/recebeLanche.php",
                    type: 'POST',
                    data: {
                        param: 1,
                        titulo: titulo,
                        preco: preco,
                        ingredientes: ingredientes
                    },
                    success: function(data) {
                        $('.forForm').html(data);
                        $('.lanches').slideUp('fast')
                    }
                })
            }
        },
        {
            evento: "click",
            seletor: "#bye",
            funcao: function() {
                $.ajax({
                    url: "sair.php",
                    success: function(data) {
                        $(".forl").html("<div class='mdl-button mdl-js-button bt-login'><i class='material-icons'>streetview</i> ACESSAR SISTEMA</div>");
                        $('.meuLugar').html(data)
                    }
                })
            }
        },
        {
            evento: "click",
            seletor: ".returnCadCentral",
            funcao: function() {
                $(".into_user").show("fast");
                $(".byUser").hide("fast");
                $(".doRetry").hide("fast");
            }
        },
        {
            evento: "click",
            seletor: ".entrar",
            funcao: function() {
                $(".into_user").hide("fast");
                $(".doLogin").show("fast");
            }
        },
        {
            evento: "click",
            seletor: ".validarcodigo",
            funcao: function() {
                $(".into_user").hide("fast");
                $(".doRetry").show("fast");
                $(".doLogin").show("fast");
            }
        },
        {
            evento: "click",
            seletor: ".criarconta",
            funcao: function() {
                $(".into_user").hide("fast");
                $(".doCad").show("fast");
            }
        },
        {
            evento: "click",
            seletor: ".byebye",
            funcao: function() {
                $.ajax({
                    url: 'includes/aplication/logout.php',
                    success: function(data) {
                        $(".touser").show('fast');
                        $(".touserLoged").hide('fast');
                        userOn = false;
                        myLocation();
                        //                        history.pushState({}, null, "https://amapalanches.com");
                    }
                });
            }
        },
        {
            evento: "click",
            seletor: "._tryBySms",
            funcao: function() {
                var senha = $(".senha").val();
                var token = $(".codigoSMS").val();
                token = (token) ? token : "0";
                if (senha && token) {
                    $.ajax({
                        url: "includes/aplication/defineLogin.php",
                        type: 'POST',
                        data: {
                            token: token,
                            senha: senha
                        },
                        success: function(data) {
                            const val = parseInt(data);
                            switch (val) {
                                case 1:
                                    $.ajax({
                                        url: "includes/v1/cc/checkInfo.php?new=" +
                                            Math.floor(Math.random() * 1000),
                                        success: function(data) {
                                            if (isNaN(parseInt(data))) {
                                                let ob = signo(data);
                                                userOn = { on: true, img: ob.img };
                                                $(".toLogedUImage").attr("src",
                                                    "https://amapalanches.com/assets/$_imgs/s/" + ob.img);
                                                $(".aplication,.touser").hide('fast');
                                                $(".touserLoged").show('fast');
                                                canSendPassword = false;
                                                myLocation(userOn);
                                            }
                                        }
                                    });
                                    break;
                                case 2:
                                    notie.alert({
                                        type: 3,
                                        text: "SENHA INCORRETA!!",
                                        time: 4,
                                        position: "bottom"

                                    });
                                    break;
                                case -1:
                                    notie.alert({
                                        type: 3,
                                        text: "CÓDIGO SMS INVALIDO.",
                                        time: 4,
                                        position: "bottom"
                                    });
                                    break;
                            }
                            $("#_tryLogin").html("AVANÇAR");
                        }
                    })
                }
            }
        },
        {
            evento: "click",
            seletor: "#_tryLogin",
            funcao: function() {

                if (!canSendPassword) {
                    var login = $("#login").val();
                    if (!(login)) {
                        notie.alert({
                            type: 2,
                            text: "DIGITE SEU NÚMERO",
                            time: 3,
                            position: "bottom"
                        });
                        $("#login").focus();
                        return;
                    }

                    notie.alert({
                        type: 4,
                        text: "VERIFICANDO NÚMERO",
                        time: 4
                    });
                    $("#_tryLogin").html("<i class='material-icons spin'>brightness_7</i>");
                    $.ajax({
                        url: "includes/aplication/recebeLogin.php",
                        type: 'POST',
                        data: {
                            login: login,
                        },
                        success: function(data) {
                            const val = parseInt(data);
                            switch (val) {
                                case 1:
                                    $(".doSenha").show("fast");
                                    canSendPassword = true;
                                    break;
                                case 2:
                                    $(".doRetry").show("fast");
                                    $(".doSenha").show("fast");
                                    canSendPassword = true;
                                    break;
                                case 3:
                                    $(".into_user").hide("fast");
                                    $(".doCad").show("fast");
                                    break;
                            }
                            $("#_tryLogin").html("AVANÇAR");
                        }
                    })
                } else {
                    var senha = $("#senha_ac").val();
                    var token = $(".retry_codigoSMS").val();
                    token = (token) ? token : "0";
                    if (senha && token) {
                        $.ajax({
                            url: "includes/aplication/defineLogin.php",
                            type: 'POST',
                            data: {
                                token: token,
                                senha: senha
                            },
                            success: function(data) {
                                const val = parseInt(data);
                                switch (val) {
                                    case 1:
                                        $.ajax({
                                            url: "includes/v1/cc/checkInfo.php?new=" +
                                                Math.floor(Math.random() * 1000),
                                            success: function(data) {
                                                if (isNaN(parseInt(data))) {
                                                    let ob = signo(data);
                                                    userOn = { on: true, img: ob.img };
                                                    $(".toLogedUImage").attr("src",
                                                        "https://amapalanches.com/assets/$_imgs/s/" + ob.img);
                                                    $(".aplication,.touser").hide('fast');
                                                    $(".touserLoged").show('fast');
                                                    canSendPassword = false;
                                                    myLocation(userOn);
                                                    //                                                    history.pushState({}, null, "https://amapalanches.com?start");
                                                }
                                            }
                                        });
                                        break;
                                    case 2:
                                        notie.alert({
                                            type: 3,
                                            text: "SENHA INCORRETA!!",
                                            time: 4,
                                            position: "bottom"

                                        });
                                        break;
                                    case -1:
                                        notie.alert({
                                            type: 3,
                                            text: "CÓDIGO SMS INVALIDO.",
                                            time: 4,
                                            position: "bottom"
                                        });
                                        break;
                                }
                                $("#_tryLogin").html("AVANÇAR");
                            }
                        })
                    }
                    var senha = $("#senha_ac").val();
                    var token = $(".retry_codigoSMS").val();
                    token = (token) ? token : "0";
                    if (senha && token) {
                        $.ajax({
                            url: "includes/aplication/defineLogin.php",
                            type: 'POST',
                            data: {
                                token: token,
                                senha: senha
                            },
                            success: function(data) {
                                const val = parseInt(data);
                                switch (val) {
                                    case 1:
                                        $.ajax({
                                            url: "includes/v1/cc/checkInfo.php?new=" +
                                                Math.floor(Math.random() * 1000),
                                            success: function(data) {
                                                if (isNaN(parseInt(data))) {
                                                    let ob = signo(data);
                                                    userOn = { on: true, img: ob.img };
                                                    $(".toLogedUImage").attr("src",
                                                        "https://amapalanches.com/assets/$_imgs/s/" + ob.img);
                                                    $(".aplication,.touser").hide('fast');
                                                    $(".touserLoged").show('fast');
                                                    canSendPassword = false;
                                                    myLocation(userOn);
                                                    //                                                    history.pushState({}, null, "https://amapalanches.com?start");
                                                }
                                            }
                                        });
                                        break;
                                    case 2:
                                        notie.alert({
                                            type: 3,
                                            text: "SENHA INCORRETA!!",
                                            time: 4,
                                            position: "bottom"

                                        });
                                        break;
                                    case -1:
                                        notie.alert({
                                            type: 3,
                                            text: "CÓDIGO SMS INVALIDO.",
                                            time: 4,
                                            position: "bottom"
                                        });
                                        break;
                                }
                                $("#_tryLogin").html("AVANÇAR");
                            }
                        })
                    }

                }
            }
        },
        {
            evento: "click",
            seletor: ".returnMenu",
            funcao: function() {
                $(".detalhe-lanchonete").modal('hide');
                $(".lanchonetes").modal('show')
                setTimeout(() => {
                    if (!$('.whereToReturn').val() === "") {
                        var $container = $(".modal");
                        var $scrollTo = $("." + $('.whereToReturn').val());
                        $container
                            .animate({
                                scrollTop: $scrollTo.offset().top - $container.offset().top +
                                    $container.scrollTop(),
                                scrollLeft: 0
                            }, 500);
                    }
                }, 600);
            }
        },
        {
            evento: "click",
            seletor: ".seeCardapio",
            funcao: function() {
                $(".rowsLanchnete").hide("normal");
                $("#home").show("normal");
                slideTop(".modal");
            }
        },
        {
            evento: "click",
            seletor: ".returnTolanchonete",
            funcao: function() {
                $("#home").hide("normal");
                $(".rowsLanchnete").show("normal");
                setTimeout(() => {
                    var $container = $(".modal");
                    var $scrollTo = $(".indici");
                    $container.animate({ scrollTop: $scrollTo.offset().top - $container.offset().top + $container.scrollTop(), scrollLeft: 0 }, 300);
                }, 600);
            }
        },
        {
            evento: "click",
            seletor: "#returnNavigation",
            funcao: function() {
                $("#lanchoneteOnSelect .a").html(null);
                $("#lanchoneteOnSelect .b").html(null);
                $("#lanchoneteOnSelect").fadeOut('fast');
                killDisplay();
                var id = $(this).data('param');
                var v = $(this).data('param2');
                getDetalhes(id, v)
            }
        }, {
            evento: "click",
            seletor: "._rc",
            funcao: function() {
                let erro = [];
                const comentario = $(".comentario").val();
                const tk = $("#tks").val();
                if (comentario.length > 300 || comentario.length < 3) {
                    erro.push(1)
                } else {
                    $(".comentario").val(null).focus()
                }
                if (erro.length < 1) {
                    const id = $(this).data('param');
                    $.ajax({
                        url: "includes/aplication/recebeComentario.php",
                        type: 'POST',
                        data: {
                            tk: tk,
                            cm: comentario
                        },
                        success: function(data) {
                            const int = parseInt(data);
                            if (isNaN(int)) {
                                getComentarios(data);
                                $("#tks").val(data)
                            }
                            switch (int) {
                                case 7:
                                    break
                            }
                        }
                    })
                }
            }
        }, {
            evento: "click",
            seletor: "._maisComentarios",
            funcao: function() {
                notie.alert({
                    type: 2,
                    text: "Aguarde",
                    time: 1
                });
                if (!isNaN(limit)) {
                    limit = limit + 3;
                    $.ajax({
                        url: "includes/v1/getComentarios.php",
                        data: {
                            foo: $(this).data('param'),
                            nc: $(this).data('nc'),
                            action: limit
                        },
                        success: function(data) {
                            let i = 0;
                            if (data.comentarios.length < 1) {
                                notie.alert({
                                    type: 2,
                                    text: "Acabou!",
                                    time: 2
                                });
                            }
                            //                            $(".loaded-comentarios").html("");
                            while (i < data.comentarios.length) {
                                let ob = data.comentarios[i];
                                $(".loaded-comentarios").append(
                                    "<div class='col-xs-12 umComentario'><div class='col-xs-2 noPadding'><img src='assets/$_imgs/s/" +
                                    signo(ob.signo).img +
                                    "' width=100%></div>" +
                                    "<div class='col-xs-10'>" +
                                    signo(ob.signo).preComentario + " de " + ob.idade + " disse:" +
                                    "<br>" +
                                    ob.comentario + "</div>" +
                                    "<div class='col-xs-12' style='text-align:right;'><small>" +
                                    ob.dataHora +
                                    "</small></div></div>"
                                );
                                i++

                            }
                            if (i < 3) {
                                limit = 3;
                                $("._maisComentarios").hide()
                            }
                        }
                    })

                }
            }
        }, {
            evento: "click",
            seletor: "._ra",
            funcao: function() {
                const tk = $("#tks").val();
                var av = $(this).data('param');
                $.ajax({
                    url: "includes/aplication/recebeAvaliacao.php",
                    type: 'POST',
                    data: {
                        tk: tk,
                        av: av
                    },
                    success: function(data) {
                        const int = parseInt(data);
                        if (isNaN(int)) {
                            $("#tks").val(data);
                            $(".avaliation").collapse('hide')
                        }
                    }
                })
            }
        }, {
            evento: "click",
            seletor: ".addMode",
            funcao: function() {
                $.ajax({
                    url: "getMap.php",
                    type: 'POST',
                    data: {
                        param: 1
                    },
                    success: function(data) {
                        $('#formap').html(data);
                        $('.addMode').removeClass('addMode').addClass('explorerMode').html('<i class="material-icons">visibility_off</i>')
                    }
                })
            }
        }, {
            evento: "click",
            seletor: "._ne",
            funcao: function() {
                $.ajax({
                    url: "getMap.php",
                    type: 'POST',
                    data: {
                        param: 1
                    },
                    success: function(data) {
                        $('#formap').html(data);
                        $('.addMode').removeClass('addMode btn-info').addClass('explorerMode btn-warning').html('Explorar');
                        $('.nova-lanchonee').modal('hide')
                    }
                })
            }
        }, {
            evento: "click",
            seletor: ".explorerMode",
            funcao: function() {
                $.ajax({
                    url: "getMap.php",
                    type: 'POST',
                    data: {
                        param: 0
                    },
                    success: function(data) {
                        $('#formap').html(data);
                        $('.explorerMode').addClass('addMode').removeClass('explorerMode').html('<i class="material-icons">visibility</i>')
                    }
                })
            }
        }
    ]
}
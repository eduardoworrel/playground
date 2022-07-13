var mcOptions = { gridSize: 50, maxZoom: 15 };
var modelo = [];

function getModelo(key) {
    var i = 0;
    while (i < modelo.length) {
        if (modelo[i].key === key) {
            return modelo[i].value
        }
        i++
    }
}

function putModelo(key, value) {
    var obj = { key: key, value: value };
    modelo.push(obj)
}
var u;

function changeStyle(x) {
    u.map.changeStyle(x)
}

function getMyLocation() {
    return u.getLocation()
}

function killDisplay() {
    u.map.directionsDisplay.setMap(null)
}

function setDirection(destination, pos) {
    var service = new google.maps.DistanceMatrixService();
    var directionsService = new google.maps.DirectionsService();
    let d = u.getLoc();
    var origin = new google.maps.LatLng(d.lat, d.lng);
    u.map.directionsDisplay.setMap(u.map.mapa);
    var request = { origin: origin, destination: destination, travelMode: 'DRIVING' };
    directionsService.route(request, function(result, status) {
        if (status == 'OK') {
            u.map.directionsDisplay.setDirections(result)
        }
    });
    service.getDistanceMatrix({ origins: [origin], destinations: [destination], travelMode: 'DRIVING' }, callback);

    function callback(response, status) {
        var distancia = response.rows[0].elements[0].distance.text;
        var duracao = response.rows[0].elements[0].duration.text;
        $("#lanchoneteOnSelect .a").html(distancia);
        $("#lanchoneteOnSelect .b").html(duracao)
    }
}

function watchLocation(userLocation) {
    let positionTimer = navigator.geolocation.watchPosition(function(position) {
        lat = position.coords.latitude;
        lng = position.coords.longitude;
        changeLocation(userLocation, lat, lng)
    })
}

function changeLocation(userLocation, lat, lng) {
    u.setLoc(lat, lng);
    userLocation.setPosition(new google.maps.LatLng(lat, lng))
}

function pan() {
    ob = u.getLoc();
    u.map.mapa.panTo(new google.maps.LatLng(ob.lat, ob.lng))
}
var canRoute = false;
var inTimeOut = false;

function myLocation(_new) {
    //    $(".modal").modal("hide"); 
    if (_new) {
        userOn = _new;
        u.userLocation.setMap(null);
        u.userLocation = null;
    }
    let icon = (userOn) ? "/assets/$_imgs/s/sm-" + userOn.img : "/assets/$_imgs/m.png";
    
    setTimeout(() => {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(pos) {
                u.userLocation = new google.maps.Marker({
                    map: u.map.mapa,
                    position: new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude),
                    icon: icon
                });
                changeLocation(u.userLocation, pos.coords.latitude, pos.coords.longitude);

                watchLocation(u.userLocation);
                u.map.mapa.panTo(new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude))
                resize();
                $("#getLo").attr("src", "assets/$_imgs/goGPSOK.png");
                $(".forProximas").removeClass("none");
                canRoute = true;


                var prototipo = getModelo("I.proximas");

                setPorBairros(groupByArray(all, 'bairro'), prototipo);
                setPorCartao(groupByArray(all, 'aceita_cartao'), prototipo);
                setPorEntrega(groupByArray(all, 'entrega'), prototipo);
                formataProximas(prototipo, all, ".sugestoes", 2, "all");

            }, function() {}, { enableHighAccuracy: !0, timeout: 60000, maximumAge: 0 })
        }
        if (!canRoute)
            notie.alert({
                type: 2,
                text: "Seu dispositivo não forneceu a localização",
                time: 3,
                position: "bottom"
            });
            
    }, 20000);
}

function resize() {
    google.maps.event.trigger(u.map.mapa, "resize")
}

function compararHora(hora1, hora2) {
    hora1 = hora1.split(":");
    hora2 = hora2.split(":");
    var d = new Date();
    var data1 = new Date(d.getFullYear(), d.getMonth(), d.getDate(), hora1[0], hora1[1]);
    var data2 = new Date(d.getFullYear(), d.getMonth(), d.getDate(), hora2[0], hora2[1]);
    return data1 > data2
}

function getDetalhes(id, view, where) {
    var id = id;
    var data = getModelo("I.lanchonete");
    $('#_dlContent').html(data);
    view = (view !== null) ? v = view : v = 0;
    ok = false;
    replaceSVG();
    marks.reduce(function(lv, ob) {
        if (ob[0] == id) {
            u.map.mapa.setZoom(19);
            u.map.mapa.panTo({ lat: parseFloat(ob[1]), lng: parseFloat(ob[2]) });
            setTimeout(function() {
                $('.detalhe-lanchonete').modal('show');
            }, 1100);

            $.ajax({
                url: "includes/v1/getLanchonetes.php",
                type: 'POST',
                data: { v: v, id: id },
                success: function(data) {
                    const l = data.lanchonete;
                    formataLanchoneteDetalhado('#_dlContent', l);
                    const el = $('#_dlContent').find(".load-lanches");
                    const prev = $('#_dlContent').find(".previu");
                    el.html("");
                    if (l.view == 2) {
                        $(".returnMenu").removeClass('hide').data("return", l.id);
                        $(".whereToReturn").val(where)
                    } else {
                    }

                    if (l.nc > 3) {
                        $("._maisComentarios").data('param', l.foo).data('nc', l.nc);
                        $(".seeMore").show();
                    }

                    $.ajax({
                        url: "includes/v1/getLanches.php",
                        data: { foo: l.foo },
                        success: function(data) {
                            let i = 0;
                            while (i < data.lanches.length) {
                                ob = data.lanches[i];
                                if (i < 3) {

                                    prev.append("<div class='l col-xs-12'style='padding:10px;'>" +
                                        "<span class='col-xs-12' >" +
                                        "<div class='lanche'><b>" + ob.titulo + "</b></div>" +
                                        "<div class='text-right'><b class='preco'> R$ " + ob.preco + "</b></div>" +
                                        "</span>" + "<span class='col-xs-12' style='margin-top: -10px;'>" + "<span class='ingredientes'> " + ob.ingredientes + "</span>" + "</span>" + "</div>");
                                }
                                el.append("<div class='l col-xs-12'style='padding:10px;'>" +
                                    "<span class='col-xs-12' >" +
                                    "<div class='lanche'><b>" + ob.titulo + "</b></div>" +
                                    "<div class='text-right'><b class='preco'> R$ " + ob.preco + "</b></div>" +
                                    "</span>" + "<span class='col-xs-12'><p class='noM' style='color:black'>Ingredientes:</p>" +
                                    "<span class='ingredientes'> " + ob.ingredientes + "</span>" + "</span>" + "</div>");
                                i++
                            }
                        }
                    });
                    if (l.ft) {
                        $(".comentar-box").show();
                    }
                    if (l.informativo) {
                        $(".cinfo").show();
                        $(".load-informativo").html(l.informativo);
                    }
                    $.ajax({
                        url: "includes/v1/getComentarios.php",
                        data: { foo: l.foo, action: 3 },
                        success: function(data) {

                            limit = 3;
                            let i = 0;

                            if (i < data.comentarios.length) {
                                $(".load-comentarios").html(null);
                            }
                            while (i < data.comentarios.length) {
                                ob = data.comentarios[i];

                                $(".load-comentarios").append(
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
                        }
                    })
                    $.ajax({
                        url: "includes/v1/getProximas.php",
                        data: { foo: l.foo },
                        success: function(data) {
                            const prot = getModelo("I.proximas");
                            formataProximas(prot, data.lanchonetes, ".myProximas", l.view)
                        }
                    })
                }
            })

        }
    }, "");

}

function formataProximas(element, objs, _where, view, classe) {
    let where = $(_where);
    where.html("");
    let i = 0;
    while (i < objs.length) {
        let e = $(element);
        let ha = objs[i].horaAbre.split(":");
        let hf = objs[i].horaFecha.split(":");
        e.addClass(classe + "__" + objs[i].id);
        e.find(".whereback").val(classe + "__" + objs[i].id);
        e.find(".load-img").attr("src", "assets/$_imgs/l/" + tipo_vigente + ".svg");
        e.find(".load-titulo").html(objs[i].titulo);
        e.find(".load-subTitulo").html(objs[i].subTitulo);
        e.find(".load-bairro").html(objs[i].bairro);
        e.find(".load-hAbre").html("ABRE: <b>" + ha[0] + ":" + ha[1] + "</b>");
        e.find(".load-hFecha").html("FECHA: <b>" + hf[0] + ":" + hf[1] + "</b>");
        e.find(".load-hasSee").html(objs[i].hasSee);
        if (parseInt(objs[i].aceita_cartao) === 1) {
            e.find(".prev-cartao").removeClass("none");
        }
        if (parseInt(objs[i].entrega) === 1) {
            e.find(".prev-entrega").removeClass("none");
        }
        if (!objs[i].isOpen) {
            e.addClass("fechado");
            e.find(".isClose").removeClass("none");
        }
        if (canRoute) {
            let me = u.getLoc();
            let dis = distance(me.lat, me.lng, objs[i].lat, objs[i].lng, "K");
            dis = Math.round(dis);
            let str;
            if (dis === 0) {
                str = ", < 1 Km";
            } else {
                str = ", ~ " + dis + " Km"
            }
            e.find(".prev-distancia").html(str);
        }
        e.find(".myId").val(objs[i].id);
        e.find(".from").val(view);
        where.append(e[0]);
        i++
    }
}

function formataLanchoneteDetalhado(element, obj) {

    $(element).find(".load-img").attr("src", "assets/$_imgs/l/" + tipo_vigente + ".svg");
    $(element).find(".load-titulo").html(obj.titulo);
    $(element).find(".load-subTitulo").html(obj.subTitulo);
    $(element).find(".load-hAbre").html(obj.horaAbre);
    $(element).find(".load-hFecha").html(obj.horaFecha);


    $(element).find(".load-bairro").html(obj.bairro + ", <small>Macapá</small>");
    $(element).find(".load-hasSee").html(obj.hasSee);
    $(element).find(".load-avaliacao").html("Em breve");

    if (parseInt(obj.aceita_cartao) === 1) {
        $(element).find(".load-cartao").html(" Aceita Cartão")
    } else {
        $(element).find(".load-cartao").html("Não Aceita Cartão");
        $(element).find(".load-cc").attr("src", "assets/$_imgs/controls/credit-card-off.svg")
    }

    (obj.telefone) ? $(element).find(".load-celular").html("<b>" + obj.telefone + "</b>"): $(element).find(".load-celular").html("<b>não tem telefone</b>");

    if (obj.isOpen == 0) {
        $(element).find(".load-img").addClass("noColorImage")
        $(element).find(".load-horas").addClass("noop");
    }
    if (obj.entrega == 1) {
        $(element).find(".load-entrega").html("Faz Entrega")
    } else {
        $(element).find(".load-entrega").html("Não Faz Entrega")
        $(element).find(".load-dy").attr("src", "assets/$_imgs/controls/motorcycle-off.svg")
    }
    str = "";

    str += "<div class='seeCardapio col-xs-4 text-center avisos min-pd' style='border-right: 2px solid #304152;'>" +
        "<img src='assets/$_imgs/controls/menu.svg' width='80%'>" +
        "<p class='down-icon text-center'><b>CARDÁPIO</b></p></div>";
    $(element).find("#tks").val(obj.ft);
    var width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
    if (width < 900 && obj.telefone.length === 15) {
        str += "<div class='col-xs-4 text-center avisos min-pd' style='border-right: 2px solid #304152;'><a data-param='" + obj.id + "'" + " href='tel:" + obj.telefone +
            "' style='width:100% !important;'>" +
            "<img src='assets/$_imgs/controls/phone-call.svg'  width='80%'>" +
            "<p class='down-icon text-center'><b style='color:#b0ae94'>LIGAR</b></p></a></div>"
    }
    if (canRoute) {
        str += "<div class='col-xs-4 text-center avisos min-pd' data-param='" +
            +obj.id + "' data-param2='0' id='levaOcara'>" +
            "<img src='assets/$_imgs/controls/road.svg'  width='80%'>" +
            "<p class='down-icon text-center'><b>CAMINHO</b></p></div>";
    } else {
        str += "<div class='col-xs-4 text-center avisos'></div>";
    }

    $(element).find(".load-btns").html(str)
}

function atualizaLanchonetes() {
    initMap()
}

function getValidaLanchonete(id) {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;
            $.ajax({
                url: "includes/estrutura/formularios/validaLanchonete.php",
                type: 'POST',
                data: { id: id, lat: lat, lng: lng },
                success: function(data) {
                    $("#_nlContent").html(data);
                    $(".nova-lanchonete").modal('show')
                }
            })
        })
    }
}

function getComentarios(data) {
    $.ajax({
        url: "includes/aplication/atualizaComentario.php",
        type: 'POST',
        data: { data: data },
        success: function(data) {
            let i = 0;
            if (i < data.comentarios.length) {
                $(".load-comentarios").html(null);
                $(".loaded-comentarios").html(null);
            }

            while (i < data.comentarios.length) {
                ob = data.comentarios[i];
                $(".load-comentarios").append(
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
            $(".seeMore").removeClass("none")


        }
    })
}
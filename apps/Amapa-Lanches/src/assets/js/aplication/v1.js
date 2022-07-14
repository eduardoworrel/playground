var tipo_vigente;
var firstAll;
var all;
var userOn = false;

function initMap() {
    $(".e4").html("ok");
    $(".e4,.x4").show();
    u = new user(google, new map(google));
    $("#fundo,#curtina").css("background", "#e5e3df");
    $.ajax({
        url: "includes/estrutura/prototipos/interface_lanchonete.html",
        type: 'POST',
        data: {
            param: 1
        },
        success: function(data) {
            putModelo("I.lanchonete", data)
        }
    });


    $.ajax({
        url: "includes/estrutura/modais.html",
        data: {
            param: 1
        },
        success: function(data) {

            $("body").prepend(data);
            $.ajax({
                url: "includes/v1/filter/getFilters.php",
                data: {
                    param: 1
                },
                success: function(data) {
                    $(".tipos_filter").append(data);
                }
            });

        }
    });
    $.ajax({
        url: "includes/componentes/footer.html",
        data: {
            param: 1
        },
        success: function(data) {
            $("body").append(data);
        }
    });
    $(".e5").html("ok");
    $(".e6,.x6").show();
    $.ajax({
        url: "includes/estrutura/prototipos/lanchonetes_proximas.html",
        type: 'POST',
        data: {
            param: 1,
            lat: u.lat,
            lng: u.lng
        },
        success: function(data) {
            putModelo("I.proximas", data);
            $.ajax({
                url: "includes/v1/getTodas.php",
                success: function(data) {
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

                            }
                        }
                    });

                    tipo_vigente = 1;
                    var prototipo = getModelo("I.proximas");

                    setPorBairros(groupByArray(data.todas, 'bairro'), prototipo);
                    setPorCartao(groupByArray(data.todas, 'aceita_cartao'), prototipo);
                    setPorEntrega(groupByArray(data.todas, 'entrega'), prototipo);
                    formataProximas(prototipo, data.todas, ".sugestoes", 2, "all");

                    u.map.centerView(u.lat, u.lng);
                    $("#map").show();
                    u.map.setTodas(data.todas);
                    all = data.todas;
                    firstAll = data.todas;


                    $(".botoes,.bt-menu,.bt-sol").fadeIn('slow');
                    $("#fundo").fadeOut("slow");
                    $("#curtina").fadeOut("slow");
                    resize();
                    setStyleMap(u);

                    setTimeout(function() {
                        myLocation();
                    }, 900);
                    setTimeout(function() {
                        if (window.location.href.indexOf("start") > 0) {
                            $("#menu").modal("show");
                        } else {
                            $(".lanchonetes").modal("show");
                        }
                    }, 1600);

                    $.getScript("https://amapalanches.com/assets/js/jquery.mask.js", function(dt) {
                        $(document).on("focus", "._tel", function() {
                            $(this).unmask();
                            $(this).mask('(99) 99999-9999')
                        });
                        $(document).on("focus", "._data", function() {
                            $(this).unmask();
                            $(this).mask('99/99/9999')
                        });
                    });



                }
            })
        }
    });
}

function setPorCartao(gg, prototipo) {
    gg.reduce(function(lv, ob) {
        if (ob.key == 1)
            formataProximas(prototipo, ob.values, "#returnedCartao", 2, "cartao");
    }, "");
}

function setPorEntrega(gg, prototipo) {
    gg.reduce(function(lv, ob) {
        if (ob.key == 1)
            formataProximas(prototipo, ob.values, "#returnedDelivery", 2, "entrega");
    }, "");
}

function setPorBairros(gg, prototipo) {
    $("#returnedBairros").html(null);
    gg.reduce(function(lv, ob) {
        if (ob.key !== null) {
            $("#returnedBairros").append("<div id='bb' data-param='" + ob.key.replace(/ /g, '') +
                "' class='cc per1 bar-" + ob.key.replace(/ /g, '') + "'>" +
                "<img src='assets/$_imgs/controls/colosseum.svg' width='20%' style='margin-rigth:45px'>" +
                ob.key + "</span></div>");
            $("#returnedBairros").append("<div class='cont-" + ob.key.replace(/ /g, '') + " none'></div>");
        }
    }, "");


    gg.reduce(function(lv, ob) {
        formataProximas(prototipo, ob.values, ".cont-" + ob.key.replace(/ /g, ''), 2, "bairro");
    }, "");

}
const start = function() {
    $.getScript("assets/js/bootstrap.min.js", function() {
        $.getScript("assets/js/aplication/ini.js", function() {
            $.getScript("assets/js/aplication/funcoes.js", function() {
                $.getScript("assets/js/aplication/config.js", function() {
                    $.getScript("assets/js/aplication/mapa.js", function() {

                        const scriptPromise = new Promise((resolve, reject) => {
                            script = document.createElement('script');
                            document.body.appendChild(script);
                            script.onload = resolve;
                            script.onerror = reject;
                            script.async = !0;
                            script.src = 'https://unpkg.com/notie';
                            a = document.createElement("link");
                            a.type = "text/css";
                            a.href = "assets/style/custom-bs.css";
                            a.rel = "stylesheet";
                            $("head").append(a);
                            a = document.createElement("link");
                            a.type = "text/css";
                            a.href = "https://unpkg.com/notie/dist/notie.min.css";
                            a.rel = "stylesheet";
                            $("head").append(a);
                            a = document.createElement("link");
                            a.type = "text/css";
                            a.href = "assets/style/estilo.css";
                            a.rel = "stylesheet";
                            $("head").append(a);
                            a = document.createElement("link");
                            a.type = "text/css";
                            a.href = "https://fonts.googleapis.com/css?family=Roboto";
                            a.rel = "stylesheet";
                            $("head").append(a);
                        });
                        scriptPromise.then(() => {
                            filtraFuncaoParaHtml(getArray());
                            a = document.createElement("script");
                            a.type = "text/javascript";
                            a.src = "https://maps.google.com/maps/api/js?v=3&key=[]&callback=initMap";
                            $(".e2").html("ok");
                            $(".e3,.x3").show();
                            setTimeout(function() {
                                $("head").append(a)
                            }, i = i + 200);
                        })
                    });
                });
            });
        });
    });
}()

function replaceSVG() {

    jQuery('img.svg').each(function() {
        var $img = jQuery(this);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');

        jQuery.get(imgURL, function(data) {
            var $svg = jQuery(data).find('svg');

            if (typeof imgID !== 'undefined') {
                $svg = $svg.attr('id', imgID);
            }

            if (typeof imgClass !== 'undefined') {
                $svg = $svg.attr('class', imgClass + ' replaced-svg');
            }

            $svg = $svg.removeAttr('xmlns:a');

            $img.replaceWith($svg);

        }, 'xml');

    });
}
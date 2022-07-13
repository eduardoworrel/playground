<script src='https://www.google.com/recaptcha/api.js'></script>
<?php
include_once '../../input_filter.php';
include_once '../../modelo/conexao.php';
include_once '../../classes/lanchonete.php';
$lat = post('lat');
$lng = post('lng');
$c = new conexao();
$int = $c->getObject([$lat, $lng], 'temLanchonete');
?>

<div class="content">
    <div class="row">

        <b style="color:#625521">Sugerir Lanchonete</b>
        <div class="form-group text-center">
            <div id="myPlace">

            </div>
            <div class="col-lg-12">
                <div class="alert alert-info">
                    <p class="">
                        Você pode nos ajudar a conhecer mais lanchonetes
                    </p>
                    <p>Basta confirmar que não é um robo e apertar em <b>enviar</b></p>
                </div>
            </div>
            <?php
            if ($int > 0) {
                ?>
                <div class="col-lg-12">
                    <div class="alert alert-warning">
                        <p class="">
                            Já existem <?=$int?> Lanchonetes cadastradas aqui
                        </p>
                        <p>Se houver mais que isso não tem problema :)</p>
                    </div>
                </div>  
                <?php
            }
            ?>
            <div class="col-lg-7">
                <div class="g-recaptcha"  
                     data-sitekey="6LcZDyAUAAAAAEaa6VgSHcXbWTP14hG5v2Ar4AMO"></div>
            </div>
            <script>
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function (position) {
                        $.ajax({
                            url: "includes/aplication/recebeLanchonete.php",
                            type: 'POST',
                            data:
                                    {
                                        param: 1,
                                        lat: position.coords.latitude,
                                        lng: position.coords.longitude
                                    }
                            
                        });

                        var str = "<div class='col-lg-6'><pre>Latitude: " + position.coords.latitude + "</pre></div>" +
                                "<div  class='col-lg-6'><pre> Logintude: " + position.coords.longitude + "</pre></div>";
                        $("#myPlace").html(str);

                    });
                } else {
                    $("#myPlace").html("Infelizmente seu dispositivo não está com GPS ligado ou não possui ;/");

                }
            </script>


        </div>

        <div class="col-lg-5">
            <a class="btn btn-block btn-lg btn-success" id="_sl">Enviar</a>
        </div>


    </div>
</div>
            <?php

<?php
include_once './includes/modelo/conexao.php';
$c = new conexao();
$instancia = $c->getconexao();

$id = $array[0];
$pst = $instancia->prepare("SELECT ID_LANCHONETE,LONGITUDE,LATITUDE from lanchonetes LIMIT 1");
$pst->execute();
$array = $pst->fetch();
?>

<script>
    fetch("http://maps.googleapis.com/maps/api/geocode/json?latlng=<?= $array['LATITUDE'] ?>,<?= $array['LONGITUDE'] ?>")
            .then(function (dt) {
                return dt.json();
            }).
            then(function (json) {
                console.log(json.results[0].address_components[2].long_name);
                fetch("https://amapalanches.com/includes/updateBairro.php?b="
                        + json.results[0].address_components[2].long_name +
                        "&i=<?= $array["ID_LANCHONETE"] ?>").then((dt) => {
                    console.log(dt);
                });
            });
</script>

<?php

function getSigno($dia, $mes) {
    $signo = "nenhum";
    if ($mes == "03") {
        if ($dia >= "21") {
            $signo = "Áries";
        } else {
            $signo = "Peixes";
        }
    }if ($mes == "04") {
        if ($dia >= "21") {
            $signo = "Touro";
        } else {
            $signo = "Áries";
        }
    }if ($mes == "05") {
        if ($dia >= "21") {
            $signo = "Gêmeos";
        } else {
            $signo = "Touro";
        }
    }if ($mes == "06") {
        if ($dia >= "21") {
            $signo = "Câncer";
        } else {
            $signo = "Gêmeos";
        }
    }if ($mes == "07") {
        if ($dia >= "22") {
            $signo = "Leão";
        } else {
            $signo = "Câncer";
        }
    }if ($mes == "08") {
        if ($dia >= 23) {
            $signo = "Virgem";
        } else {
            $signo = "Leão";
        }
    }if ($mes == "09") {
        if ($dia >= "23") {
            $signo = "Libra";
        } else {
            $signo = "Virgem";
        }
    }if ($mes == "10") {
        if ($dia >= "23") {
            $signo = "Escorpião";
        } else {
            $signo = "Libra";
        }
    }if ($mes == "11") {
        if ($dia >= "22") {
            $signo = "Sagitário";
        } else {
            $signo = "Escorpião";
        }
    }if ($mes == "12") {
        if ($dia >= "22") {
            $signo = "Capricórnio";
        } else {
            $signo = "Sagitário";
        }
    }if ($mes == "01") {
        if ($dia >= "21") {
            $signo = "Aquário";
        } else {
            $signo = "Capricórnio";
        }
    }if ($mes == "02") {
        if ($dia >= "20") {
            $signo = "Peixes";
        } else {
            $signo = "Aquário";
        }
    }
    return $signo;
}

<?php

function time_elapsed_string($datetime, $full = false, $idade = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'ano',
        'm' => 'mes',
        'w' => 'semana',
        'd' => 'dia',
        'h' => 'hora',
        'i' => 'minuto',
        's' => 'segundo',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 && $v == 'm' ?
                    'es' : $diff->$k > 1 && $v != 'm' ?
                    's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full)
        $string = array_slice($string, 0, 1);

    if ($idade) {

        return implode(', ', $string);
    } else {
        return $string ? implode(', ', $string) . ' atrás' : 'Agora';
    }
}

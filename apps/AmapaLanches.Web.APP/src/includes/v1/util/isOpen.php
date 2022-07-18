<?php

/**
 * I setup the hours for each day if they carry-over)
 * everyday is open from 09:00 AM - 12:00 AM
 * Sun/Sat open extra from 12:00 AM - 01:00 AM
 */
function isOpen($horaAbre, $horaFecha) {
    $storeSchedule = [
        'Sun' => [$horaAbre => $horaFecha],
        'Mon' => [$horaAbre => $horaFecha],
        'Tue' => [$horaAbre => $horaFecha],
        'Wed' => [$horaAbre => $horaFecha],
        'Thu' => [$horaAbre => $horaFecha],
        'Fri' => [$horaAbre => $horaFecha],
        'Sat' => [$horaAbre => $horaFecha]
    ];
    $timestamp = time();

// default status
    $status = 0;

// get current time object
    $currentTime = (new DateTime())->setTimestamp($timestamp);

// loop through time ranges for current day
    foreach ($storeSchedule[date('D', $timestamp)] as $startTime => $endTime) {

// create time objects from start/end times
        $now = date('H:i', $timestamp);
        $nowHour = explode(":", $now)[0];
        //horario de verão// -- não existe mais
        // $nowHour = $nowHour - 1;
       
        $nowMin = explode(":", $now)[1];
        $openHour = explode(":", $startTime)[0];
        $openMin = explode(":", $startTime)[1] ?? 0;
        $closeHour = explode(":", $endTime)[0];
        $closeMin = explode(":", $endTime)[1] ?? 0;
        // check if current time is within a range


        if ($nowHour >= 12) {
            // esta de noite até as 23h59
            if ($closeHour <= 12) {
//                fecha depois das  23h59
                if ($openHour < $nowHour || ($openHour == $nowHour && $openMin <= $nowMin )) {
//                    se horario maior que atual então aberto
                    $status = 1;
                    break;
                }
            } else {
//                fecha antes das  23h59

                if (
                        ($openHour < $nowHour || ($openHour == $nowHour && $openMin <= $nowMin )) && ($closeHour > $nowHour || $closeHour == $nowHour && $closeMin >= $nowMin )) {
                    $status = 1;
                    break;
                }
            }
        } else {
            // dia das 00 as 11h59    
            if ($closeHour <= 12) {
//                fecha depois das  23h59
                if ($closeHour > $nowHour || $closeHour == $nowHour && $closeMin >= $nowMin) {
                    $status = 1;
                    break;
                }
            }
        }
    }
    return $status;
}

//include 'util/isOpen.php';

//$c = new conexao();
//$lanchonetes = lanchonete::todas($c->getconexao());
//$_ = array();
//if (is_array($lanchonetes)) {
//
//    foreach ($lanchonetes as $lanchonete) {
////        $avaliacao = $c->getObject([$lanchonete->id], 'getAvaliation');
////        $hs = lanchonete::visto($lanchonete->id, $c->getconexao());
////        if ($lanchonete->id == 42) {
//        $isOpen = isOpen(substr($lanchonete->horaAbre, 0, -3), substr($lanchonete->horaFecha, 0, -3));
//        var_dump($isOpen);
////        break;
////        }
//    }
//}


    
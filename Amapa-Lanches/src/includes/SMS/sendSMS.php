<?php

function sendSMS($numero, $sms) {
    $url = 'https://www.paposms.com/webservice/1.0/send/';

    $fields = array(
        "user" => '[]',
        "pass" => '[]',
        "numbers" => $numero,
        "message" => $sms,
        "return_format" => "json"
    );

    $postvars = http_build_query($fields);

    $result = file_get_contents($url . "?" . $postvars);

    $result_array = json_decode($result, true);

    if ($result_array['result'] === true) {
        echo "Mensagem enviada.";
    } else {
        echo "Mensagem não enviada";
    }
}

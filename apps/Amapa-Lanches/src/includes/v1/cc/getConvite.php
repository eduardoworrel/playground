<?php

session_start();
include_once '../../input_filter.php';
$param = get("value");
if ($param == "scooby") {
    print(1);
} else {
    print(0);
}



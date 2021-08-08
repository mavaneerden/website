<?php

$file = "$_SERVER[DOCUMENT_ROOT]/data/flags.json";
$lines = file($file);
$random = rand(1, count($lines) - 2);
$data = explode(":", trim($lines[$random], " \n\r\t\v\0,"));

$code = $data[0];
$names = trim($data[1], " ");

echo "{ \"code\": ".$code.", \"names\": ".$names." }";
?>
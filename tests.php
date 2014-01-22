<?php

//http://www.dewep.net/Blog/Article-9/Utiliser-cURL-PHP
//http://www.seoblackout.com/2008/02/13/soumission-automatique-formulaire/

$response_format="txt";
$link="http://uptobox.com/iamarbe9ne36";
$url = 'http://urlchecker.net/api.php';
$ch = curl_init($url);

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, "response_format=$response_format&link=$link");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_NOBODY, 0);

$response = curl_exec($ch);
echo $response;


?>
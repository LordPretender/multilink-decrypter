<?php

//http://stackoverflow.com/questions/4245416/code-igniter-send-url-as-param

//Récupération du lien à décrypter
$url = isset($_GET['url']) ? ($_GET['url']) : "";

//On encode
$encoded = base64_encode($url);

//Puis on redirige vers l'accueil
header("location: /accueil/memoriser/$encoded.html");

?>
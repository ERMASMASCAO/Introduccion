<?php

$idiomaServ=substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2);

if ($idiomaServ=="es") {
    echo("Idioma en Español");
}elseif ($idiomaServ=="en") {
    echo("Language in English");
}


?>
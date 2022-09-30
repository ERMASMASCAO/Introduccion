<?php
$navegador = $_SERVER["HTTP_USER_AGENT"];

if(strpos($navegador,"Firefox") !== false)
    echo("Bienvenido");
else {
    echo("Esto no es Firefox");
}
?>
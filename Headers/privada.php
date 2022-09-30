<?php

$acceso=$_GET["dejameEntrar"] ?? "0";

if ($acceso == "1") {
    echo "Bienvenido a la pagina";
}
elseif ($acceso == "0") {
    header('Location: login.php');
    exit;
}

?>
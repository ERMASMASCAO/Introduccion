<?php


    $language = "";

    //Crea aquí tu script para seleccionar el idioma

    $language = $_GET["setLanguage"] ?? $_COOKIE["language"] ?? "es";
    setcookie("language",$language, time() + 30 * 24 * 60 * 60 );
    
    //Fin script

    if ($language == "en"){

        $content = "This page is in English";

        $title = "Change the language of the page";

    }else{

        $content = "Esta página está en Castellano (Idioma por defecto)";

        $title = "Cambiar el idioma de la página";

    }

?>

<!doctype html>

<html lang="es">

<head>

    <meta charset="utf-8">

    <title><?= $title ?></title>

    <meta name="author" content="Daniel Prieto">

</head>    

<body>

    <ul><?= $title ?>

        <li><a href='Idioma-Cookie.php?setLanguage=es'>Español</a></li>

        <li><a href='Idioma-Cookie.php?setLanguage=en'>Inglés</a></li>

    </ul>

    <?= $content ?>

</body>

</html>
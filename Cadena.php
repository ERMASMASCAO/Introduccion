<?php
/*
Lo que hace es crear una variable nombre y decir si hay algun nombre ya 
existente si no lo hay predeterminadamente aparecerá Víctor.
*/
$nombre = $_GET['nombre'] ?? 'Víctor';
$prefijo = $_GET['prefijo'] ?? '';

/*
Todos estos ejemplos están en funciones de cadenas en el Aules.
*/
echo $nombre;
echo "<br>";

echo trim($nombre, '/');
echo "<br>";

echo strlen($nombre);
echo "<br>";

echo strtoupper($nombre);
echo "<br>";

echo strtolower($nombre);
echo "<br>";

echo strpos($nombre, $prefijo);
echo "<br>";

strtoupper($nombre);
echo substr_count(strtoupper($nombre), 'A');
echo "<br>";

echo stripos($nombre,'a');
echo "<br>";

echo str_ireplace('o','0',$nombre);
echo "<br>";

$url = 'http://username:password@hostname:9090/path?arg=value';
echo parse_url($url,PHP_URL_SCHEME);
echo "<br>";

echo parse_url($url,PHP_URL_USER);
echo "<br>";

echo parse_url($url,PHP_URL_PATH);
echo "<br>";

echo parse_url($url,PHP_URL_QUERY);
?>


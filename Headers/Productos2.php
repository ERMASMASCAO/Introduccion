<?php

header('Content-type: text/csv');
header('Content-Disposition: attachment; fielname:"productos1.csv"');

$productos = ["1" => "Producto 1", "2" => "Producto 2", "3" => "Producto 3"];
foreach ($productos as $key => $value) {
    echo "$key; $value\n";
}
?>
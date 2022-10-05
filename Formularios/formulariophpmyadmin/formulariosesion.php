<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $opciones = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_PERSISTENT => true
    );

    $pdo = new PDO(
        'mysql:host=localhost;dbname=proyecto1;charset=utf8',
        'root',
        'sa',
    $opciones);

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $registros = $pdo->exec("INSERT INTO users(username,email,password) VALUES('$username','$email','$password')");

    echo "<p>Se ha registrado correctamene.</p>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
    <title>formulariosesionpHPMYADMIN</title>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
    Nombre de usuari@ 
        <input type="text" name="username"><br>

    Correo electónico 
        <input type="correo" name="email"><br>

    Contraseña
        <input type="contraseña" name="password"><br>

    Confirmar contraseña
        <input type="confirmarContraseña" name="confirmarContraseña"><br>
    
        <input type="submit" value="Registrarse" name="enviar"><br>

    ¿Ya eres miembro? Acceso Usuari@s<br>

</body>
</html>
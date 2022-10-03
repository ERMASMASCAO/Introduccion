<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login código</title>
</head>
<body>
    <?php

    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $opciones = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_PERSISTENT => true
        );
        $username = $_POST["nombre"];
        $password = $_POST["password"];

        $pdo = new PDO(
            'mysql:host=localhost;dbname=proyecto1;charset=utf8',
            'root',
            'sa',
        $opciones);

        $username = $_POST['username'] ?? "";
        $password = $_POST['password'] ?? "";
        $sql = "SELECT * FROM users where username = '$username' and password = '$password'";

        $resultado = $pdo -> query($sql);
        if ($registro = $resultado->fetch()){
            $_SESSION['username'] = $registro["username"];

        }
    }
    ?>

    <form method="POST">
    Nombre de usuari@ 
        <input type= "text" name= "nombre"><br>
    Contraseña
        <input type= "password" name= "password"><br>
        <input type= "submit" value="Acceder" name= "Enviar"></br>
    ¿Ya eres miembro? Acceso Usuari@s<br>
    </form>

</body>
</html>
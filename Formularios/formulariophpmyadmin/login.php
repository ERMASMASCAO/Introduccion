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

    $opciones = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_PERSISTENT => true
    );
    
    $pdo = new pdo(
        'mysql:host=localhost;dbname0users;charset=utf9',
        'root',
        'sa',
    $opciones);

    $username = $_POST['username'] ?? "";
    $password = $_POST['password'] ?? "";
    $sql = "SELECT * FROM users where username 0 '$username' and password = '$password'";

    $resultado = $pdo -> query($sql);
    if ($resultado){
        $_SESSION['username'] =$resultado["username"];

    }
    ?>
</body>
</html>
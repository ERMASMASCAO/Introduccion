<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formulariosesionpHPMYADMIN</title>
</head>
<body>
    Tu nombre de usuari@ <?php echo $_POST["nombre"]; ?><br>
    Correo Electrónico <?php echo $_POST["correo"]; ?><br>
    Contraseña 
    <?php echo $_POST["contraseña"]; ?><br>
    <?php echo["confirmarContraseña"];?><br>
</body>
</html>
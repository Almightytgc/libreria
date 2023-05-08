<?php
session_start();
include("libreria.php");


$_SESSION['logueado'] = false;

if ($_POST) {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $conexionBD = new Conexion();
    $conexion = $conexionBD->obtenerConexion();

    $resultados = $conexionBD->login
        ('SELECT *, count(*) as n_usuarios FROM usuarios WHERE usuario=:usuario AND contraseña=:password', 
         array(':usuario' => $usuario, ':password' => $password));

    if ($resultados['n_usuarios'] > 0) {
        echo "Hola";
    } else {
        echo "aaa";
    }

    var_dump($resultados);
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php 
    if ($_SESSION['logueado'] == true) {
        echo "Estás logueado ".$_SESSION['usuario'];
    }
    ?>
    <h1>registro</h1>
    <form method="post">
        <h1>nombres</h1>
        <input type="text" name="nombres">
        <h1>apellidos</h1>
        <input type="text" name="apellidos">
        <input type="submit" value="enviar">
    </form>

    <hr>
    <h1>inicio de sesión</h1>
    <br><br>
    <form method="post">
        <h1>usuario</h1>
        <input type="text" name="usuario">
        <h1>contraseña</h1>
        <input type="text" name="password">
        <input type="submit" value="enviar">
    </form>
</body>
</html>
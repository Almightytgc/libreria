<?php
session_start();
include("libreria.php");


$_SESSION['logueado'] = false;


//REGISTRO
// if ($_POST) {
//     $usuario = $_POST['usuario'];
//     $password = $_POST['password'];

//     $conexionBD = new Conexion();
//     $conexion = $conexionBD->obtenerConexion();

//     $resultados = $conexionBD->ejecutarConsulta
//         ('insert into usuarios (id_usuario, usuario, contraseña) values (NULL, :usuario, :password)', 
//          array(':usuario' => $usuario, ':password' => $password));
        
// }


//LOGIN
if ($_POST) {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $conexionBD = new Conexion();
    $conexion = $conexionBD->obtenerConexion();

    $resultados = $conexionBD->login
        ('SELECT *, count(*) as n_usuarios FROM usuarios WHERE usuario=:usuario AND contraseña=:password', 
         array(':usuario' => $usuario, ':password' => $password));

         if (intval($resultados['n_usuarios']) > 0) {
            echo "<hr> <center><h2>Hola, iniciaste sesión</h2></center> <hr>";
        } else {
            echo "error";
        }
        

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
    <h1>registro (descomentarear)</h1>
    <hr>
    <!-- <form method="post">
        <h1>nombres</h1>
        <input type="text" name="usuario">
        <h1>apellidos</h1>
        <input type="text" name="password">
        <input type="submit" value="enviar">
    </form> -->

    <hr>
    <h1>inicio de sesión (descomentarear)</h1>


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
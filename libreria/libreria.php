<?php

//conexión utilizando programación orientada a objetos
class conexion {
    //propiedades de la clase
    private $servidor = "localhost";
    private $usuario = "root";
    private $contrasenia = "";
    private $conexion="";

    //función constructora de la conexión a la base de datos
    public function __construct() {
        try {
            $this->conexion = new PDO("mysql:host=$this->servidor; dbname=prueba", $this->usuario,$this->contrasenia);
            $this->conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Con setAttribute(), establecemos el valor de un atributo en la conexión PDO. PDO::ATTR_ERRMODE es 
            // el nombre del atributo que queremos establecer y PDO::ERRMODE_EXCEPTION es el 
            // valor que queremos asignarle. en este caso buscamos establecer un atrbituto de error

        } catch(PDOException $e) { 
            throw new Exception("Falla de conexión. ".$e->getMessage());
        }
            
    }

        // método público para acceder a la propiedad privada $conexion
        public function obtenerConexion() {
            return $this->conexion;
        }

    //función para ejecutar la sentencia sql
    public function ejecutar($sql) {
        $this-> conexion -> exec($sql);
        return $this-> conexion -> lastInsertId();
    }

}



//inicio de sesión 
if ($_POST) {

    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    //instanciamos un nuevo objeto de la clase conexión
    $objetoConexion = new conexion();

    //obtenemos el objeto PDO usando el método obtenerConexion()
    $conexion = $objetoConexion->obtenerConexion();


    //escribimos nuestra sentencia sql (los values siempre van entre comillas simples a menos que sean números)
    $sql = "SELECT * ,count(*) as n_usuarios 
    FROM usuario WHERE usuario=:usuario AND contraseña=:password";
    //hacemos que nuestro objeto acceda al método ejecutar que tiene como parámetro a la sentencia sql 
    $stmt = $conexion->prepare($sql);

    $stmt->bindParam(":usuario", $usuario);
    $stmt->bindParam(":password", $password);
    $stmt->execute();

    $registro = $stmt->fetch(PDO::FETCH_LAZY);

    if ($registro['n_usuarios'] > 0) {
        $_SESSION['usuario'] = $registro['usuario'];
        $_SESSION['logueado'] = true;

        // Guardar el ID del usuario en una variable de sesión

        $id_usuario = $registro['id_usuario'];
        $_SESSION['id_usuario'] = $id_usuario;
    } else {
        echo "datos incorrectos manito";
    }


    // $registro = $stmt->fetch(PDO::FETCH_LAZY);
  
    // //esta condición, verifica que si se encontraron resultados en la sentencia sql
    // //vamos a crear las variables de sesión y redireccionamos, sino, tiramos un alert en el formulario
    // if ($registro['n_usuarios'] > 0) {
    //     $_SESSION['usuario'] = $registro['usuario'];
    //     $_SESSION['logueado'] = true;
    //     // Guardar el ID del usuario en una variable de sesión
    //     $id_usuario = $registro['id'];
    //     $_SESSION['id'] = $id_usuario; 
         
  
    //     header("location: index.php");
  
    // }
  }








// //recepción de archivos por medio del método post
// if ($_POST) {
//     //declaramos las variables
//     $nombres = $_POST['nombres'];
//     $apellidos = $_POST['apellidos'];

//     //instanciamos un nuevo objeto de la clase conexión
//     $objetoConexion = new conexion();

//     //obtenemos el objeto PDO usando el método obtenerConexion()
//     $conexion = $objetoConexion->obtenerConexion();

//     //escribimos nuestra sentencia sql con marcadores de posición
//     $sql = "INSERT INTO usuario(id_usuario, nombres, apellidos) VALUES (NULL, :nombres, :apellidos)";

//     //preparamos la consulta declarando una nueva variable que usa la función prepare que lleva 
//     //como parámetro a $sql
//     $stmt = $conexion->prepare($sql);

//     //asignamos valores a los marcadores de posición
//     $stmt->bindParam(':nombres', $nombres);
//     $stmt->bindParam(':apellidos', $apellidos);

//     //ejecutamos la consulta preparada
//     $stmt->execute();
// }






// //recepcion de fotos
// if ($_POST) {
//     //obtenemos la fecha
//     $fecha = new dateTime();

//     //Necesitamos la recepción de nombre de imagen y 
//     //usamos la funcion getTimestamp parsa obtener la hora a la que se sube para que 
//     //se distinga de las otras yluego concatenamos el _ con el nombre de la imagen
//     $imagen = $fecha->getTimestamp()."_".$_FILES['archivo']['name'];
//     //añadimos nombre temporal
//     $imagen_temporal = $_FILES['archivo']['tmp_name'];
//     //movemos la imagen recibida a la carpeta "imagenes"
//     move_uploaded_file($imagen_temporal,"imagenes/".$imagen);

//     //por ende necesitamos crear una carpeta donde se almacenen las imágenes que se 
//     //recepcionen

//     //instanciamos un nuevo objeto de la clase conexion
//     $objetoConexion = new conexion();

//     //escribimos la consulta a ejecutar
//     $sql = "INSERT INTO proyectos (id, imagen) VALUES (NULL, '$imagen')";
//     $objConexion->ejecutar($sql);
//     header("location: portafolio.php");
// }

//linea de código para llamar a la función que hace consultas a la base de datos y encierra en un 
//array todos las filas obtenidas
// $objetoConexion = new conexion();
// $proyectos = $objConexion->consultar("SELECT * FROM proyectos");


//linea de código para establecer una ruta base para los hipervinculos
$url_base = "http://localhost/petBosco2/";


//código para validar si hay una sesión iniciada para controlar el acceso de los usuarios a las páginas
// if (!isset($_SESSION['usuario'])) {
//     header("location:".$url_base."");
//   }
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
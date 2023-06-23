<?php

//conexión utilizando programación orientada a objetos
class Conexion { qjndekwnjkdnf
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
            echo "<h1>Conexión exitosa (operación realizada con éxito)</h1>";
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

        //RECEPCIÓN DE IMÁGENES EN LA FUNCIÓN DE EJECUTAR CONSULTA

        //     //obtenemos la fecha
    //     $fecha = new dateTime();

    //     //Necesitamos la recepción de nombre de imagen y 
    //     //usamos la funcion getTimestamp para obtener la hora a la que se sube para que 
    //     //se distinga de las otras yluego concatenamos el _ con el nombre de la imagen

    //     $imagen = $fecha->getTimestamp()."_".$_FILES['archivo']['name'];


    //     //añadimos nombre temporal
    //     $imagen_temporal = $_FILES['archivo']['tmp_name'];

    
    //     //movemos la imagen recibida a la carpeta "imagenes"
    //     move_uploaded_file($imagen_temporal,"imagenes/".$imagen);

    //     //por ende necesitamos crear una carpeta donde se almacenen las imágenes que se 
    //     //recepcionen

    //función para ejecutar consulta, donde tenemos 2 parámetros, la consulta de sql y el array de parámetros
    public function ejecutarConsulta($consulta, $parametros = array()) {
        $sentencia = $this->conexion->prepare($consulta);
        foreach ($parametros as $nombre => $valor) {
            $sentencia->bindParam($nombre, $valor);aojdkadkñjwef
        }
        $sentencia->execute();
        $resultados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        //  var_dump($sentencia->errorInfo());
        return $resultados;
    }
    

    public function login($consulta, $parametros = array()) {
        $sentencia = $this->conexion->prepare($consulta);
        foreach ($parametros as $nombre => $valor) {
            $sentencia->bindParam($nombre, $parametros[$nombre]);
        }
        $sentencia->execute();
        $resultados = $sentencia->fetch();
        // var_dump($sentencia->errorInfo());
        return $resultados;
    }
    




    //ejemplo de uso de la función:

    // // Crear una instancia de la clase Conexion
    // $conexionBD = new Conexion();
    // $conexion = $conexionBD->obtenerConexion();


    //ejecutar la función
     // $resultados = $conexionBD->ejecutarConsulta('SELECT * FROM personas WHERE nombre = :nombre', array(':nombre' => 'Juan'));


    //ejemplo de como llamar a todos los resultados
    
    // foreach ($resultados as $resultado) {
    //     echo $resultado['nombre'] '<br>';
    // }










    //LOGIN
    
    
    // if ($_POST) {
    //     $usuario = $_POST['usuario'];
    //     $password = $_POST['password'];

    //     $conexion = new Conexion();
    //     $conexionBD = $conexion->obtenerConexion();

    //     $resultados = $conexionBD->ejecutarConsulta
    //      ('SELECT *, count(*) as n_usuarios FROM usuario WHERE usuario=:usuario AND contraseña=:password', 
    //      array(':usuario' => $usuario, ':password' => $password));

    //     if ($resultados[0]['n_usuarios'] > 0) {
    //         echo "Hola";
    //     } else {
    //         echo "aaa";
    //     }
    // }

    //lo que sucede es que generamos un array asociativo y count nos devuelve un solo valor ya que debe encontrar solo un usuario cuyos datos ingresados en el form
    //coincidan con lo que la subconsulta encontró en la base de datos, por lo tanto el valor que devuelve, en el array usa la posición [0], si devolviera 3 
    //filas con coincidencias, tendríamos posición [0] ,[1] y [2], entonces volviendo al punto, condicionamos que el valor que tenemos en la posición [0]
    // es > a 0, entonces ejecuta

    //si usaramos fetch nomás en vez de fetchAll en el método, no usaramos lo de las posiciones, pero lo usamos porque lo necesitamos para otras cosas


}








// //inicio de sesión largo
// if ($_POST) {

//     $usuario = $_POST['usuario'];
//     $password = $_POST['password'];

//     //instanciamos un nuevo objeto de la clase conexión
//     $objetoConexion = new conexion();

//     //obtenemos el objeto PDO usando el método obtenerConexion()
//     $conexion = $objetoConexion->obtenerConexion();


//     //escribimos nuestra sentencia sql (los values siempre van entre comillas simples a menos que sean números)
//     $sql = "SELECT * ,count(*) as n_usuarios 
//     FROM usuario WHERE usuario=:usuario AND contraseña=:password";
//     //hacemos que nuestro objeto acceda al método ejecutar que tiene como parámetro a la sentencia sql 
//     $stmt = $conexion->prepare($sql);

//     $stmt->bindParam(":usuario", $usuario);
//     $stmt->bindParam(":password", $password);
//     $stmt->execute();

//     $registro = $stmt->fetch(PDO::FETCH_LAZY);

//     if ($registro['n_usuarios'] > 0) {
//         $_SESSION['usuario'] = $registro['usuario'];
//         $_SESSION['logueado'] = true;

//         // Guardar el ID del usuario en una variable de sesión

//         $id_usuario = $registro['id_usuario'];
//         $_SESSION['id_usuario'] = $id_usuario;
//     } else {
//         echo "datos incorrectos manito";
//     }
// }






//linea de código para establecer una ruta base para los hipervinculos
$url_base = "http://localhost/petBosco2/";













//código para validar si hay una sesión iniciada para controlar el acceso de los usuarios a las páginas
// if (!isset($_SESSION['usuario'])) {
//     header("location:".$url_base."");
//   }
?>

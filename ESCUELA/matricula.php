<?php

echo "<ul>";
echo "<li>" . $_POST['nif'] . "</li>";
echo "<li>" . $_POST['nombre'] . "</li>";
echo "<li>" . $_POST['apellidos'] . "</li>";
echo "<li>" . $_POST['cod_materia'] . "</li>";
echo "<li>" . $_POST['ano'] . "</li>";
echo "</ul>";

// Conexión con el servidor de la base de datos
/* La variable mysqli: 
no hace falta declararla, en el momento de darle un valor ya está definida */
$mysqli = new mysqli("127.0.0.1", "root", "maria123", "colegiosentrega", 3306);
if ($mysqli->connect_errno) {
    die("Error conectando con la base de datos.");
}

$nif = $_POST['nif'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$cod_materia = $_POST['cod_materia'];
$ano = $_POST['ano'];

$sentencia = $mysqli->prepare("CALL matriculacion(?,?,?,?,?)");
// los cinco parámetros se corresponden con los tipos de los campos, string y número
$sentencia->bind_param("ssssd",$nif, $nombre, $apellidos, $cod_materia, $ano);
$ok = $sentencia->execute();

if (!$ok) {
    echo "Error al matricular: (" .$sentencia->errno . ") " . $sentencia->error;
} else {
        echo "Alumno matriculado satisfactoriamente.";
    }

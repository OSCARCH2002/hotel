<?php

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cafetec";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Función para registrar usuario
function registrarUsuario($nombre, $identificacion, $contrasena, $rol, $conn)
{
    $rol_id = $conn->query("SELECT id FROM rol WHERE nombre = '$rol'")->fetch_assoc()['id'];
    $sql = "INSERT INTO usuarios (nombre, identificacion, contrasena, id_rol) VALUES ('$nombre', '$identificacion', '$contrasena', '$rol_id')";

    if ($conn->query($sql) === true) {
        echo "Registro exitoso.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Manejar el envío del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo_usuario = $_POST['tipo_usuario'];

    if (isset($_POST['registrar'])) {
        if ($tipo_usuario == 'estudiante') {
            $nombre = $_POST['nombre_estudiante'];
            $no_control = $_POST['no_control_registro_estudiante'];
            $contrasena = $_POST['contrasena_registro_estudiante'];
            registrarUsuario($nombre, $no_control, $contrasena, 'estudiante', $conn);
        } else {
            $nombre = $_POST['nombre_maestro'];
            $rfc = $_POST['rfc_registro_maestro'];
            $contrasena = $_POST['contrasena_registro_maestro'];
            registrarUsuario($nombre, $rfc, $contrasena, 'maestro', $conn);
        }
    }
}

$conn->close();

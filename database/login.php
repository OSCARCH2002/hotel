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

// Función para iniciar sesión
function iniciarSesion($identificacion, $contrasena, $rol, $conn)
{
    $sql = "SELECT * FROM usuarios WHERE identificacion = '$identificacion' AND contrasena = '$contrasena' AND id_rol = (SELECT id FROM rol WHERE nombre = '$rol')";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        session_start();
        $_SESSION['id'] = $row['id'];
        $_SESSION['nombre'] = $row['nombre'];
        $_SESSION['rol'] = $rol;

        if ($rol == 'estudiante') {
            header("Location: ../cafetec/pages/usuario/index.php");
            exit();
        } else {
            header("Location: ../cafetec/pages/usuario/index.php");
            exit();
        }
    } else {
        if (session_status() == PHP_SESSION_ACTIVE) {
            session_unset(); // Limpiar todas las variables de sesión
            session_destroy(); // Destruir la sesión
        }
        echo "<script>alert('Datos incorrectos.');</script>";
    }
}

// Manejar el envío del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo_usuario = $_POST['tipo_usuario'];

    if (isset($_POST['iniciar_sesion'])) {
        if ($tipo_usuario == 'estudiante') {
            $no_control = $_POST['no_control_estudiante'];
            $contrasena = $_POST['contrasena_estudiante'];
            iniciarSesion($no_control, $contrasena, 'estudiante', $conn);
        } else {
            $rfc = $_POST['rfc_maestro'];
            $contrasena = $_POST['contrasena_maestro'];
            iniciarSesion($rfc, $contrasena, 'maestro', $conn);
        }
    }
}
$conn->close();

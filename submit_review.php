<?php
header('Content-Type: application/json');

// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "567890";
$dbname = "propuesta";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    error_log("Error de conexión: " . $conn->connect_error);
    die(json_encode([
        'success' => false,
        'message' => 'Error de conexión a la base de datos',
        'error_details' => $conn->connect_error
    ]));
}

// Verificar si se recibieron los datos del formulario
if (!isset($_POST['nombre']) || !isset($_POST['calificacion']) || !isset($_POST['comentario'])) {
    die(json_encode([
        'success' => false,
        'message' => 'Datos del formulario incompletos'
    ]));
}

// Obtener y sanitizar datos
$nombre = $conn->real_escape_string($_POST['nombre']);
$calificacion = intval($_POST['calificacion']);
$comentario = $conn->real_escape_string($_POST['comentario']);

// Validar datos
if (empty($nombre) || empty($comentario) || $calificacion < 1 || $calificacion > 5) {
    die(json_encode([
        'success' => false,
        'message' => 'Datos inválidos',
        'received_data' => $_POST
    ]));
}

// Insertar en la base de datos
$sql = "INSERT INTO resenas (nombre, calificacion, comentario) VALUES ('$nombre', $calificacion, '$comentario')";

if ($conn->query($sql) === TRUE) {
    echo json_encode([
        'success' => true,
        'nombre' => htmlspecialchars($nombre),
        'calificacion' => $calificacion,
        'comentario' => htmlspecialchars($comentario),
        'insert_id' => $conn->insert_id
    ]);
} else {
    error_log("Error en consulta SQL: " . $conn->error);
    echo json_encode([
        'success' => false,
        'message' => 'Error al guardar en la base de datos',
        'sql_error' => $conn->error,
        'sql_query' => $sql
    ]);
}

$conn->close();
?>
<?php
include("../../database/conexion.php");

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conexion->prepare("
        SELECT e.*, c.nombre, c.apellidos, c.telefono 
        FROM evento e 
        JOIN cliente c ON e.id_cliente = c.id 
        WHERE e.id = :id
    ");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    
    $evento = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$evento) {
        die("Error: Evento no encontrado.");
    }
} else {
    die("Error: ID no especificado.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $telefono = $_POST['telefono'];
    $fecha_evento = $_POST['fecha_evento'];
    $num_personas = $_POST['num_personas'];

    try {
        $conexion->beginTransaction();

        $stmtEvento = $conexion->prepare("
            UPDATE evento 
            SET fecha_evento = :fecha_evento, num_personas = :num_personas 
            WHERE id = :id
        ");
        $stmtEvento->bindParam(':id', $id);
        $stmtEvento->bindParam(':fecha_evento', $fecha_evento);
        $stmtEvento->bindParam(':num_personas', $num_personas);
        $stmtEvento->execute();

        $stmtCliente = $conexion->prepare("
            UPDATE cliente 
            SET nombre = :nombre, apellidos = :apellidos, telefono = :telefono 
            WHERE id = (SELECT id_cliente FROM evento WHERE id = :id)
        ");
        $stmtCliente->bindParam(':id', $id);
        $stmtCliente->bindParam(':nombre', $nombre);
        $stmtCliente->bindParam(':apellidos', $apellidos);
        $stmtCliente->bindParam(':telefono', $telefono);
        $stmtCliente->execute();

        $conexion->commit();

        header("Location: ./dasboard.php?mensaje=Evento y cliente actualizados con éxito.");
        exit;
    } catch (PDOException $e) {
        $conexion->rollBack();
        echo "Error al actualizar: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Evento</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="my-4">Editar Evento</h1>
        <form method="POST">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" class="form-control" value="<?php echo htmlspecialchars($evento['nombre']); ?>" required>
            </div>
            <div class="form-group">
                <label for="apellidos">Apellidos:</label>
                <input type="text" name="apellidos" class="form-control" value="<?php echo htmlspecialchars($evento['apellidos']); ?>" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" name="telefono" class="form-control" value="<?php echo htmlspecialchars($evento['telefono']); ?>" required>
            </div>
            <div class="form-group">
                <label for="fecha_evento">Fecha del Evento:</label>
                <input type="date" name="fecha_evento" class="form-control" value="<?php echo htmlspecialchars($evento['fecha_evento']); ?>" required>
            </div>
            <div class="form-group">
                <label for="num_personas">Número de Personas:</label>
                <input type="number" name="num_personas" class="form-control" value="<?php echo htmlspecialchars($evento['num_personas']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="./dasboard.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>

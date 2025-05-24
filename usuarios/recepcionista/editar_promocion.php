<?php
session_start();
require_once '../../database/conexion.php';

// Verificar si el usuario es recepcionista
if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] != 1) {
    header('Location: ../../index.php');
    exit();
}

// Obtener el ID de la promoción
$id = isset($_GET['id']) ? $_GET['id'] : 0;

// Obtener datos de la promoción
$sql = "SELECT * FROM promociones_habitaciones WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bindParam(1, $id);
$stmt->execute();
$promocion = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$promocion) {
    header('Location: promociones.php');
    exit();
}

// Procesar el formulario de actualización
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_habitacion = $_POST['id_habitacion'];
    $descuento = $_POST['descuento'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $descripcion = $_POST['descripcion'];
    $estado = $_POST['estado'];

    $sql = "UPDATE promociones_habitaciones 
            SET id_habitacion = ?, descuento = ?, fecha_inicio = ?, fecha_fin = ?, descripcion = ?, estado = ? 
            WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(1, $id_habitacion);
    $stmt->bindParam(2, $descuento);
    $stmt->bindParam(3, $fecha_inicio);
    $stmt->bindParam(4, $fecha_fin);
    $stmt->bindParam(5, $descripcion);
    $stmt->bindParam(6, $estado);
    $stmt->bindParam(7, $id);
    
    if ($stmt->execute()) {
        header('Location: promociones.php?mensaje=Promoción actualizada exitosamente');
        exit();
    } else {
        $error = "Error al actualizar la promoción";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Promoción - Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include '../../includes/navbar.php'; ?>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Editar Promoción de Habitación</h2>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <form method="POST" action="">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="id_habitacion" class="form-label">Habitación</label>
                            <select class="form-select" id="id_habitacion" name="id_habitacion" required>
                                <?php
                                $habitaciones = $conexion->query('SELECT * FROM habitacion ORDER BY nombre');
                                while ($habitacion = $habitaciones->fetch(PDO::FETCH_ASSOC)) {
                                    $selected = ($habitacion['id'] == $promocion['id_habitacion']) ? 'selected' : '';
                                    echo '<option value="' . $habitacion['id'] . '" ' . $selected . '>' . $habitacion['nombre'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="descuento" class="form-label">Descuento (%)</label>
                            <input type="number" class="form-control" id="descuento" name="descuento" min="1" max="100" value="<?php echo $promocion['descuento']; ?>" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción de la Promoción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required><?php echo htmlspecialchars($promocion['descripcion']); ?></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="<?php echo $promocion['fecha_inicio']; ?>" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" value="<?php echo $promocion['fecha_fin']; ?>" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select" id="estado" name="estado" required>
                                <option value="activa" <?php echo $promocion['estado'] == 'activa' ? 'selected' : ''; ?>>Activa</option>
                                <option value="inactiva" <?php echo $promocion['estado'] == 'inactiva' ? 'selected' : ''; ?>>Inactiva</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="promociones.php" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Actualizar Promoción</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 
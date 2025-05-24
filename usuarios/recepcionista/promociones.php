<?php
session_start();
require_once '../../database/conexion.php';



// Procesar formulario de nueva promoción
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_habitacion = $_POST['id_habitacion'];
    $descuento = $_POST['descuento'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $descripcion = $_POST['descripcion'];
    $estado = $_POST['estado'];

    try {
        $conexion->beginTransaction();

        if ($id_habitacion === 'todas') {
            // Obtener todas las habitaciones
            $habitaciones = $conexion->query('SELECT id FROM habitacion');
            
            // Insertar la promoción para cada habitación
            $sql = "INSERT INTO promociones_habitaciones (id_habitacion, descuento, fecha_inicio, fecha_fin, descripcion, estado) 
                    VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conexion->prepare($sql);
            
            while ($habitacion = $habitaciones->fetch(PDO::FETCH_ASSOC)) {
                $stmt->bindParam(1, $habitacion['id']);
                $stmt->bindParam(2, $descuento);
                $stmt->bindParam(3, $fecha_inicio);
                $stmt->bindParam(4, $fecha_fin);
                $stmt->bindParam(5, $descripcion);
                $stmt->bindParam(6, $estado);
                $stmt->execute();
            }
            
            $mensaje = "Promoción agregada exitosamente a todas las habitaciones";
        } else {
            // Insertar promoción para una habitación específica
            $sql = "INSERT INTO promociones_habitaciones (id_habitacion, descuento, fecha_inicio, fecha_fin, descripcion, estado) 
                    VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(1, $id_habitacion);
            $stmt->bindParam(2, $descuento);
            $stmt->bindParam(3, $fecha_inicio);
            $stmt->bindParam(4, $fecha_fin);
            $stmt->bindParam(5, $descripcion);
            $stmt->bindParam(6, $estado);
            
            if ($stmt->execute()) {
                $mensaje = "Promoción agregada exitosamente";
            } else {
                throw new Exception("Error al agregar la promoción");
            }
        }
        
        $conexion->commit();
    } catch (Exception $e) {
        $conexion->rollBack();
        $error = "Error al agregar la promoción: " . $e->getMessage();
    }
}

// Obtener todas las promociones
$sql = "SELECT ph.*, h.nombre as nombre_habitacion,
        CASE 
            WHEN ph.estado = 'activa' AND EXISTS (
                SELECT 1 FROM reservas r 
                WHERE r.id_habitacion = ph.id_habitacion 
                AND r.fecha_llegada BETWEEN ph.fecha_inicio AND ph.fecha_fin
            ) THEN 'agotada'
            ELSE ph.estado 
        END as estado_actual
        FROM promociones_habitaciones ph 
        JOIN habitacion h ON ph.id_habitacion = h.id 
        ORDER BY ph.fecha_inicio DESC";
$result = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Promociones - Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Gestionar Promociones de Habitaciones</h2>

        <?php if (isset($mensaje)): ?>
            <div class="alert alert-success"><?php echo $mensaje; ?></div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <!-- Formulario para nueva promoción -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Nueva Promoción de Habitación</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="id_habitacion" class="form-label">Habitación</label>
                            <select class="form-select" id="id_habitacion" name="id_habitacion" required>
                                <option value="todas">Todas las habitaciones</option>
                                <?php
                                $habitaciones = $conexion->query('SELECT * FROM habitacion ORDER BY nombre');
                                while ($habitacion = $habitaciones->fetch(PDO::FETCH_ASSOC)) {
                                    echo '<option value="' . $habitacion['id'] . '">' . $habitacion['nombre'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="descuento" class="form-label">Descuento (%)</label>
                            <input type="number" class="form-control" id="descuento" name="descuento" min="1" max="100" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción de la Promoción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select" id="estado" name="estado" required>
                                <option value="activa">Activa</option>
                                <option value="inactiva">Inactiva</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar Promoción</button>
                </form>
            </div>
        </div>

        <!-- Lista de promociones -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Promociones Activas</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Habitación</th>
                                <th>Descuento</th>
                                <th>Descripción</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result->rowCount() > 0): ?>
                                <?php while($promo = $result->fetch(PDO::FETCH_ASSOC)): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($promo['nombre_habitacion']); ?></td>
                                        <td><?php echo $promo['descuento']; ?>%</td>
                                        <td><?php echo htmlspecialchars($promo['descripcion']); ?></td>
                                        <td><?php echo date('d/m/Y', strtotime($promo['fecha_inicio'])); ?></td>
                                        <td><?php echo date('d/m/Y', strtotime($promo['fecha_fin'])); ?></td>
                                        <td>
                                            <span class="badge bg-<?php 
                                                echo $promo['estado_actual'] == 'activa' ? 'success' : 
                                                    ($promo['estado_actual'] == 'agotada' ? 'warning' : 'danger'); ?>">
                                                <?php echo ucfirst($promo['estado_actual']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="editar_promocion.php?id=<?php echo $promo['id']; ?>" class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="eliminar_promocion.php?id=<?php echo $promo['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro de eliminar esta promoción?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">No hay promociones registradas</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 
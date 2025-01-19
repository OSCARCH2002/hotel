<?php
include("../../database/conexion.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

function agregarNuevaReserva($datos)
{
    global $conexion;

    try {
        if (!habitacionDisponible($datos['id_habitacion'], $datos['fecha_llegada'], $datos['fecha_salida'])) {
            return 'Habitación ocupada en las fechas seleccionadas.';
        }

        $id_cliente = obtenerOCrearCliente($datos['nombre'], $datos['apellidos'], $datos['telefono']);

        $consulta = "INSERT INTO reservas (id_cliente, id_habitacion, fecha_llegada, fecha_salida, total_adultos, total_ninos, total_pagar) 
                     VALUES (:id_cliente, :id_habitacion, :fecha_llegada, :fecha_salida, :total_adultos, :total_ninos, :total_pagar)";

        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(':id_cliente', $id_cliente);
        $stmt->bindParam(':id_habitacion', $datos['id_habitacion']);
        $stmt->bindParam(':fecha_llegada', $datos['fecha_llegada']);
        $stmt->bindParam(':fecha_salida', $datos['fecha_salida']);
        $stmt->bindParam(':total_adultos', $datos['total_adultos']);
        $stmt->bindParam(':total_ninos', $datos['total_ninos']);
        $stmt->bindParam(':total_pagar', $datos['total_pagar']);
        $stmt->execute();

        return 'Reserva exitosa.';
    } catch (PDOException $e) {
        return 'Error al agregar nueva reserva: ' . $e->getMessage();
    }
}

function habitacionDisponible($idHabitacion, $fechaLlegada, $fechaSalida)
{
    global $conexion;

    try {
        $sql = "SELECT COUNT(*) AS count FROM reservas WHERE id_habitacion = :idHabitacion AND fecha_llegada < :fechaSalida AND fecha_salida > :fechaLlegada";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':idHabitacion', $idHabitacion);
        $stmt->bindParam(':fechaLlegada', $fechaLlegada);
        $stmt->bindParam(':fechaSalida', $fechaSalida);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $row['count'];

        return $count == 0; 
    } catch (PDOException $e) {
        return false;
    }
}

function obtenerOCrearCliente($nombre, $apellidos, $telefono)
{
    global $conexion;

    // Verificar si el cliente ya existe
    $sql = "SELECT id FROM cliente WHERE nombre = :nombre AND apellidos = :apellidos AND telefono = :telefono";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellidos', $apellidos);
    $stmt->bindParam(':telefono', $telefono);
    $stmt->execute();
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($cliente) {
        return $cliente['id']; 
    } else {
        
        $sql = "INSERT INTO cliente (nombre, apellidos, telefono) VALUES (:nombre, :apellidos, :telefono)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->execute();
        return $conexion->lastInsertId(); 
    }
}


$mensaje = '';
if (isset($_POST['agregar_reserva'])) {
    $nuevaReserva = array(
        'id_habitacion' => $_POST['id_habitacion'],
        'nombre' => $_POST['nombre'],
        'apellidos' => $_POST['apellidos'],
        'telefono' => $_POST['telefono'],
        'fecha_llegada' => $_POST['fecha_llegada'],
        'fecha_salida' => $_POST['fecha_salida'],
        'total_adultos' => $_POST['total_adultos'],
        'total_ninos' => $_POST['total_ninos'],
        'total_pagar' => $_POST['total_pagar']
    );

    $mensaje = agregarNuevaReserva($nuevaReserva);
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Reserva</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/addreservas.css">
</head>

<body>
    <div class="container">
        <div class="card-header">
            <h2>COMPLETA LOS DATOS PARA AÑADIR</h2>
        </div>
        <div class="card-body">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" oninput="calcularTotalPagar()">
                <div class="form-container">
                    <div class="form-group">
                        <label for="id_habitacion">Número de Habitación:</label>
                        <select class="form-control" id="id_habitacion" name="id_habitacion" required>
                            <?php
                            $habitaciones = $conexion->query('SELECT * FROM habitacion');
                            while ($habitacion = $habitaciones->fetch()) {
                                echo '<option value="' . $habitacion["id"] . '">' . $habitacion["nombre"] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="apellidos">Apellidos:</label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono:</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" maxlength="10" pattern="\d{10}" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha_llegada">Fecha de Llegada:</label>
                        <input type="date" class="form-control" id="fecha_llegada" name="fecha_llegada" min="<?php echo date('Y-m-d'); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha_salida">Fecha de Salida:</label>
                        <input type="date" class="form-control" id="fecha_salida" name="fecha_salida" min="<?php echo date('Y-m-d'); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="total_adultos">Total de Adultos:</label>
                        <input type="number" class="form-control" id="total_adultos" name="total_adultos" required>
                    </div>
                    <div class="form-group">
                        <label for="total_ninos">Total de Niños:</label>
                        <input type="number" class="form-control" id="total_ninos" name="total_ninos" min="0" max="2" required>
                    </div>
                    <div class="form-group total-pagar-group">
                        <label for="total_pagar">Total a Pagar:</label>
                        <input type="number" class="form-control" id="total_pagar" name="total_pagar" readonly>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" name="agregar_reserva">Agregar Reserva</button>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modalMensaje" tabindex="-1" role="dialog" aria-labelledby="modalMensajeLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalMensajeLabel">Resultado de la Reserva</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    if ($mensaje) {
                        echo $mensaje;
                    }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <?php if ($mensaje === 'Reserva exitosa.') : ?>
                        <a href="./dasboard.php" class="btn btn-primary">Ver Reservas</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function () {
            <?php if ($mensaje): ?>
                $('#modalMensaje').modal('show');
            <?php endif; ?>
        });
    </script>

</body>

</html>

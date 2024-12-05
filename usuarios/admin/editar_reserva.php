<?php
include("../../database/conexion.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['actualizar'])) {
    $reserva_id = $_POST['reserva_id'];
    $cliente_id = $_POST['cliente_id'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $telefono = $_POST['telefono'];
    $fecha_llegada = $_POST['fecha_llegada'];
    $fecha_salida = $_POST['fecha_salida'];
    $total_adultos = $_POST['total_adultos'];
    $total_ninos = $_POST['total_ninos'];

    $fechaInicio = new DateTime($fecha_llegada);
    $fechaFin = new DateTime($fecha_salida);
    $diasReserva = $fechaFin->diff($fechaInicio)->days;
    $tarifaDiaria = 300;

    if ($diasReserva > 30) {
        $total = 1800; 
    } else {
        $total = $diasReserva * $tarifaDiaria; 
    }

    $comisionAdultos = $total_adultos > 2 ? ($total_adultos - 2) * 50 : 0;
    $total_pagar = $total + $comisionAdultos;

    try {
        $conexion->beginTransaction();

        $sql_cliente = "UPDATE cliente SET nombre = :nombre, apellidos = :apellidos, telefono = :telefono WHERE id = :cliente_id";
        $stmt_cliente = $conexion->prepare($sql_cliente);
        $stmt_cliente->bindParam(':nombre', $nombre);
        $stmt_cliente->bindParam(':apellidos', $apellidos);
        $stmt_cliente->bindParam(':telefono', $telefono);
        $stmt_cliente->bindParam(':cliente_id', $cliente_id);

        if (!$stmt_cliente->execute()) {
            throw new Exception("Error al actualizar cliente: " . implode(", ", $stmt_cliente->errorInfo()));
        }

        $sql_reserva = "UPDATE reservas SET fecha_llegada = :fecha_llegada, fecha_salida = :fecha_salida, total_adultos = :total_adultos, total_ninos = :total_ninos, total_pagar = :total_pagar WHERE id = :reserva_id";
        $stmt_reserva = $conexion->prepare($sql_reserva);
        $stmt_reserva->bindParam(':fecha_llegada', $fecha_llegada);
        $stmt_reserva->bindParam(':fecha_salida', $fecha_salida);
        $stmt_reserva->bindParam(':total_adultos', $total_adultos);
        $stmt_reserva->bindParam(':total_ninos', $total_ninos);
        $stmt_reserva->bindParam(':total_pagar', $total_pagar);
        $stmt_reserva->bindParam(':reserva_id', $reserva_id);

        if (!$stmt_reserva->execute()) {
            throw new Exception("Error al actualizar reserva: " . implode(", ", $stmt_reserva->errorInfo()));
        }

        $conexion->commit();
        header('Location: ./dasboard.php');
        exit();
    } catch (Exception $e) {
        $conexion->rollBack();
        echo "Error: " . $e->getMessage();
    }
}

if (isset($_GET['id'])) {
    $reserva_id = $_GET['id'];
    $sql = "SELECT r.id AS reserva_id, r.fecha_llegada, r.fecha_salida, r.total_adultos, r.total_ninos, r.total_pagar, 
                   c.id AS cliente_id, c.nombre AS cliente_nombre, c.apellidos AS cliente_apellidos, c.telefono AS cliente_telefono 
            FROM reservas r 
            JOIN cliente c ON r.id_cliente = c.id 
            WHERE r.id = :reserva_id";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':reserva_id', $reserva_id);
    $stmt->execute();
    $reserva = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$reserva) {
        echo "Reserva no encontrada.";
        exit();
    }
}

$currentDate = date('Y-m-d'); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Reserva</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .form-container { background-color: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); margin-top: 50px; }
        h1 { margin-bottom: 30px; }
        .error { color: red; }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h1 class="text-center">Editar Reserva</h1>
            <form method="POST" action="editar_reserva.php?id=<?php echo $reserva['reserva_id']; ?>" id="reservaForm">
                <input type="hidden" name="reserva_id" value="<?php echo $reserva['reserva_id']; ?>">
                <input type="hidden" name="cliente_id" value="<?php echo $reserva['cliente_id']; ?>">

                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" name="nombre" pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$" title="Solo letras y espacios" value="<?php echo $reserva['cliente_nombre']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" class="form-control" name="apellidos" pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$" title="Solo letras y espacios" value="<?php echo $reserva['cliente_apellidos']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono:</label>
                    <input type="text" class="form-control" name="telefono" pattern="^\d{10}$" title="Debe ser un número de 10 dígitos" value="<?php echo $reserva['cliente_telefono']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="fecha_llegada">Fecha de Llegada:</label>
                    <input type="date" class="form-control" name="fecha_llegada" id="fecha_llegada" min="<?php echo $currentDate; ?>" value="<?php echo $reserva['fecha_llegada']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="fecha_salida">Fecha de Salida:</label>
                    <input type="date" class="form-control" name="fecha_salida" id="fecha_salida" min="<?php echo $currentDate; ?>" value="<?php echo $reserva['fecha_salida']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="total_adultos">Total Adultos:</label>
                    <input type="number" class="form-control" name="total_adultos" id="total_adultos" min="1" value="<?php echo $reserva['total_adultos']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="total_ninos">Total Niños:</label>
                    <input type="number" class="form-control" name="total_ninos" id="total_ninos" min="0" max="2" value="<?php echo $reserva['total_ninos']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="total_pagar">Total a Pagar:</label>
                    <input type="text" class="form-control" name="total_pagar" id="total_pagar" value="<?php echo $reserva['total_pagar']; ?>" readonly>
                </div>
                <button type="submit" name="actualizar" class="btn btn-primary btn-block">Actualizar Reserva</button>
                <div class="error" id="dateError"></div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const fechaLlegada = document.getElementById('fecha_llegada');
            const fechaSalida = document.getElementById('fecha_salida');
            const totalAdultos = document.getElementById('total_adultos');
            const totalPagar = document.getElementById('total_pagar');
            const tarifaDiaria = 300;

            function calcularTotal() {
                const llegada = new Date(fechaLlegada.value);
                const salida = new Date(fechaSalida.value);
                const diasReserva = Math.ceil((salida - llegada) / (1000 * 3600 * 24));
                let total = 0;

                if (salida < llegada) {
                    document.getElementById('dateError').innerText = "La fecha de salida no puede ser anterior a la fecha de llegada.";
                    totalPagar.value = ''; 
                    return; 
                } else {
                    document.getElementById('dateError').innerText = ""; 
                }

                if (diasReserva > 30) {
                    total = 1800; 
                } else {
                    total = diasReserva * tarifaDiaria; 
                }

                const adultos = parseInt(totalAdultos.value);
                const comisionAdultos = adultos > 2 ? (adultos - 2) * 50 : 0;
                total += comisionAdultos;

                totalPagar.value = total.toFixed(2); 
            }

            fechaLlegada.addEventListener('change', calcularTotal);
            fechaSalida.addEventListener('change', calcularTotal);
            totalAdultos.addEventListener('change', calcularTotal);
        });
    </script>
</body>
</html>

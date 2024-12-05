<?php
include("../../database/conexion.php");
function validarDatos($datos)
{
    if (!preg_match("/^[a-zA-Z\s]+$/", $datos['nombre'])) {
        return "El nombre solo debe contener letras y espacios.";
    }

    if (!preg_match("/^[a-zA-Z\s]+$/", $datos['apellido'])) {
        return "El apellido solo debe contener letras y espacios.";
    }

    if (!preg_match("/^\d{10}$/", $datos['telefono'])) {
        return "solo debe contener  10 dígitos.";
    }

    if (!preg_match("/^\d+$/", $datos['num_personas']) || $datos['num_personas'] < 1 || $datos['num_personas'] > 200) {
        return "El número de personas debe ser un número entre 1 y 200.";
    }

    $fecha_evento = strtotime($datos['fecha_evento']);
    $fecha_actual = strtotime(date("Y-m-d"));
    if ($fecha_evento < $fecha_actual) {
        return "La fecha del evento no puede ser anterior a la fecha actual.";
    }

    return true;
}

function verificarFechaOcupada($fecha_evento)
{
    global $conexion;
    $consulta = "SELECT COUNT(*) FROM evento WHERE fecha_evento = :fecha_evento";
    $stmt = $conexion->prepare($consulta);
    $stmt->bindParam(':fecha_evento', $fecha_evento);
    $stmt->execute();
    return $stmt->fetchColumn() > 0;
}

function agregarNuevoEvento($datos)
{
    global $conexion;
    try {
        if (verificarFechaOcupada($datos['fecha_evento'])) {
            echo "<script>alert('Evento ocupado en la fecha seleccionada.'); window.location.href = './dasboard.php';</script>";
            return;
        }

        $conexion->beginTransaction();

        $insertarCliente = "INSERT INTO cliente (nombre, apellidos, telefono) VALUES (:nombre, :apellido, :telefono)";
        $stmtCliente = $conexion->prepare($insertarCliente);
        $stmtCliente->bindParam(':nombre', $datos['nombre']);
        $stmtCliente->bindParam(':apellido', $datos['apellido']);
        $stmtCliente->bindParam(':telefono', $datos['telefono']);

        if (!$stmtCliente->execute()) {
            throw new Exception('Error al insertar cliente.');
        }

        $id_cliente = $conexion->lastInsertId();

        if (!$id_cliente) {
            throw new Exception('Error al obtener el ID del cliente.');
        }

        $insertarEvento = "INSERT INTO evento (fecha_evento, num_personas, id_cliente) VALUES (:fecha_evento, :num_personas, :id_cliente)";
        $stmtEvento = $conexion->prepare($insertarEvento);
        $stmtEvento->bindParam(':fecha_evento', $datos['fecha_evento']);
        $stmtEvento->bindParam(':num_personas', $datos['num_personas']);
        $stmtEvento->bindParam(':id_cliente', $id_cliente);

        if (!$stmtEvento->execute()) {
            throw new Exception('Error al insertar evento.');
        }

        $conexion->commit();
        echo "<script>alert('Evento reservado exitosamente.'); window.location.href = './dasboard.php';</script>";
    } catch (Exception $e) {
        $conexion->rollBack();
        echo "<script>alert('Error: " . $e->getMessage() . "'); window.location.href = './dasboard.php';</script>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nuevoEvento = array(
        'nombre' => $_POST['nombre'],
        'apellido' => $_POST['apellido'],
        'telefono' => $_POST['telefono'],
        'fecha_evento' => $_POST['fecha_evento'],
        'num_personas' => $_POST['num_personas']
    );
    agregarNuevoEvento($nuevoEvento);
    exit;
}


?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nuevo Evento</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/addevento.css">
</head>

<body>
    <div class="container">
        <h1 class="titulo">Agregar Nuevo Evento</h1>
        <form id="eventoForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Introduce el nombre" pattern="^[a-zA-Z\s]+$" title="Solo se permiten letras y espacios." required>
            </div>
            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Introduce el apellido" pattern="^[a-zA-Z\s]+$" title="Solo se permiten letras y espacios." required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" pattern="^\d{10}$" title="Debe contener 10 dígitos y no se permiten letras." placeholder="Introduce el teléfono" required>
            </div>
            <div class="form-group">
                <label for="fecha_evento">Fecha del Evento</label>
                <input type="date" class="form-control" id="fecha_evento" name="fecha_evento" required min="<?php echo date('Y-m-d'); ?>">
            </div>

            <div class="form-group">
                <label for="num_personas">Número de Personas</label>
                <input type="number" class="form-control" id="num_personas" name="num_personas" max="200" min="1" placeholder="Número de personas (máximo 200)" required>
            </div>
            <button type="submit" class="btn btn-primary" id="agregar_evento">Agregar Evento</button>
            <div id="mensaje"></div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            const today = new Date().toISOString().split('T')[0];
            $('#fecha_evento').attr('min', today);

            $('#eventoForm').submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $('#mensaje').html('<div class="alert alert-success" role="alert">' + response.message + '</div>');
                            $('#eventoForm')[0].reset();
                        } else {
                            $('#mensaje').html('<div class="alert alert-danger" role="alert">' + response.message + '</div>');
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>
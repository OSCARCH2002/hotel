<?php
include("../../database/conexion.php");

function obtenerTodasLasReservas() {
    global $conexion;
    try {
        $consulta = "
            SELECT 
                r.id AS reserva_id,
                c.id AS cliente_id,
                c.nombre AS cliente_nombre,
                c.apellidos AS cliente_apellidos,
                c.telefono AS cliente_telefono,
                r.fecha_llegada,
                r.fecha_salida,
                r.total_adultos,
                r.total_ninos,
                r.total_pagar
            FROM 
                reservas r
            JOIN 
                cliente c ON r.id_cliente = c.id
        ";
        $stmt = $conexion->query($consulta);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Error al obtener reservas: ' . $e->getMessage();
        return array();
    }
}


if (isset($_GET['eliminar'])) {
    $reserva_id = $_GET['eliminar'];
    try {
        $conexion->beginTransaction();

        $sql_obtener_cliente = "SELECT id_cliente FROM reservas WHERE id = :reserva_id";
        $stmt_cliente_id = $conexion->prepare($sql_obtener_cliente);
        $stmt_cliente_id->bindParam(':reserva_id', $reserva_id);
        $stmt_cliente_id->execute();
        $id_cliente = $stmt_cliente_id->fetchColumn();

        if ($id_cliente) {
            $sql = "DELETE FROM reservas WHERE id = :reserva_id";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':reserva_id', $reserva_id);
            $stmt->execute();

            $sql_cliente = "DELETE FROM cliente WHERE id = :id_cliente";
            $stmt_cliente = $conexion->prepare($sql_cliente);
            $stmt_cliente->bindParam(':id_cliente', $id_cliente);
            $stmt_cliente->execute();

            $conexion->commit();
        } else {
            $conexion->rollBack();
            echo 'Error: Cliente no encontrado.';
        }

      
        header('Location: ./dasboard.php');
    } catch (PDOException $e) {
        $conexion->rollBack();
        echo 'Error al eliminar: ' . $e->getMessage();
    }
}

$registrosPorPagina = 10;
$totalRegistros = count(obtenerTodasLasReservas());
$totalPaginas = ceil($totalRegistros / $registrosPorPagina);
$paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

if ($paginaActual < 1) $paginaActual = 1;
if ($paginaActual > $totalPaginas) $paginaActual = $totalPaginas;

$indiceInicial = ($paginaActual - 1) * $registrosPorPagina;
$reservas = obtenerTodasLasReservas();
$reservasPaginadas = array_slice($reservas, $indiceInicial, $registrosPorPagina);

$currentDate = date('Y-m-d'); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .disabled-button {
            opacity: 0.5;
            pointer-events: none; 
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">MIS RESERVAS</h1>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Teléfono</th>
                        <th>Fecha Llegada</th>
                        <th>Fecha Salida</th>
                        <th>Adultos</th>
                        <th>Niños</th>
                        <th>Total a Pagar</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reservasPaginadas as $reserva): ?>
                        <tr>
                            <td><?php echo $reserva['reserva_id']; ?></td>
                            <td><?php echo $reserva['cliente_nombre']; ?></td>
                            <td><?php echo $reserva['cliente_apellidos']; ?></td>
                            <td><?php echo $reserva['cliente_telefono']; ?></td>
                            <td><?php echo $reserva['fecha_llegada']; ?></td>
                            <td><?php echo $reserva['fecha_salida']; ?></td>
                            <td><?php echo $reserva['total_adultos']; ?></td>
                            <td><?php echo $reserva['total_ninos']; ?></td>
                            <td><?php echo $reserva['total_pagar']; ?></td>
                            <td>
                                <?php if ($reserva['fecha_llegada'] < $currentDate): ?>
                                    <a href="#" class="btn btn-warning btn-sm disabled-button">Editar</a>
                                <?php else: ?>
                                    <a href="./editar_reserva.php?id=<?php echo $reserva['reserva_id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                                <?php endif; ?>
                                <a href="reservas.php?eliminar=<?php echo $reserva['reserva_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar esta reserva y cliente?');">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <nav>
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                    <li class="page-item <?php echo ($i == $paginaActual) ? 'active' : ''; ?>">
                        <a class="page-link" href="javascript:void(0);" onclick="loadContent('reservas.php?pagina=<?php echo $i; ?>')"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>
</body>
</html>

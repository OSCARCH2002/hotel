<?php
include("../../database/conexion.php");

function obtenerTodosLosEventos()
{
    global $conexion;
    try {
        $consulta = "
            SELECT 
                e.id, 
                c.nombre, 
                c.apellidos, 
                c.telefono, 
                e.fecha_evento, 
                e.num_personas 
            FROM 
                evento e
            JOIN 
                cliente c ON e.id_cliente = c.id
        ";
        $stmt = $conexion->query($consulta);
        $eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $eventos;
    } catch (PDOException $e) {
        echo 'Error al obtener eventos: ' . $e->getMessage() . ' en la línea ' . $e->getLine();
        return array();
    }
}

// Paginación
$registrosPorPagina = 10;
$totalRegistros = count(obtenerTodosLosEventos());
$totalPaginas = ceil($totalRegistros / $registrosPorPagina);
$paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$indiceInicial = ($paginaActual - 1) * $registrosPorPagina;
$eventos = obtenerTodosLosEventos();
$eventosPaginados = array_slice($eventos, $indiceInicial, $registrosPorPagina);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recepcionista - Eventos</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="fondo">
    <div class="container">
       
        <h1 class="text-center text-dark font-weight-bold my-4">MIS EVENTOS</h1>
        <div id="eventos-container" class="table-responsive table-background">
            <table class="table table-striped table-sm table-spacing">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Teléfono</th>
                        <th>Fecha del Evento</th>
                        <th>Número de Personas</th>
                        <th>Acciones</th> 
                    </tr>
                </thead>
                <tbody id="eventos-body">
                    <?php foreach ($eventosPaginados as $evento) : ?>
                        <tr>
                            <td><?php echo $evento['id']; ?></td>
                            <td><?php echo $evento['nombre']; ?></td>
                            <td><?php echo $evento['apellidos']; ?></td>
                            <td><?php echo $evento['telefono']; ?></td>
                            <td><?php echo $evento['fecha_evento']; ?></td>
                            <td><?php echo $evento['num_personas']; ?></td>
                            <td>
                                <a href="editar_evento.php?id=<?php echo $evento['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="eliminar_evento.php?id=<?php echo $evento['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este evento?');">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

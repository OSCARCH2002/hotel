<?php
require_once '../../database/conexion.php';

session_start();

if (!isset($_SESSION['id'])) {
    header("Location: ../../index.php");
    exit();
}

$usuario_id = $_SESSION['id'];

// Actualizamos la consulta SQL para incluir el campo 'nombre' de la tabla 'estatus'
$sql = "SELECT p.numero_pedido, p.cantidad, p.fecha_pedido, p.total, e.nombre AS nombre_estatus, c.productos AS nombre_producto
        FROM pedidos p
        INNER JOIN comida c ON p.FK_comida = c.id
        INNER JOIN estatus e ON p.FK_estatus = e.id
        WHERE p.FK_usuario = $usuario_id
        ORDER BY p.fecha_pedido DESC
        LIMIT 5";

$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Compra - CafeTec</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .header {
            background-color: #1B396A;
            color: white;
            padding: 10px;
            border-radius: 10px 10px 0 0;
        }

        .table th {
            background-color: #1B396A;
            color: white;
        }

        .table tbody tr td {
            vertical-align: middle;
        }

        .btn-primary {
            background-color: #337ab7;
            border-color: #2e6da4;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>¡Gracias por su compra!</h2>
        </div>
        <div class="content">
            <p>Detalles de su pedido</p>
            <?php if ($resultado->num_rows > 0) : ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Número de Pedido</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Fecha</th>
                            <th>Total</th>
                            <th>Estatus</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $resultado->fetch_assoc()) : ?>
                            <tr>
                                <td><?php echo $row['numero_pedido']; ?></td>
                                <td><?php echo $row['nombre_producto']; ?></td>
                                <td><?php echo $row['cantidad']; ?></td>
                                <td><?php echo $row['fecha_pedido']; ?></td>
                                <td><?php echo '$' . number_format($row['total'], 2, ',', '.'); ?></td>
                                <td><?php echo $row['nombre_estatus']; ?></td> 
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <p>No se encontraron pedidos recientes.</p>
            <?php endif; ?>
            <a href="./index.php" class="btn btn-primary">Volver a inicio</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

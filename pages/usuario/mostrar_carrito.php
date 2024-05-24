<?php
require_once '../../database/conexion.php';


session_start();

if (!isset($_SESSION['id'])) {
    header("Location: ../../index.php");
    exit();
}

$usuario_id = $_SESSION['id'];


if (isset($_POST['update_quantity'])) {
    $cart_id = $_POST['cart_id'];
    $new_quantity = $_POST['quantity'];
    $sql_update = "UPDATE carrito SET cantidad = $new_quantity WHERE id = $cart_id AND FK_usuario = $usuario_id";
    $conn->query($sql_update);
    header("Location: http://localhost/cafetec/pages/usuario/mostrar_carrito.php");
    exit();
}

if (isset($_POST['delete_product'])) {
    $cart_id = $_POST['cart_id'];
    $sql_delete = "DELETE FROM carrito WHERE id = $cart_id AND FK_usuario = $usuario_id";
    $conn->query($sql_delete);
    header("Location: http://localhost/cafetec/pages/usuario/mostrar_carrito.php");
    exit();
}


$sql = "SELECT c.id, c.cantidad, p.productos AS nombre_producto, p.precio 
        FROM carrito c
        INNER JOIN comida p ON c.FK_comida = p.id
        WHERE c.FK_usuario = $usuario_id";

$resultado = $conn->query($sql);

$total_general = 0;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CafeTec</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .modal-dialog {
            max-width: 800px;
        }

        .modal-content {
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            background-color: #1B396A;
            color: white;
            padding: 10px;
            border-bottom: 1px solid #1B396A;
        }

        .modal-body {
            padding: 20px;
        }

        .table {
            margin-bottom: 20px;
        }

        .table thead th {
            background-color: #1B396A;
            color: white;
            border-bottom: 1px solid #ddd;
        }

        .table tbody tr td {
            vertical-align: middle;
        }

        .total {
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
        }

        .btn-primary {
            background-color: #337ab7;
            border-color: #2e6da4;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
        }

        .btn-danger {
            padding: 5px 10px;
            font-size: 14px;
            border-radius: 5px;
        }

        .form-control {
            display: inline-block;
            width: 60px;
            margin-right: 10px;
        }

        .form-inline {
            display: flex;
            align-items: center;
        }
    </style>
</head>

<body>
    <div class="modal fade show" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cartModalLabel" style="text-align: center;">Carrito de Compra</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php if ($resultado->num_rows > 0) : ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Total</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $resultado->fetch_assoc()) : ?>
                                    <tr>
                                        <td><?php echo $row['nombre_producto']; ?></td>
                                        <td>
                                            <form class="form-inline" method="post" action="">
                                                <input type="hidden" name="cart_id" value="<?php echo $row['id']; ?>">
                                                <input type="number" name="quantity" value="<?php echo $row['cantidad']; ?>" min="1" class="form-control">
                                                <button type="submit" name="update_quantity" class="btn btn-sm btn-primary">Actualizar</button>
                                            </form>
                                        </td>
                                        <td><?php echo '$' . number_format($row['precio'], 2, ',', '.'); ?></td>
                                        <td><?php echo '$' . number_format($row['cantidad'] * $row['precio'], 2, ',', '.'); ?></td>
                                        <td>
                                            <form method="post" action="">
                                                <input type="hidden" name="cart_id" value="<?php echo $row['id']; ?>">
                                                <button type="submit" name="delete_product" class="btn btn-sm btn-danger">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php $total_general += $row['cantidad'] * $row['precio']; ?>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                        <div class="total">
                            Total a pagar: <?php echo '$' . number_format($total_general, 2, ',', '.'); ?>
                        </div>
                    <?php else : ?>
                        <p style="text-align: center;">No hay productos en el carrito <br>Empieza a comprar ahora :)</p>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="window.history.back();">Cancelar</button>
                    <a href="procesar_compra.php" class="btn btn-primary">Realizar Pedido</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#cartModal').modal('show');
        });
    </script>
</body>

</html>
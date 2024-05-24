<?php
require_once '../../database/conexion.php';


session_start();

if (!isset($_SESSION['id'])) {
    header("Location: ../../index.php");
    exit();
}

$usuario_id = $_SESSION['id'];

$conn->begin_transaction();

try {
    $sql = "SELECT c.id, c.cantidad, p.precio, c.FK_comida
            FROM carrito c
            INNER JOIN comida p ON c.FK_comida = p.id
            WHERE c.FK_usuario = $usuario_id";

    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        $total_general = 0;

        while ($row = $resultado->fetch_assoc()) {
            $cantidad = $row['cantidad'];
            $precio = $row['precio'];
            $comida_id = $row['FK_comida'];
            $total = $cantidad * $precio;
            $total_general += $total;


            $usuario_id = $_SESSION['id'];

            $numero_pedido = date('YmdHis') . '-' . $usuario_id . '-' . mt_rand(1000, 9999);

            $sql_insert = "INSERT INTO pedidos (numero_pedido, cantidad, fecha_pedido, total, FK_estatus, FK_comida, FK_usuario)
               VALUES ('$numero_pedido', $cantidad, NOW(), $total, 2, $comida_id, $usuario_id)";

            $conn->query($sql_insert);
        }

        
        $sql_delete_cart = "DELETE FROM carrito WHERE FK_usuario = $usuario_id";
        $conn->query($sql_delete_cart);

        $conn->commit();


        header("Location: confirmacion.php");
        exit();
    } else {
        header("Location: mostrar_carrito.php");
        exit();
    }
} catch (mysqli_sql_exception $exception) {
    $conn->rollback();
    echo "Error: " . $exception->getMessage();
}

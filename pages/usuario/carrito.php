<?php
require_once '../../database/conexion.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $producto_id = $_POST["producto_id"];
    $nombre_producto = $_POST["nombre_producto"];
    $precio = $_POST["precio"];
    $cantidad = $_POST["cantidad"];
    $tipo_comida = $_POST["tipo_comida"];

    if (isset($_SESSION['id'])) {
        $usuario_id = $_SESSION['id'];
        $fecha_pedido = date("Y-m-d");
        $total = $precio * $cantidad;

        $sql = "INSERT INTO carrito (cantidad, fecha_pedido, total, FK_comida, FK_usuario, tipo_comida) 
                VALUES ('$cantidad', '$fecha_pedido', '$total', '$producto_id', '$usuario_id', '$tipo_comida')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Producto agregado al carrito exitosamente'); window.history.back();</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "El usuario no está autenticado.";
    }
}
?>

<?php
session_start();
require_once '../../database/conexion.php';

// Verificar si el usuario es recepcionista
//if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] != 1) {
  //  header('Location: ../../index.php');
    //exit();
//}

// Obtener el ID de la promoción
$id = isset($_GET['id']) ? $_GET['id'] : 0;

// Eliminar la promoción
$sql = "DELETE FROM promociones_habitaciones WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bindParam(1, $id);

if ($stmt->execute()) {
    header('Location: promociones.php?mensaje=Promoción eliminada exitosamente');
} else {
    header('Location: promociones.php?error=Error al eliminar la promoción');
}
exit(); 
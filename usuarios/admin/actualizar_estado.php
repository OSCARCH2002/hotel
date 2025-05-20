<?php
include('../../database/conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_habitacion = $_POST['id_habitacion'];
    $nuevo_estado = $_POST['nuevo_estado'];

    $query = "UPDATE habitacion SET id_estado = :estado WHERE id = :id";
    $stmt = $conexion->prepare($query);
    
    try {
        $stmt->execute([
            ':estado' => $nuevo_estado,
            ':id' => $id_habitacion
        ]);
        echo "Estado actualizado correctamente.";
    } catch (PDOException $e) {
        echo "Error al actualizar el estado: " . $e->getMessage();
    }
}
?>

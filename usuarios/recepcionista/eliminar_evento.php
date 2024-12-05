<?php
include("../../database/conexion.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
     
        $conexion->beginTransaction();

        $stmt1 = $conexion->prepare("DELETE FROM evento WHERE id = :id");
        $stmt1->bindParam(':id', $id);
        $stmt1->execute();

      
        $stmt2 = $conexion->prepare("DELETE FROM cliente WHERE id = (SELECT id_cliente FROM evento WHERE id = :id)");
        $stmt2->bindParam(':id', $id);
        $stmt2->execute();


        $conexion->commit();

        header("Location: ./dasboard.php?mensaje=Evento y cliente eliminados con éxito.");
        exit;
    } catch (PDOException $e) {
        $conexion->rollBack();
        echo "Error al eliminar: " . $e->getMessage();
    }
}
?>

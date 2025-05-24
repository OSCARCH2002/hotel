<?php
session_start();
if (!isset($_SESSION['id_cliente'])) {
    header("Location: index.php");
    exit();
}
require '../../database/conexion.php';

// Obtener los puntos actualizados del cliente
$sql = "SELECT cp.Puntos_Acumulados 
        FROM clientes_puntos cp 
        WHERE cp.id_cliente = :id_cliente";
$stmt = $conexion->prepare($sql);
$stmt->execute(['id_cliente' => $_SESSION['id_cliente']]);
$puntos = $stmt->fetch(PDO::FETCH_ASSOC);
$puntos_acumulados = $puntos['Puntos_Acumulados'] ?? 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Puntos - Quinta Micaele</title>
    <style>
        :root {
            --primary-color: #884E40;
            --secondary-color: #734035;
            --background-color: #f8f5f3;
            --text-color: #333;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--background-color), #e5e5e5);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .puntos-container {
            background: white;
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }

        .puntos-header {
            margin-bottom: 2rem;
        }

        .puntos-header h1 {
            color: var(--primary-color);
            font-size: 2.2rem;
            margin-bottom: 0.5rem;
        }

        .puntos-valor {
            font-size: 3.5rem;
            color: var(--primary-color);
            font-weight: bold;
            margin: 1.5rem 0;
        }

        .puntos-info {
            color: var(--text-color);
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .btn-volver {
            display: inline-block;
            padding: 1rem 2rem;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-volver:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(136, 78, 64, 0.3);
        }
    </style>
</head>
<body>
    <div class="puntos-container">
        <div class="puntos-header">
            <h1>Mis Puntos</h1>
            <p>Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre'] . ' ' . $_SESSION['apellidos']); ?></p>
        </div>
        
        <div class="puntos-valor">
            <?php echo number_format($puntos_acumulados); ?> puntos
        </div>
        
        <div class="puntos-info">
            <p>Estos son tus puntos acumulados por tus reservaciones en Quinta Micaele.</p>
            <p>¡Sigue reservando para acumular más puntos y obtener beneficios exclusivos!</p>
        </div>
        
        <a href="../promociones/promociones.php" class="btn-volver">ver promociones</a>
        <a href="../../index.php" class="btn-volver">Volver al Inicio</a>
    </div>
</body>
</html>

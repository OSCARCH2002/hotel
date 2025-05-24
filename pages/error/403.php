<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Restringido - Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .error-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .error-content {
            background-color: white;
            border-radius: 15px;
            padding: 40px;
            text-align: center;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            max-width: 600px;
            width: 100%;
        }
        .error-icon {
            font-size: 80px;
            color: #dc3545;
            margin-bottom: 20px;
        }
        .error-title {
            color: #dc3545;
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
        .error-message {
            color: #6c757d;
            font-size: 1.2rem;
            margin-bottom: 30px;
        }
        .btn-home {
            background-color: #0d6efd;
            color: white;
            padding: 10px 25px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .btn-home:hover {
            background-color: #0b5ed7;
            color: white;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-content">
            <i class="fas fa-exclamation-triangle error-icon"></i>
            <h1 class="error-title">Acceso Restringido</h1>
            <p class="error-message">
                Lo sentimos, necesitas iniciar sesión para acceder a esta sección.<br>
                Regístrate o inicia sesión para disfrutar de nuestras promociones exclusivas.
            </p>
            <div class="d-flex justify-content-center gap-3">
                <a href="../registro/index.php" class="btn btn-primary">Registrarse</a>
                <a href="../registro/index.php" class="btn btn-outline-primary">Iniciar Sesión</a>
                <a href="../../index.php" class="btn btn-secondary">Volver al Inicio</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 
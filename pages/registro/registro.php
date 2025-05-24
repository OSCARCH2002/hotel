<?php
session_start();
include("../../temp/header.php");
require '../../database/conexion.php';

$error = '';
$exito = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $contrasena = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);
    
    // Verificar si el correo ya existe
    $sql_verificar = "SELECT id FROM cliente WHERE correo = :correo";
    $stmt = $conexion->prepare($sql_verificar);
    $stmt->execute(['correo' => $correo]);
    
    if ($stmt->rowCount() > 0) {
        $error = "Este correo electrónico ya está registrado";
    } else {
        // Insertar cliente
        $sql_cliente = "INSERT INTO cliente (nombre, apellidos, telefono, correo, contrasena) 
                       VALUES (:nombre, :apellidos, :telefono, :correo, :contrasena)";
        
        $stmt = $conexion->prepare($sql_cliente);
        if ($stmt->execute([
            'nombre' => $nombre,
            'apellidos' => $apellidos,
            'telefono' => $telefono,
            'correo' => $correo,
            'contrasena' => $contrasena
        ])) {
            $id_cliente = $conexion->lastInsertId();
            
            // Crear registro de puntos
            $fecha_expiracion = date('Y-m-d', strtotime('+1 year'));
            $sql_puntos = "INSERT INTO clientes_puntos (id_cliente, Puntos_Acumulados, Puntos_Redimidos, Puntos_Expiracion) 
                          VALUES (:id_cliente, 0, 0, :fecha_expiracion)";
            
            $stmt = $conexion->prepare($sql_puntos);
            if ($stmt->execute([
                'id_cliente' => $id_cliente,
                'fecha_expiracion' => $fecha_expiracion
            ])) {
                $exito = "¡Registro exitoso! Ahora puedes iniciar sesión.";
            } else {
                $error = "Error al crear el registro de puntos: " . implode(" ", $stmt->errorInfo());
            }
        } else {
            $error = "Error al registrar: " . implode(" ", $stmt->errorInfo());
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Quinta Micaele</title>
    <style>
        :root {
            --primary-color: #884E40;
            --secondary-color: #734035;
            --background-color: #f8f5f3;
            --text-color: #333;
            --error-color: #d9534f;
            --success-color: #5cb85c;
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

        .register-container {
            background: white;
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            position: relative;
            overflow: hidden;
        }

        .register-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, transparent, rgba(136, 78, 64, 0.1));
            z-index: 0;
        }

        .register-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .register-header h1 {
            color: var(--primary-color);
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }

        .register-header p {
            color: var(--text-color);
            opacity: 0.8;
        }

        form {
            position: relative;
            z-index: 1;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-color);
            font-weight: 500;
        }

        input {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(136, 78, 64, 0.1);
        }

        button {
            width: 100%;
            padding: 0.8rem;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(136, 78, 64, 0.3);
        }

        .links {
            text-align: center;
            margin-top: 1.5rem;
        }

        .links a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .links a:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }

        .links p {
            color: var(--text-color);
            margin: 0.5rem 0;
            font-size: 0.9rem;
        }

        .input-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .input-row .form-group {
            margin-bottom: 0;
        }

        .error-message {
            color: var(--error-color);
            text-align: center;
            margin-bottom: 1rem;
            font-weight: 500;
        }

        .success-message {
            color: var(--success-color);
            text-align: center;
            margin-bottom: 1rem;
            font-weight: 500;
        }

        .benefits-box {
            background-color: #f8f5f3;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid var(--primary-color);
            margin-bottom: 1.5rem;
        }

        .benefits-box h3 {
            color: var(--primary-color);
            margin-bottom: 10px;
            font-size: 1.1rem;
        }

        .benefits-box ul {
            padding-left: 20px;
            font-size: 0.9rem;
        }

        .benefits-box li {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-header">
            <h1>Crear Cuenta</h1>
            <p>Regístrate para comenzar a disfrutar de nuestros servicios</p>
        </div>
        
        <?php if (!empty($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <?php if (!empty($exito)): ?>
            <div class="success-message"><?php echo $exito; ?></div>
            <div class="links">
                <a href="index.php">Iniciar Sesión</a>
                <a href="../../index.php">Volver al Inicio</a>
            </div>
        <?php else: ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" required>
                </div>
                <div class="form-group">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" name="apellidos" id="apellidos" required>
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="tel" name="telefono" id="telefono" required>
                </div>
                <div class="form-group">
                    <label for="correo">Correo Electrónico</label>
                    <input type="email" name="correo" id="correo" required>
                </div>
                <div class="form-group">
                    <label for="contraseña">Contraseña</label>
                    <input type="password" name="contraseña" id="contraseña" required minlength="6">
                </div>
                
                <button type="submit">Crear Cuenta</button>
                <div class="links">
                    <p>¿Ya tienes cuenta?</p>
                    <a href="index.php">Iniciar Sesión</a>
                    <br>
                    <a href="../../index.php">Volver al Inicio</a>
                </div>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
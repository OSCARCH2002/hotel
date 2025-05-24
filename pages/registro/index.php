<?php
session_start();
require '../../database/conexion.php';

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['usuario'];
    $contrasena = $_POST['contraseña'];

    // Buscar en la tabla cliente (usuarios normales)
    $sql = "SELECT c.id, c.nombre, c.apellidos, c.telefono, c.contrasena, cp.Puntos_Acumulados 
            FROM cliente c
            LEFT JOIN clientes_puntos cp ON c.id = cp.id_cliente
            WHERE c.correo = :correo";
    
    $stmt = $conexion->prepare($sql);
    $stmt->execute(['correo' => $correo]);
    
    if ($stmt->rowCount() > 0) {
        $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (password_verify($contrasena, $cliente['contrasena'])) {
            $_SESSION['id_cliente'] = $cliente['id'];
            $_SESSION['nombre'] = $cliente['nombre'];
            $_SESSION['apellidos'] = $cliente['apellidos'];
            $_SESSION['telefono'] = $cliente['telefono'];
            $_SESSION['puntos'] = $cliente['Puntos_Acumulados'] ?? 0;
            $_SESSION['tipo'] = 'cliente';
            
            header("Location: ./mis_puntos.php");
            exit();
        } else {
            $error = "Correo o contraseña incorrectos";
        }
    } else {
        // Buscar en la tabla usuarios (personal del hotel)
        $sql = "SELECT u.id, u.nombre, u.contrasena, u.id_rol, r.nombre as rol 
                FROM usuarios u
                JOIN rol r ON u.id_rol = r.id
                WHERE u.correo = :correo";
        
        $stmt = $conexion->prepare($sql);
        $stmt->execute(['correo' => $correo]);
        
        if ($stmt->rowCount() > 0) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (password_verify($contrasena, $usuario['contrasena'])) {
                $_SESSION['id_usuario'] = $usuario['id'];
                $_SESSION['nombre'] = $usuario['nombre'];
                $_SESSION['rol'] = $usuario['rol'];
                $_SESSION['tipo'] = 'empleado';
                
                header("Location: ../admin/dashboard.php");
                exit();
            } else {
                $error = "Correo o contraseña incorrectos";
            }
        } else {
            $error = "Correo o contraseña incorrectos";
        }
    }
}

include("../../temp/header.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Quinta Micaele</title>
    <style>
        :root {
            --primary-color: #884E40;
            --secondary-color: #734035;
            --background-color: #f8f5f3;
            --text-color: #333;
            --error-color: #d9534f;
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

        .login-container {
            background: white;
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            position: relative;
            overflow: hidden;
        }

        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, transparent, rgba(136, 78, 64, 0.1));
            z-index: 0;
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-header h1 {
            color: var(--primary-color);
            font-size: 2.2rem;
            margin-bottom: 0.5rem;
            font-weight: 700;
        }

        .login-header p {
            color: var(--text-color);
            opacity: 0.8;
            font-size: 1.1rem;
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
            margin-bottom: 0.6rem;
            color: var(--text-color);
            font-weight: 500;
            font-size: 0.95rem;
        }

        input {
            width: 100%;
            padding: 1rem;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(136, 78, 64, 0.1);
        }

        button {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 1.8rem;
            position: relative;
            overflow: hidden;
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(136, 78, 64, 0.3);
        }

        button:active {
            transform: translateY(1px);
        }

        .links {
            text-align: center;
            margin-top: 2rem;
        }

        .links p {
            color: var(--text-color);
            margin: 0.8rem 0;
            font-size: 1rem;
            line-height: 1.4;
        }

        .links a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            font-size: 1.05rem;
            display: inline-block;
            padding: 0.3rem 0.8rem;
            border-radius: 6px;
        }

        .links a:hover {
            color: var(--secondary-color);
            text-decoration: underline;
            background-color: rgba(136, 78, 64, 0.05);
        }

        .links a + a {
            margin-left: 1rem;
        }

        .error-message {
            color: var(--error-color);
            text-align: center;
            margin-bottom: 1rem;
            font-weight: 500;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 2rem;
            }

            .login-header h1 {
                font-size: 1.8rem;
            }

            .links a + a {
                margin-left: 0.8rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>Iniciar Sesión</h1>
            <p>Bienvenido a Quinta Micaele</p>
        </div>
        
        <?php if (!empty($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form action="" method="POST">
            <div class="form-group">
                <label for="usuario">Correo Electrónico</label>
                <input type="email" name="usuario" id="usuario" required>
            </div>
            <div class="form-group">
                <label for="contraseña">Contraseña</label>
                <input type="password" name="contraseña" id="contraseña" required>
            </div>
            <button type="submit">Iniciar Sesión</button>
            <div class="links">
                <p>¿No tienes cuenta? Regístrate y obtén puntos por tus reservaciones.</p>
                <a href="registro.php">Registrarse</a>
                <a href="../../index.php">Regresar al Inicio</a>
            </div>
        </form>
    </div>
</body>
</html>
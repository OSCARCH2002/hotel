<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CaféTec</title>
    <link rel="stylesheet" href="http://localhost/cafetec/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <header>
        <div class="container">
            <div class="header-left">
                <div class="logo-container">
                    <h1>CaféTec</h1>
                </div>
            </div>
            <div class="header-right">
                <?php if (isset($_SESSION['nombre']) && $_SERVER['REQUEST_URI'] !== '/cafetec/') { ?>
                    <p>Bienvenido, <?php echo $_SESSION['nombre']; ?></p>
                    <a href="http://localhost/cafetec/pages/usuario/confirmacion.php">Mis pedidos</a>
                    <a href="http://localhost/cafetec/pages/usuario/mostrar_carrito.php"><i class="fas fa-shopping-cart" style="color: white;"></i></a>
                    <a href="http://localhost/cafetec/">Cerrar sesión</a>
                <?php } ?>
            </div>
        </div>
    </header>
</body>

</html>
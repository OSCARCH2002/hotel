<?php
session_start();
require_once '../../database/conexion.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id_cliente'])) {
    header("Location: /hotel/pages/error/403.php");
    exit();
}

// Obtener todas las promociones de habitaciones
$sql = "SELECT ph.*, h.nombre as nombre_habitacion, h.precio_noche,
        CASE 
            WHEN ph.estado = 'activa' AND EXISTS (
                SELECT 1 FROM reservas r 
                WHERE r.id_habitacion = ph.id_habitacion 
                AND r.fecha_llegada BETWEEN ph.fecha_inicio AND ph.fecha_fin
            ) THEN 'agotada'
            ELSE ph.estado 
        END as estado_actual
        FROM promociones_habitaciones ph 
        JOIN habitacion h ON ph.id_habitacion = h.id 
        WHERE ph.estado = 'activa' 
        ORDER BY ph.fecha_inicio DESC";
$result = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promociones - Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #884E40;
            --primary-light: #a66b5d;
            --primary-dark: #6a3d32;
            --accent-color: #d4a373;
            --text-light: #f8f9fa;
            --text-dark: #2c3e50;
        }
        
        body {
            background-color: #f8f9fa;
        }
        .promo-section {
            padding: 60px 0;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }
        .section-title {
            color: var(--primary-color);
            margin-bottom: 40px;
            position: relative;
            padding-bottom: 15px;
        }
        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: var(--primary-color);
        }
        .promo-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(136, 78, 64, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            height: 100%;
            position: relative;
        }
        .promo-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 25px rgba(136, 78, 64, 0.2);
        }
        .promo-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: var(--text-light);
            padding: 20px;
            position: relative;
        }
        .discount-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: var(--accent-color);
            color: var(--text-light);
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        .promo-body {
            padding: 25px;
        }
        .price-section {
            margin: 20px 0;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
            text-align: center;
            border: 1px solid rgba(136, 78, 64, 0.1);
        }
        .original-price {
            text-decoration: line-through;
            color: #6c757d;
            font-size: 1.1rem;
        }
        .discounted-price {
            color: var(--primary-color);
            font-size: 1.5rem;
            font-weight: bold;
        }
        .promo-footer {
            padding: 20px;
            background: #f8f9fa;
            border-top: 1px solid rgba(136, 78, 64, 0.1);
        }
        .btn-aprovechar {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: var(--text-light);
            padding: 12px 30px;
            border-radius: 25px;
            border: none;
            font-weight: bold;
            transition: all 0.3s;
            width: 100%;
        }
        .btn-aprovechar:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(136, 78, 64, 0.3);
            color: var(--text-light);
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary-color) 100%);
        }
        .validity-badge {
            background: rgba(136, 78, 64, 0.1);
            padding: 5px 15px;
            border-radius: 15px;
            font-size: 0.9rem;
            color: var(--primary-color);
        }
        .features-list {
            list-style: none;
            padding: 0;
            margin: 15px 0;
        }
        .features-list li {
            padding: 8px 0;
            border-bottom: 1px solid rgba(136, 78, 64, 0.1);
        }
        .features-list li:last-child {
            border-bottom: none;
        }
        .features-list i {
            color: var(--primary-color);
            margin-right: 10px;
        }
        .alert-info {
            background-color: rgba(136, 78, 64, 0.1);
            border-color: var(--primary-color);
            color: var(--primary-color);
        }
    </style>
</head>
<body>
    <?php include("../../temp/header.php"); ?>

    <div class="promo-section">
        <div class="container">
            <h2 class="text-center section-title">Promociones Exclusivas</h2>
            <p class="text-center text-muted mb-5">Descubre nuestras mejores ofertas y disfruta de descuentos especiales en nuestras habitaciones</p>

            <div class="row">
                <?php if ($result && $result->rowCount() > 0): ?>
                    <?php while($promo = $result->fetch(PDO::FETCH_ASSOC)): 
                        $precio_original = $promo['precio_noche'];
                        $descuento = $promo['descuento'];
                        $precio_descuento = $precio_original * (1 - $descuento/100);
                    ?>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="promo-card">
                                <div class="promo-header">
                                    <h5 class="mb-0"><?php echo htmlspecialchars($promo['nombre_habitacion']); ?></h5>
                                    <div class="discount-badge">
                                        -<?php echo $descuento; ?>%
                                    </div>
                                </div>
                                <div class="promo-body">
                                    <p class="card-text"><?php echo htmlspecialchars($promo['descripcion']); ?></p>
                                    
                                    <div class="price-section">
                                        <div class="original-price">$<?php echo number_format($precio_original, 2); ?> /noche</div>
                                        <div class="discounted-price">$<?php echo number_format($precio_descuento, 2); ?> /noche</div>
                                    </div>

                                    <ul class="features-list">
                                        <li><i class="fas fa-check-circle"></i> Descuento aplicable por noche</li>
                                        <li><i class="fas fa-check-circle"></i> Reserva flexible</li>
                                        <li><i class="fas fa-check-circle"></i> Cancelación gratuita</li>
                                    </ul>
                                </div>
                                <div class="promo-footer">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="validity-badge">
                                            <i class="far fa-clock"></i> Válido hasta: <?php echo date('d/m/Y', strtotime($promo['fecha_fin'])); ?>
                                        </span>
                                        <span class="badge" style="background-color: <?php 
                                            echo $promo['estado_actual'] == 'agotada' ? '#ffc107' : 'var(--primary-color)'; ?>">
                                            <?php echo ucfirst($promo['estado_actual']); ?>
                                        </span>
                                    </div>
                                    <?php if ($promo['estado_actual'] == 'agotada'): ?>
                                        <button class="btn btn-aprovechar" disabled style="opacity: 0.7; cursor: not-allowed;">
                                            <i class="fas fa-times-circle me-2"></i>Promoción Agotada
                                        </button>
                                    <?php else: ?>
                                        <a href="../../pages/reservas/index.php?habitacion=<?php echo $promo['id_habitacion']; ?>&promocion=<?php echo $promo['id']; ?>&nombre=<?php echo urlencode($_SESSION['nombre'] ?? ''); ?>&apellidos=<?php echo urlencode($_SESSION['apellidos'] ?? ''); ?>&telefono=<?php echo urlencode($_SESSION['telefono'] ?? ''); ?>" class="btn btn-aprovechar">
                                            <i class="fas fa-gift me-2"></i>Aprovechar Oferta
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <i class="fas fa-info-circle me-2"></i>
                            No hay promociones activas en este momento.
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 
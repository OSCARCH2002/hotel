<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "567890";
$dbname = "propuesta";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $eventoId = $_GET['eventoId'] ?? 0;
    
    // Obtener datos del evento
    $stmt = $conn->prepare("
        SELECT e.*, c.nombre, c.apellidos, c.telefono 
        FROM evento e 
        JOIN cliente c ON e.id_cliente = c.id 
        WHERE e.id = :id
    ");
    $stmt->execute(['id' => $eventoId]);
    $evento = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if(!$evento) {
        die("Evento no encontrado");
    }
} catch(PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobante de Evento - Hotel Quinta Micaela</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --color-primary: #0f172a;
            --color-secondary: #f59e0b;
            --color-accent: #334155;
            --color-light: #e5e7eb;
            --color-white: #ffffff;
            --color-gray: #f3f4f6;
            --color-dark-gray: #6b7280;
        }
        
        body {
            font-family: 'Montserrat', sans-serif;
            line-height: 1.5;
            color: var(--color-primary);
            background-color: var(--color-gray);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            margin: 0;
        }
        
        .comprobante-container {
            max-width: 800px;
            width: 100%;
        }
        
        .comprobante {
            background: var(--color-white);
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .comprobante-header {
            background: linear-gradient(135deg, var(--color-primary), var(--color-accent));
            color: var(--color-white);
            padding: 20px;
            text-align: center;
            position: relative;
        }
        
        .comprobante-header::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--color-secondary);
        }
        
        .logo {
            max-width: 120px;
            height: auto;
            margin-bottom: 10px;
            filter: brightness(0) invert(1);
        }
        
        .comprobante-title {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 700;
            margin: 5px 0;
            color: var(--color-white);
        }
        
        .comprobante-subtitle {
            font-size: 14px;
            opacity: 0.9;
        }
        
        .comprobante-body {
            padding: 20px;
        }
        
        .info-section {
            margin-bottom: 20px;
        }
        
        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 18px;
            color: var(--color-secondary);
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px solid var(--color-light);
            display: flex;
            align-items: center;
        }
        
        .section-title i {
            margin-right: 8px;
            font-size: 20px;
        }
        
        .details-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin-top: 15px;
        }
        
        .detail-card {
            background: var(--color-gray);
            border-radius: 6px;
            padding: 12px;
            border-left: 3px solid var(--color-secondary);
        }
        
        .detail-label {
            font-size: 13px;
            color: var(--color-dark-gray);
            margin-bottom: 3px;
            font-weight: 600;
        }
        
        .detail-value {
            font-size: 15px;
            font-weight: 600;
            color: var(--color-primary);
        }
        
        .terms-list {
            list-style-type: none;
            padding: 0;
            margin: 10px 0 0;
        }
        
        .terms-list li {
            padding: 5px 0;
            position: relative;
            padding-left: 22px;
            font-size: 13px;
        }
        
        .terms-list li::before {
            content: "•";
            color: var(--color-secondary);
            font-size: 18px;
            position: absolute;
            left: 0;
            top: 3px;
        }
        
        .comprobante-footer {
            background: var(--color-primary);
            color: var(--color-white);
            padding: 15px;
            text-align: center;
            font-size: 12px;
        }
        
        .footer-text {
            margin: 3px 0;
            opacity: 0.8;
        }
        
        .footer-highlight {
            color: var(--color-secondary);
            font-weight: 600;
        }
        
        .download-btn {
            background: var(--color-secondary);
            color: var(--color-white);
            border: none;
            padding: 12px 25px;
            border-radius: 50px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 30px auto 0;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
        }
        
        .download-btn:hover {
            background: #e08e0a;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(245, 158, 11, 0.4);
        }
        
        .download-btn i {
            margin-right: 8px;
            font-size: 16px;
        }
        
        @media print {
            body {
                background: var(--color-white) !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                padding: 0;
            }
            
            .comprobante {
                box-shadow: none !important;
                border-radius: 0 !important;
            }
            
            .download-btn {
                display: none !important;
            }
            
            .comprobante-header {
                padding: 15px !important;
            }
            
            .comprobante-body {
                padding: 15px !important;
            }
        }
    </style>
</head>
<body>
    <div class="comprobante-container">
        <div class="comprobante" id="comprobante">
            <div class="comprobante-header">
                <img src="../../assets/images/logo.png" alt="Logo Hotel Quinta Micaela" class="logo" crossorigin="anonymous">
                <h1 class="comprobante-title">Comprobante de Reserva</h1>
                <p class="comprobante-subtitle">Eventos Exclusivos - <?php echo date('M Y'); ?></p>
            </div>
            
            <div class="comprobante-body">
                <div class="info-section">
                    <h2 class="section-title">
                        <i class="fas fa-user-circle"></i> Datos del Cliente
                    </h2>
                    <div class="details-grid">
                        <div class="detail-card">
                            <div class="detail-label">Nombre completo</div>
                            <div class="detail-value"><?php echo htmlspecialchars($evento['nombre'] . ' ' . $evento['apellidos']); ?></div>
                        </div>
                        <div class="detail-card">
                            <div class="detail-label">Teléfono de contacto</div>
                            <div class="detail-value"><?php echo htmlspecialchars($evento['telefono']); ?></div>
                        </div>
                    </div>
                </div>
                
                <div class="info-section">
                    <h2 class="section-title">
                        <i class="fas fa-calendar-alt"></i> Detalles del Evento
                    </h2>
                    <div class="details-grid">
                        <div class="detail-card">
                            <div class="detail-label">Número de reserva</div>
                            <div class="detail-value">EV-<?php echo str_pad($evento['id'], 5, '0', STR_PAD_LEFT); ?></div>
                        </div>
                        <div class="detail-card">
                            <div class="detail-label">Fecha del evento</div>
                            <div class="detail-value"><?php echo date('d/m/Y', strtotime($evento['fecha_evento'])); ?></div>
                        </div>
                        <div class="detail-card">
                            <div class="detail-label">Número de personas</div>
                            <div class="detail-value"><?php echo $evento['num_personas']; ?> invitados</div>
                        </div>
                    </div>
                </div>
                
                <div class="info-section">
                    <h2 class="section-title">
                        <i class="fas fa-file-contract"></i> Términos y Condiciones
                    </h2>
                    <ul class="terms-list">
                        <li>Presentar este comprobante el día del evento</li>
                    </ul>
                </div>
            </div>
            
            <div class="comprobante-footer">
                <p class="footer-text">Gracias por elegir <span class="footer-highlight">Hotel Quinta Micaela</span></p>
                <p class="footer-text"><i class="fas fa-phone-alt"></i> +52 741-113-6523 | <i class="fas fa-envelope"></i> QMicaela01@gmail.com</p>
                <p class="footer-text"><i class="fas fa-map-marker-alt"></i> Av. Principal #123, San Luis Acatlán</p>
            </div>
        </div>
        
        <button class="download-btn" id="btn-descargar">
            <i class="fas fa-download"></i> Descargar Comprobante
        </button>
    </div>
    
    <script>
        // Función optimizada para generar PDF
        async function generarPDF() {
            try {
                const element = document.getElementById('comprobante');
                
                // Mostrar carga
                const loading = Swal.fire({
                    title: 'Generando comprobante',
                    html: 'Preparando documento PDF...',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading(),
                    timer: 20000
                });
                
                // Configuración optimizada para 1-2 páginas
                const options = {
                    margin: [10, 10, 10, 10],
                    filename: `Comprobante_Evento_${<?php echo $evento['id']; ?>}.pdf`,
                    image: { 
                        type: 'jpeg', 
                        quality: 0.95 
                    },
                    html2canvas: { 
                        scale: 2,
                        useCORS: true,
                        letterRendering: true,
                        scrollX: 0,
                        scrollY: 0,
                        logging: false,
                        allowTaint: true
                    },
                    jsPDF: { 
                        unit: 'mm', 
                        format: 'a4',
                        orientation: 'portrait',
                        hotfixes: ["px_scaling"]
                    },
                    pagebreak: { 
                        mode: 'avoid-all',
                        before: '.page-break'
                    }
                };
                
                // Pequeño delay para asegurar carga de recursos
                await new Promise(resolve => setTimeout(resolve, 800));
                
                // Generar PDF
                const pdf = await html2pdf()
                    .set(options)
                    .from(element)
                    .toPdf()
                    .get('pdf');
                
                // Añadir metadatos
                pdf.setProperties({
                    title: `Comprobante Evento ${<?php echo $evento['id']; ?>}`,
                    subject: 'Reserva de Evento - Hotel Quinta Micaela',
                    author: 'Hotel Quinta Micaela',
                    keywords: 'evento, reserva, comprobante'
                });
                
                // Guardar PDF
                await pdf.save();
                
                // Cerrar loading
                loading.close();
                
                // Notificación de éxito
                Swal.fire({
                    icon: 'success',
                    title: 'PDF generado',
                    text: 'El comprobante se ha descargado correctamente',
                    confirmButtonColor: '#f59e0b'
                });
                
            } catch (error) {
                console.error("Error al generar PDF:", error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No se pudo generar el PDF. Por favor intente nuevamente.',
                    confirmButtonColor: '#f59e0b'
                });
            }
        }
        
        // Asignar evento al botón
        document.getElementById('btn-descargar').addEventListener('click', generarPDF);
        
        // Auto-descarga después de 1 segundo (opcional)
        window.addEventListener('load', function() {
            setTimeout(generarPDF, 1000);
        });
    </script>
</body>
</html>
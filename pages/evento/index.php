<?php
include("../../temp/header.php");

$servername = "localhost";
$username = "root";
$password = "567890";
$dbname = "propuesta";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$message = '';
$message_type = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $telefono = $_POST['telefono'];
    $fecha_evento = $_POST['fecha_evento'];
    $num_personas = $_POST['num_personas'];

    $stmt = $conn->prepare("SELECT id FROM cliente WHERE nombre = :nombre AND apellidos = :apellidos AND telefono = :telefono");
    $stmt->execute(['nombre' => $nombre, 'apellidos' => $apellidos, 'telefono' => $telefono]);
    $id_cliente = $stmt->fetchColumn();

    if (!$id_cliente) {
        $stmt = $conn->prepare("INSERT INTO cliente (nombre, apellidos, telefono) VALUES (:nombre, :apellidos, :telefono)");
        $stmt->execute(['nombre' => $nombre, 'apellidos' => $apellidos, 'telefono' => $telefono]);
        $id_cliente = $conn->lastInsertId();
    }

    $stmt = $conn->prepare("SELECT COUNT(*) FROM evento WHERE fecha_evento = :fecha_evento");
    $stmt->execute(['fecha_evento' => $fecha_evento]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        $message = "Lo siento, ya hay un evento programado para esta fecha.";
        $message_type = 'error';
    } else {
        $stmt = $conn->prepare("INSERT INTO evento (id_cliente, fecha_evento, num_personas) VALUES (:id_cliente, :fecha_evento, :num_personas)");

        try {
            $stmt->execute([
                'id_cliente' => $id_cliente,
                'fecha_evento' => $fecha_evento,
                'num_personas' => $num_personas,
            ]);
            
            $eventoId = $conn->lastInsertId();
            $message = "Evento registrado con éxito. ID: $eventoId";
            $message_type = 'success';
            
            echo "<script>
                window.open('comprobante_evento.php?eventoId=$eventoId', '_blank');
            </script>";

        } catch (PDOException $e) {
            $message = "Error al realizar el evento: " . $e->getMessage();
            $message_type = 'error';
        }
    }

    $conn = null;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos Exclusivos | Hotel Quinta Micaela</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;700&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: '#884E40',
                            600: '#734035',
                            700: '#5f342b',
                            800: '#4c2921',
                            900: '#3a1f19'
                        },
                        light: '#F8F5F3',
                        cream: '#F0EAE6',
                        sand: '#D7C4BC'
                    },
                    fontFamily: {
                        playfair: ['Playfair Display', 'serif'],
                        montserrat: ['Montserrat', 'sans-serif'],
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.5s ease-out',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(20px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                    }
                }
            }
        }
    </script>
    <style>
        .event-card {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(136, 78, 64, 0.15);
        }
        .gallery-image {
            transition: all 0.3s ease;
        }
        .gallery-image:hover {
            transform: scale(1.03);
        }
        .input-focus:focus {
            border-color: #884E40;
            box-shadow: 0 0 0 3px rgba(136, 78, 64, 0.2);
        }
        .date-input::after {
            content: '\f073';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #734035;
            pointer-events: none;
        }
        .btn-primary {
            background: #884E40;
            color: white;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background: #734035;
            transform: translateY(-2px);
        }
    </style>
</head>

<body class="font-montserrat bg-light text-primary-800">
    <!-- Hero Section -->
    <section class="relative py-20 bg-primary-800" style="clip-path: polygon(0 0, 100% 0, 100% 80%, 0 100%);">
    <div class="absolute inset-0 bg-gradient-to-r from-primary-900/80 to-primary-700/80"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-playfair font-bold mb-4 text-white animate-fade-in">Eventos Exclusivos</h1>
            <p class="text-xl text-white max-w-3xl mx-auto animate-fade-in animation-delay-100">
                Celebre sus momentos especiales en un entorno de lujo y elegancia
            </p>
        </div>
    </div>
</section>
    <!-- Event Form Section -->
    <section class="py-16 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
            <!-- Formulario -->
            <div class="bg-white rounded-xl p-8 shadow-lg animate-fade-in border border-primary-200">
                <h2 class="text-3xl font-playfair font-bold mb-6 text-primary-700 border-b border-primary-500 pb-2 inline-block">Reservar Evento</h2>
                
                <?php if ($message): ?>
                    <div class="mb-6 p-4 rounded-lg <?php echo $message_type === 'success' ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-red-100 text-red-800 border border-red-200'; ?>">
                        <?php echo $message; ?>
                    </div>
                <?php endif; ?>
                
                <form id="eventForm" method="POST" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nombre" class="block text-primary-600 mb-2">Nombre</label>
                            <input type="text" id="nombre" name="nombre" pattern="[A-Za-zÀ-ÿ\s]+" title="Solo se permiten letras y espacios" class="w-full bg-light border border-primary-200 rounded-lg px-4 py-3 text-primary-800 focus:outline-none focus:ring-2 focus:ring-primary-500 input-focus" required>
                        </div>
                        <div>
                            <label for="apellidos" class="block text-primary-600 mb-2">Apellidos</label>
                            <input type="text" id="apellidos" name="apellidos" pattern="[A-Za-zÀ-ÿ\s]+" title="Solo se permiten letras y espacios" class="w-full bg-light border border-primary-200 rounded-lg px-4 py-3 text-primary-800 focus:outline-none focus:ring-2 focus:ring-primary-500 input-focus" required>
                        </div>
                    </div>

                    <div>
                        <label for="telefono" class="block text-primary-600 mb-2">Teléfono</label>
                        <input type="tel" id="telefono" name="telefono" placeholder="Ingrese su número de Teléfono" required pattern="\d{10}" maxlength="10" minlength="10" title="El número de teléfono debe contener exactamente 10 dígitos" class="w-full bg-light border border-primary-200 rounded-lg px-4 py-3 text-primary-800 focus:outline-none focus:ring-2 focus:ring-primary-500 input-focus">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="date-input">
                            <label for="fecha_evento" class="block text-primary-600 mb-2">Fecha del Evento</label>
                            <input type="date" id="fecha_evento" name="fecha_evento" class="w-full bg-light border border-primary-200 rounded-lg px-4 py-3 text-primary-800 focus:outline-none focus:ring-2 focus:ring-primary-500 input-focus" required>
                        </div>
                        <div>
                            <label for="num_personas" class="block text-primary-600 mb-2">Número de Personas</label>
                            <input type="number" id="num_personas" name="num_personas" min="1" max="200" class="w-full bg-light border border-primary-200 rounded-lg px-4 py-3 text-primary-800 focus:outline-none focus:ring-2 focus:ring-primary-500 input-focus" required>
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full btn-primary font-bold py-3 px-6 rounded-lg flex items-center justify-center">
                            <i class="fas fa-calendar-check mr-2"></i> Reservar Evento
                        </button>
                    </div>
                </form>
            </div>

            <!-- Gallery & Info -->
            <div class="animate-fade-in animation-delay-100">
                <div class="grid grid-cols-2 gap-4 mb-8">
                    <div class="rounded-lg overflow-hidden h-48">
                        <img src="../../assets/images/evento1.jpeg" alt="Evento 1" class="w-full h-full object-cover gallery-image">
                    </div>
                    <div class="rounded-lg overflow-hidden h-48">
                        <img src="../../assets/images/evento2.jpeg" alt="Evento 2" class="w-full h-full object-cover gallery-image">
                    </div>
                    <div class="rounded-lg overflow-hidden h-48">
                        <img src="../../assets/images/evento3.jpeg" alt="Evento 3" class="w-full h-full object-cover gallery-image">
                    </div>
                    <div class="rounded-lg overflow-hidden h-48 relative">
                        <img src="../../assets/images/EventoXD.jpeg" alt="Evento 4" class="w-full h-full object-cover">
                        <button onclick="openGalleryModal()" class="absolute inset-0 bg-black/30 flex items-center justify-center text-white text-lg font-bold transition-all duration-300 hover:bg-black/50">
                            <span class="flex items-center">
                                <i class="fas fa-images mr-2"></i> Ver más
                            </span>
                        </button>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-6 border border-primary-200">
                    <h3 class="text-xl font-playfair font-bold mb-4 text-primary-700 border-b border-primary-500 pb-2 inline-block">Nuestros Servicios para Eventos</h3>
                    <ul class="space-y-4 text-primary-600">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-primary-500 mr-3 mt-1"></i>
                            <span>Capacidad para hasta 200 personas</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-primary-500 mr-3 mt-1"></i>
                            <span>Amplio espacio</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-primary-500 mr-3 mt-1"></i>
                            <span>Atención profesional</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-primary-500 mr-3 mt-1"></i>
                            <span>Coordinador de eventos dedicado</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Modal -->
    <div id="galleryModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" onclick="closeGalleryModal()">
                <div class="absolute inset-0 bg-primary-900 opacity-90"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-2xl font-playfair font-bold text-primary-700">Galería de Eventos</h3>
                        <button onclick="closeGalleryModal()" class="text-primary-600 hover:text-primary-800">
                            <i class="fas fa-times text-2xl"></i>
                        </button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <img src="../../assets/images/evento1.jpeg" alt="Evento 1" class="rounded-lg w-full h-64 object-cover">
                        <img src="../../assets/images/evento2.jpeg" alt="Evento 2" class="rounded-lg w-full h-64 object-cover">
                        <img src="../../assets/images/evento3.jpeg" alt="Evento 3" class="rounded-lg w-full h-64 object-cover">
                        <img src="../../assets/images/eventoXD.jpeg" alt="Evento 4" class="rounded-lg w-full h-64 object-cover">
                        <img src="../../assets/images/fondo.jpeg" alt="fondo" class="rounded-lg w-full h-64 object-cover">
                        <img src="../../assets/images/banner.jpg" alt="banner" class="rounded-lg w-full h-64 object-cover">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Modal functions
        function openGalleryModal() {
            document.getElementById('galleryModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeGalleryModal() {
            document.getElementById('galleryModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Form validation and date restriction
        document.addEventListener("DOMContentLoaded", function() {
            const fechaEventoInput = document.getElementById('fecha_evento');
            const today = new Date().toISOString().split('T')[0];
            fechaEventoInput.setAttribute('min', today);

            const message = "<?php echo $message; ?>";
            const messageType = "<?php echo $message_type; ?>";
            
            if (message) {
                Swal.fire({
                    icon: messageType,
                    title: messageType === 'success' ? '¡Reserva Exitosa!' : 'Error',
                    html: `<div class="text-left">
                        <p class="mb-4">${message}</p>
                        ${messageType === 'success' ? '<p class="text-sm text-gray-500">Se ha generado automáticamente su comprobante en PDF.</p>' : ''}
                    </div>`,
                    confirmButtonColor: '#884E40',
                    confirmButtonText: 'Entendido'
                });
            }

            const form = document.getElementById('eventForm');
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Validar fecha
                const fechaEvento = new Date(document.getElementById('fecha_evento').value);
                const today = new Date();
                today.setHours(0, 0, 0, 0);

                if (fechaEvento < today) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Fecha Inválida',
                        text: 'La fecha del evento no puede ser anterior al día de hoy.',
                        confirmButtonColor: '#884E40'
                    });
                    return;
                }

                Swal.fire({
                    title: 'Confirmar Reserva',
                    html: `<div class="text-left">
                        <p class="mb-2">¿Desea confirmar la reserva del evento con los siguientes datos?</p>
                        <ul class="list-disc pl-5 mb-4">
                            <li>Fecha: ${document.getElementById('fecha_evento').value}</li>
                            <li>Personas: ${document.getElementById('num_personas').value}</li>
                        </ul>
                        <p class="text-sm text-gray-500">Se generará un comprobante en PDF automáticamente.</p>
                    </div>`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#884E40',
                    cancelButtonColor: '#64748b',
                    confirmButtonText: 'Sí, confirmar',
                    cancelButtonText: 'Revisar datos'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</body>

<?php include "../../temp/footer.php"; ?>
</html>
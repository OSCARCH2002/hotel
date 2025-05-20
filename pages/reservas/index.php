<?php
include("../../temp/header.php");
echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "567890";
$dbname = "propuesta";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roomNumber = intval($_POST['roomNumber']);
    $nombre = $conn->real_escape_string(trim($_POST['nombre']));
    $apellidos = $conn->real_escape_string(trim($_POST['apellidos']));
    $telefono = $conn->real_escape_string(trim($_POST['telefono']));
    $fechaLlegada = $conn->real_escape_string(trim($_POST['fechaLlegada']));
    $fechaSalida = $conn->real_escape_string(trim($_POST['fechaSalida']));
    $totalAdultos = intval($_POST['totalAdultos']);
    $totalNinos = intval($_POST['totalNinos']);
    $totalPagar = $conn->real_escape_string(trim($_POST['totalPagar']));

    $fecha1 = new DateTime($fechaLlegada);
    $fecha2 = new DateTime($fechaSalida);
    $diferencia = $fecha2->diff($fecha1);
    $noches = $diferencia->days;

    $stmt = $conn->prepare("
        SELECT id FROM reservas
        WHERE id_habitacion = ? AND (fecha_llegada <= ? AND fecha_salida >= ?)
    ");
    $stmt->bind_param("iss", $roomNumber, $fechaSalida, $fechaLlegada);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'La habitación está ocupada en las fechas seleccionadas.'
            });
        </script>";
    } else {
        $stmt = $conn->prepare("INSERT INTO cliente (nombre, apellidos, telefono) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nombre, $apellidos, $telefono);

        if ($stmt->execute()) {
            $clienteId = $stmt->insert_id; 

            $total = $noches * 300; 

            if ($noches > 30) {
                $total = 1800; 
            }

            if ($totalAdultos > 2) {
                $adultosExtras = $totalAdultos - 2;
                $total += $adultosExtras * 50;
            }

            $stmt = $conn->prepare("INSERT INTO reservas (id_cliente, id_habitacion, fecha_llegada, fecha_salida, total_adultos, total_ninos, total_pagar)
                                    VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iissddd", $clienteId, $roomNumber, $fechaLlegada, $fechaSalida, $totalAdultos, $totalNinos, $total);

            if ($stmt->execute()) {
                $reservaId = $stmt->insert_id; 
                echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Reserva exitosa',
                        html: '<div class=\"text-center\"><svg class=\"w-16 h-16 mx-auto text-green-500\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\" xmlns=\"http://www.w3.org/2000/svg\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M5 13l4 4L19 7\"></path></svg><h3 class=\"text-xl font-bold text-gray-900 mb-2\">¡Reserva confirmada!</h3><p class=\"text-gray-600\">Tu reserva #$reservaId ha sido registrada con éxito.</p></div>',
                        showConfirmButton: true,
                        confirmButtonText: 'Ver comprobante',
                        confirmButtonColor: '#884E40',
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.open('../../libs/generate_pdf.php?reservaId=$reservaId', '_blank');
                        }
                        window.location.href = '../../pages/reservas';
                    });
                </script>";
            } else {
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error al realizar la reserva: " . $stmt->error . "'
                    });
                </script>";
            }
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al registrar el cliente: " . $stmt->error . "'
                });
            </script>";
        }
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas | Hotel Quinta Micaela</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
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
        .amenity-icon {
            transition: all 0.3s ease;
        }
        .amenity-icon:hover {
            transform: scale(1.1);
            color: #884E40;
        }
        .room-card {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .room-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
        }
        .input-focus:focus {
            border-color: #884E40;
            box-shadow: 0 0 0 3px rgba(136, 78, 64, 0.2);
        }
        .date-input {
            position: relative;
        }
        .date-input::after {
            content: '\f073';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #a87a6c;
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
    <section class="relative py-20 bg-[#704C43] text-white" style="clip-path: polygon(0 0, 100% 0, 100% 80%, 0 100%);">
    <div class="absolute inset-0 bg-primary-900 opacity-70"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-playfair font-bold mb-4 animate-fade-in">Reserva hoy mismo</h1>
            <p class="text-xl text-primary-100 max-w-3xl mx-auto animate-fade-in animation-delay-100">
                Descubre el confort exclusivo de nuestras habitaciones diseñadas para tu máximo relax
            </p>
        </div>
    </div>
</section>
    <!-- Room Showcase -->
    <section class="py-16 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Image Gallery -->
            <div class="animate-fade-in">
                <div class="grid grid-cols-2 gap-4">
                    <div class="rounded-lg overflow-hidden h-64 shadow-lg">
                        <img src="../../assets/images/renta.jpeg" alt="Habitación" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                    </div>
                    <div class="rounded-lg overflow-hidden h-64 shadow-lg">
                        <img src="../../assets/images/lavado.jpg" alt="Baño" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                    </div>
                    <div class="rounded-lg overflow-hidden h-64 shadow-lg">
                        <img src="../../assets/images/Cuarto_Camas_Individual.jpeg" alt="Camas" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                    </div>
                    <div class="rounded-lg overflow-hidden h-64 shadow-lg relative">
                        <img src="../../assets/images/Interio_Cuarto.jpeg" alt="Interior" class="w-full h-full object-cover">
                        <button onclick="openGalleryModal()" class="absolute inset-0 bg-black/30 flex items-center justify-center text-white text-lg font-bold transition-all duration-300 hover:bg-black/50">
                            <span class="flex items-center">
                                <i class="fas fa-images mr-2"></i> Ver más fotos
                            </span>
                        </button>
                    </div>
                </div>

                <!-- Amenities Carousel -->
                <div class="mt-10 bg-white rounded-xl p-6 shadow-lg">
                    <h3 class="text-xl font-playfair font-bold mb-6 text-primary-700 border-b border-primary-500 pb-2 inline-block">Amenidades</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                        <div class="flex flex-col items-center text-center">
                            <i class="fas fa-wifi text-3xl text-primary-600 mb-2 amenity-icon"></i>
                            <span class="text-primary-600">WiFi Gratis</span>
                        </div>
                        <div class="flex flex-col items-center text-center">
                            <i class="fas fa-tv text-3xl text-primary-600 mb-2 amenity-icon"></i>
                            <span class="text-primary-600">TV por Cable</span>
                        </div>
                        <div class="flex flex-col items-center text-center">
                            <i class="fas fa-parking text-3xl text-primary-600 mb-2 amenity-icon"></i>
                            <span class="text-primary-600">Estacionamiento</span>
                        </div>
                        <div class="flex flex-col items-center text-center">
                            <i class="fas fa-thermometer-three-quarters text-3xl text-primary-600 mb-2 amenity-icon"></i>
                            <span class="text-primary-600">Aire Acondicionado</span>
                        </div>
                        <div class="flex flex-col items-center text-center">
                            <i class="fas fa-shower text-3xl text-primary-600 mb-2 amenity-icon"></i>
                            <span class="text-primary-600">Agua Caliente</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Room Info -->
            <div class="animate-fade-in animation-delay-100">
                <h2 class="text-3xl font-playfair font-bold mb-4 text-primary-700">Nuestros precios</h2>
                <p class="text-primary-600 mb-6 leading-relaxed">
                    Disfruta de la mejor experiencia en el hotel Quinta Micaela durante tu estancia en San Luis Acatlán. Somos tu mejor opción, ya que ofrecemos precios accesibles y competitivos. Tú decides cómo deseas descansar.
                </p>

                <div class="bg-white rounded-xl p-6 mb-8 shadow-lg">
                    <h3 class="text-xl font-playfair font-bold mb-4 text-primary-700 border-b border-primary-500 pb-2 inline-block">Tarifas Exclusivas</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-primary-100 rounded-lg p-4 room-card">
                            <h4 class="font-bold text-primary-700 mb-2">Por Noche</h4>
                            <p class="text-2xl font-bold text-primary-800 mb-2">$300 <span class="text-sm text-primary-600">MXN</span></p>
                            <p class="text-primary-600 text-sm">Ideal para estancias cortas</p>
                        </div>
                        <div class="bg-primary-100 rounded-lg p-4 room-card">
                            <h4 class="font-bold text-primary-700 mb-2">Renta Mensual</h4>
                            <p class="text-2xl font-bold text-primary-800 mb-2">$1,800 <span class="text-sm text-primary-600">MXN</span></p>
                            <p class="text-primary-600 text-sm">Ahorra hasta un 40%</p>
                        </div>
                    </div>
                </div>

                <button onclick="openReservationModal()" class="w-full btn-primary font-bold py-3 px-6 rounded-lg transition-all duration-300 transform hover:-translate-y-1 flex items-center justify-center shadow-lg">
                    <i class="fas fa-calendar-check mr-2"></i> Reservar Ahora
                </button>

                <div class="mt-8 bg-white rounded-xl p-6 shadow-lg">
                    <h3 class="text-xl font-playfair font-bold mb-4 text-primary-700 border-b border-primary-500 pb-2 inline-block"></h3>
                    <ul class="space-y-3 text-primary-600">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-primary-500 mr-2 mt-1"></i>
                            <span>Se cobrará una comisión de 50 pesos por cada adulto adicional después de 2 personas</span>      
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-primary-500 mr-2 mt-1"></i>
                            <span>Máximo 2 adultos + 2 niños por habitación</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-primary-500 mr-2 mt-1"></i>
                            <span>Cancelaciones con 48 hrs de anticipación</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Image Gallery Modal -->
    <div id="galleryModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" onclick="closeGalleryModal()">
                <div class="absolute inset-0 bg-primary-900 opacity-90"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-2xl font-playfair font-bold text-primary-700">Galería de Habitaciones</h3>
                        <button onclick="closeGalleryModal()" class="text-primary-600 hover:text-primary-800">
                            <i class="fas fa-times text-2xl"></i>
                        </button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <img src="../../assets/images/renta.jpeg" alt="Habitación 1" class="rounded-lg w-full h-64 object-cover shadow">
                        <img src="../../assets/images/Cuarto_Camas_Individual.jpeg" alt="Habitación 2" class="rounded-lg w-full h-64 object-cover shadow">
                        <img src="../../assets/images/huesped.jpeg" alt="Habitación 3" class="rounded-lg w-full h-64 object-cover shadow">
                        <img src="../../assets/images/Servicios_Cuarto.jpeg" alt="Habitación 4" class="rounded-lg w-full h-64 object-cover shadow">
                        <img src="../../assets/images/Interio_Cuarto.jpeg" alt="Habitación 5" class="rounded-lg w-full h-64 object-cover shadow">
                        <img src="../../assets/images/lavado.jpg" alt="Habitación 6" class="rounded-lg w-full h-64 object-cover shadow">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reservation Modal -->
    <div id="reservationModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" onclick="closeReservationModal()">
                <div class="absolute inset-0 bg-primary-900 opacity-90"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                <div class="px-6 py-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-playfair font-bold text-primary-700">Formulario de Reserva</h3>
                        <button onclick="closeReservationModal()" class="text-primary-600 hover:text-primary-800">
                            <i class="fas fa-times text-2xl"></i>
                        </button>
                    </div>
                    <form id="reservationForm" method="POST" class="space-y-6">
                        <div>
                            <label for="roomNumber" class="block text-primary-600 mb-2">Número de Habitación</label>
                            <select id="roomNumber" name="roomNumber" class="w-full bg-primary-50 border border-primary-200 rounded-lg px-4 py-3 text-primary-800 focus:outline-none focus:ring-2 focus:ring-primary-500 input-focus" required>
                                <option value="" disabled selected>Seleccione una habitación</option>
                                <?php for ($i = 1; $i <= 7; $i++): ?>
                                    <option value="<?php echo $i; ?>">Habitación <?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="nombre" class="block text-primary-600 mb-2">Nombre</label>
                                <input type="text" id="nombre" name="nombre" pattern="[A-Za-zÀ-ÿ\s]+" title="Solo se permiten letras y espacios" class="w-full bg-primary-50 border border-primary-200 rounded-lg px-4 py-3 text-primary-800 focus:outline-none focus:ring-2 focus:ring-primary-500 input-focus" required>
                            </div>
                            <div>
                                <label for="apellidos" class="block text-primary-600 mb-2">Apellidos</label>
                                <input type="text" id="apellidos" name="apellidos" pattern="[A-Za-zÀ-ÿ\s]+" title="Solo se permiten letras y espacios" class="w-full bg-primary-50 border border-primary-200 rounded-lg px-4 py-3 text-primary-800 focus:outline-none focus:ring-2 focus:ring-primary-500 input-focus" required>
                            </div>
                        </div>

                        <div>
                            <label for="telefono" class="block text-primary-600 mb-2">Teléfono</label>
                            <input type="text" id="telefono" name="telefono" maxlength="10" pattern="\d{10}" title="Debe contener exactamente 10 dígitos" oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="w-full bg-primary-50 border border-primary-200 rounded-lg px-4 py-3 text-primary-800 focus:outline-none focus:ring-2 focus:ring-primary-500 input-focus" required>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="date-input">
                                <label for="fechaLlegada" class="block text-primary-600 mb-2">Fecha de Llegada</label>
                                <input type="date" id="fechaLlegada" name="fechaLlegada" class="w-full bg-primary-50 border border-primary-200 rounded-lg px-4 py-3 text-primary-800 focus:outline-none focus:ring-2 focus:ring-primary-500 input-focus" required>
                            </div>
                            <div class="date-input">
                                <label for="fechaSalida" class="block text-primary-600 mb-2">Fecha de Salida</label>
                                <input type="date" id="fechaSalida" name="fechaSalida" class="w-full bg-primary-50 border border-primary-200 rounded-lg px-4 py-3 text-primary-800 focus:outline-none focus:ring-2 focus:ring-primary-500 input-focus" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="totalAdultos" class="block text-primary-600 mb-2">Número de Adultos</label>
                                <input type="number" id="totalAdultos" name="totalAdultos" min="1" class="w-full bg-primary-50 border border-primary-200 rounded-lg px-4 py-3 text-primary-800 focus:outline-none focus:ring-2 focus:ring-primary-500 input-focus" required>
                            </div>
                            <div>
                                <label for="totalNinos" class="block text-primary-600 mb-2">Número de Niños</label>
                                <input type="number" id="totalNinos" name="totalNinos" min="0" max="2" class="w-full bg-primary-50 border border-primary-200 rounded-lg px-4 py-3 text-primary-800 focus:outline-none focus:ring-2 focus:ring-primary-500 input-focus" required>
                            </div>
                        </div>

                        <div>
                            <label for="totalPagar" class="block text-primary-600 mb-2">Total a Pagar</label>
                            <input type="text" id="totalPagar" name="totalPagar" readonly class="w-full bg-primary-50 border border-primary-500 rounded-lg px-4 py-3 text-primary-700 font-bold focus:outline-none">
                        </div>

                        <div class="pt-4">
                            <button type="submit" class="w-full btn-primary font-bold py-3 px-6 rounded-lg transition-all duration-300 shadow-lg">
                                Confirmar Reserva
                            </button>
                        </div>
                    </form>
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

        function openReservationModal() {
            document.getElementById('reservationModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            // Set minimum date for arrival
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('fechaLlegada').setAttribute('min', today);
        }

        function closeReservationModal() {
            document.getElementById('reservationModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Price calculation
        document.addEventListener('DOMContentLoaded', function() {
            const totalPagarInput = document.getElementById('totalPagar');
            const totalAdultosInput = document.getElementById('totalAdultos');
            const fechaLlegadaInput = document.getElementById('fechaLlegada');
            const fechaSalidaInput = document.getElementById('fechaSalida');

            const precioPorNoche = 300;
            const precioRenta = 1800;
            const comisionPorAdultoExtra = 50;

            function calcularTotal() {
                const totalAdultos = parseInt(totalAdultosInput.value) || 0;
                const fechaLlegada = new Date(fechaLlegadaInput.value);
                const fechaSalida = new Date(fechaSalidaInput.value);

                if (fechaLlegada && fechaSalida && fechaSalida > fechaLlegada) {
                    const noches = Math.ceil((fechaSalida - fechaLlegada) / (1000 * 60 * 60 * 24));
                    let total = noches * precioPorNoche;

                    if (noches > 30) {
                        total = precioRenta;
                    }

                    if (totalAdultos > 2) {
                        const adultosExtras = totalAdultos - 2;
                        const comision = adultosExtras * comisionPorAdultoExtra;
                        total += comision;

                        Swal.fire({
                            icon: 'info',
                            title: 'Comisión por Adultos Extras',
                            html: `<div class="text-left">
                                <p class="mb-2">Se aplicará un cargo adicional por ${adultosExtras} adulto(s) extra:</p>
                                <ul class="list-disc pl-5 mb-3">
                                    <li>$${comisionPorAdultoExtra} MXN por adulto adicional</li>
                                    <li>Total comisión: $${comision} MXN</li>
                                </ul>
                                <p class="text-sm text-gray-500">El máximo permitido por habitación es 2 adultos + 2 niños</p>
                            </div>`,
                            confirmButtonColor: '#884E40',
                            confirmButtonText: 'Entendido'
                        });
                    }

                    totalPagarInput.value = `$${total.toFixed(2)} MXN`;
                }
            }

            // Event listeners
            totalAdultosInput.addEventListener('input', calcularTotal);
            fechaLlegadaInput.addEventListener('change', function() {
                const today = new Date().toISOString().split('T')[0];
                if (this.value < today) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Fecha Inválida',
                        text: 'La fecha de llegada no puede ser anterior al día de hoy.',
                        confirmButtonColor: '#884E40'
                    });
                    this.value = '';
                }
                fechaSalidaInput.setAttribute('min', this.value);
                calcularTotal();
            });

            fechaSalidaInput.addEventListener('change', function() {
                if (this.value <= fechaLlegadaInput.value) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Fecha Inválida',
                        text: 'La fecha de salida debe ser posterior a la fecha de llegada.',
                        confirmButtonColor: '#884E40'
                    });
                    this.value = '';
                }
                calcularTotal();
            });

            // Initialize date inputs
            const today = new Date().toISOString().split('T')[0];
            fechaLlegadaInput.setAttribute('min', today);
        });
    </script>
</body>

<?php include "../../temp/footer.php"; ?>
</html>
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
    $fecha_evento = $_POST['fecha-evento'];
    $num_personas = $_POST['num-personas'];

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
                'num_personas' => $num_personas
            ]);
            $message = "Evento realizado con éxito.";
            $message_type = 'success';
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
    <title>Eventos - Hotel Micaela</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="../../assets/css/style_evento.css">
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const fechaEventoInput = document.getElementById('fecha-evento');
            const today = new Date().toISOString().split('T')[0];
            fechaEventoInput.setAttribute('min', today);

            const message = "<?php echo $message; ?>";
            const messageType = "<?php echo $message_type; ?>";
            if (message) {
                Swal.fire({
                    icon: messageType,
                    title: messageType === 'success' ? 'Éxito' : 'Error',
                    text: message,
                    confirmButtonText: 'Aceptar',
                });
            }

            const form = document.querySelector('.formulario');
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: '¿Confirmar envío?',
                    text: 'Por favor revisa que todos los datos estén correctos.',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, enviar',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</head>

<body>
    <div class="container">
        <br>
        <h1 class="section-title">Reservar evento</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="contenido">
                    <form method="post" class="formulario">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese su Nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="apellidos">Apellidos:</label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Ingrese sus Apellidos" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono:</label>
                            <input type="tel"
                                class="form-control"
                                id="telefono"
                                name="telefono"
                                placeholder="Ingrese su número de Teléfono"
                                required
                                pattern="\d{10}"
                                maxlength="10"
                                minlength="10"
                                title="El número de teléfono debe contener exactamente 10 dígitos.">
                        </div>

                        <div class="form-group">
                            <label for="fecha-evento">Fecha de evento:</label>
                            <input type="date" class="form-control" id="fecha-evento" name="fecha-evento" required>
                        </div>
                        <div class="form-group">
                            <label for="num-personas">Número de personas:</label>
                            <input type="number" class="form-control" id="num-personas" name="num-personas" min="1" max="200" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br>
        <!-- Sección de Fotos -->
        <div class="photo-section">
            <div class="row">
                <div class="col-md-4">
                    <div class="gallery">
                        <img src="../../assets/images/evento1.jpeg" alt="Foto 1">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="gallery">
                        <img src="../../assets/images/evento2.jpeg" alt="Foto 2">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="gallery">
                        <img src="../../assets/images/evento3.jpeg" alt="Foto 3">
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección Informativa -->
        <div class="info-section">
            <h2 class="section-title">¿Por qué elegirnos?</h2>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="info-card">
                        <h4>Servicio de alta calidad</h4>
                        <p>Nuestro personal altamente capacitado se encargará de que su evento sea todo un éxito.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-card">
                        <h4>Ubicación conveniente</h4>
                        <p>Estamos ubicados en el corazón de la ciudad, cerca de los principales lugares de interés.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-card">
                        <h4>Instalaciones</h4>
                        <p>Nuestra sala de eventos está ampliamente cómoda para satisfacer todas sus necesidades.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-card">
                        <h4>Precios competitivos</h4>
                        <p>Ofrecemos tarifas competitivas para que pueda disfrutar de un evento excepcional sin comprometer su presupuesto.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>


<?php include "../../temp/footer.php"; ?>

</html>
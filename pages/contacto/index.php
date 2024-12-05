<?php include("../../temp/header.php"); ?>
<?php
$host = "localhost";
$dbname = "propuesta";
$username = "root"; 
$password = "567890";

$messageSent = false;
$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
$correo = isset($_POST['correo']) ? htmlspecialchars($_POST['correo']) : '';
$asunto = isset($_POST['asunto']) ? htmlspecialchars($_POST['asunto']) : '';
$mensaje = isset($_POST['mensaje']) ? htmlspecialchars($_POST['mensaje']) : '';

if (empty($name) || empty($correo) || empty($asunto) || empty($mensaje)) {
    $errorMessage = "Todos los campos son obligatorios.";
} else {
    $sql = "INSERT INTO contacto (name, correo, asuto, mensaje) VALUES (:name, :correo, :asunto, :mensaje)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':correo', $correo);
    $stmt->bindParam(':asunto', $asunto);
    $stmt->bindParam(':mensaje', $mensaje);
    $stmt->execute();

    $messageSent = true;
}

    } catch (PDOException $e) {
        $errorMessage = "Error en la conexión: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto Elegante</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../../css/contact.css">
</head>
<body>
    <div class="header"></div>

    <div class="contact-header">
        <div class="contact-card">
            <i class="fas fa-map-marker-alt"></i>
            <h3>Dirección</h3>
            <p>Playa Larga, 41600 San Luis Acatlán, Gro.</p>
        </div>
        <div class="contact-card">
            <i class="fas fa-phone-alt"></i>
            <h3>Teléfono</h3>
            <p>+52 741-113-6523</p>
        </div>
        <div class="contact-card">
            <i class="fas fa-envelope"></i>
            <h3>Email</h3>
            <p>QMicaela01@gmail.com</p>
        </div>
        <div class="contact-card">
            <i class="fas fa-clock"></i>
            <h3>Horario</h3>
            <p>Abierto todos los dias</p>
            <p>8:00am - 11:00pm</p>
        </div>
    </div>

    <div class="contact-container">
        <h2>Envía un mensaje</h2>
        <h3>Si tienes alguna pregunta, déjanos un mensaje</h3>
        <?php if ($messageSent): ?>
            <p class="message success">Tu mensaje ha sido enviado exitosamente.</p>
        <?php elseif (!empty($errorMessage)): ?>
            <p class="message error"><?= $errorMessage ?></p>
        <?php endif; ?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="correo">Correo</label>
                <input type="email" id="correo" name="correo" required>
            </div>
            <div class="form-group">
                <label for="asunto">Asunto</label>
                <input type="text" id="asunto" name="asunto" required>
            </div>
            <div class="form-group">
                <label for="mensaje">Mensaje</label>
                <textarea id="mensaje" name="mensaje" required></textarea>

            </div>
            <button type="submit" class="btn-submit">Enviar</button>
        </form>
    </div>
</body>
</html>

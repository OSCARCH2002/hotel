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
    <title>Contacto Exclusivo | Hotel Quinta Micaela</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;700&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --color-primary: #884E40;
            --color-primary-light: #a87a6c;
            --color-primary-dark: #5f342b;
            --color-secondary: #D7C4BC;
            --color-light: #F8F5F3;
            --color-white: #ffffff;
            --color-dark: #3a1f19;
            --color-gold: #b38b59;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--color-light);
            color: var(--color-dark);
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        .contact-hero {
            background: linear-gradient(rgba(88, 46, 36, 0.85), rgba(88, 46, 36, 0.85));
            height: 50vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: var(--color-white);
            position: relative;
        }

        .contact-hero::after {
            content: '';
            position: absolute;
            bottom: -50px;
            left: 0;
            width: 100%;
            height: 100px;
            background: var(--color-light);
            transform: skewY(-3deg);
            z-index: 1;
        }

        .hero-content {
            max-width: 800px;
            padding: 0 2rem;
            z-index: 2;
        }

        .hero-content h1 {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .hero-content p {
            font-size: 1.2rem;
            opacity: 0.9;
        }

        .contact-section {
            position: relative;
            z-index: 2;
            max-width: 1400px;
            margin: 5rem auto;
            padding: 0 2rem;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 4rem;
        }

        .contact-card {
            background: var(--color-white);
            border-radius: 10px;
            padding: 2.5rem;
            text-align: center;
            box-shadow: 0 15px 30px rgba(136, 78, 64, 0.1);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 1px solid rgba(136, 78, 64, 0.1);
        }

        .contact-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(136, 78, 64, 0.15);
        }

        .contact-card i {
            font-size: 2.8rem;
            color: var(--color-primary);
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, var(--color-primary), var(--color-primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .contact-card h3 {
            font-family: 'Playfair Display', serif;
            color: var(--color-primary-dark);
            margin-bottom: 1rem;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .contact-card p {
            color: var(--color-dark);
            margin: 0.5rem 0;
            font-size: 1.05rem;
        }

        .contact-form-container {
            background: var(--color-white);
            border-radius: 10px;
            padding: 3rem;
            box-shadow: 0 15px 30px rgba(136, 78, 64, 0.1);
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid rgba(136, 78, 64, 0.1);
        }

        .contact-form-container h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            color: var(--color-primary-dark);
            text-align: center;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .contact-form-container h3 {
            font-size: 1.2rem;
            color: var(--color-primary);
            text-align: center;
            margin-bottom: 2.5rem;
            font-weight: 400;
            position: relative;
        }

        .contact-form-container h3::after {
            content: '';
            display: block;
            width: 80px;
            height: 2px;
            background: var(--color-primary);
            margin: 1rem auto 0;
        }

        .message {
            padding: 1.2rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            text-align: center;
            font-weight: 500;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .message.success {
            background-color: rgba(40, 167, 69, 0.1);
            color: #28a745;
            border: 1px solid rgba(40, 167, 69, 0.2);
        }

        .message.error {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border: 1px solid rgba(220, 53, 69, 0.2);
        }

        .form-group {
            margin-bottom: 2rem;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.8rem;
            color: var(--color-primary-dark);
            font-weight: 500;
            font-size: 1.05rem;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 1rem 1.2rem;
            border: 1px solid var(--color-secondary);
            border-radius: 8px;
            font-family: 'Montserrat', sans-serif;
            transition: all 0.3s ease;
            font-size: 1rem;
            background-color: var(--color-light);
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px rgba(136, 78, 64, 0.1);
            background-color: var(--color-white);
        }

        .form-group textarea {
            min-height: 180px;
            resize: vertical;
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--color-primary), var(--color-primary-dark));
            color: white;
            border: none;
            padding: 1.2rem 2.5rem;
            font-size: 1.1rem;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: block;
            width: 100%;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 1.5rem;
            box-shadow: 0 5px 15px rgba(136, 78, 64, 0.3);
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(136, 78, 64, 0.4);
        }

        .btn-submit:active {
            transform: translateY(1px);
        }

        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.5rem;
            }
            
            .contact-hero {
                height: 40vh;
            }
            
            .contact-card {
                padding: 2rem;
            }
            
            .contact-form-container {
                padding: 2rem;
            }
            
            .contact-form-container h2 {
                font-size: 2rem;
            }
        }

        /* Animaciones */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .delay-1 {
            animation-delay: 0.2s;
        }

        .delay-2 {
            animation-delay: 0.4s;
        }

        .delay-3 {
            animation-delay: 0.6s;
        }
    </style>
</head>

<body>
    <section class="contact-hero">
        <div class="hero-content animate">
            <h1>Contáctanos</h1>
            <p>Estamos aquí para atenderte y hacer de tu experiencia algo memorable</p>
        </div>
    </section>

    <div class="contact-section">
        <div class="contact-grid">
            <div class="contact-card animate delay-1">
                <i class="fas fa-map-marker-alt"></i>
                <h3>Dirección</h3>
                <p>Playa Larga, 41600 San Luis Acatlán, Gro.</p>
            </div>
            <div class="contact-card animate delay-1">
                <i class="fas fa-phone-alt"></i>
                <h3>Teléfono</h3>
                <p>+52 741-113-6523</p>
            </div>
            <div class="contact-card animate delay-2">
                <i class="fas fa-envelope"></i>
                <h3>Email</h3>
                <p>QMicaela01@gmail.com</p>
            </div>
            <div class="contact-card animate delay-2">
                <i class="fas fa-clock"></i>
                <h3>Horario</h3>
                <p>Abierto todos los días</p>
                <p>8:00am - 11:00pm</p>
            </div>
        </div>

        <div class="contact-form-container animate delay-3">
            <h2>Envíanos un mensaje</h2>
            <h3>Estamos listos para responder todas tus preguntas</h3>
            
            <?php if ($messageSent): ?>
                <div class="message success">
                    <i class="fas fa-check-circle"></i> Tu mensaje ha sido enviado exitosamente. Nos pondremos en contacto contigo pronto.
                </div>
            <?php elseif (!empty($errorMessage)): ?>
                <div class="message error">
                    <i class="fas fa-exclamation-circle"></i> <?= $errorMessage ?>
                </div>
            <?php endif; ?>
            
            <form action="" method="POST">
                <div class="form-group">
                    <label for="name">Nombre completo</label>
                    <input type="text" id="name" name="name" required placeholder="Ingresa tu nombre completo">
                </div>
                <div class="form-group">
                    <label for="correo">Correo electrónico</label>
                    <input type="email" id="correo" name="correo" required placeholder="tu@email.com">
                </div>
                <div class="form-group">
                    <label for="asunto">Asunto</label>
                    <input type="text" id="asunto" name="asunto" required placeholder="¿Cómo podemos ayudarte?">
                </div>
                <div class="form-group">
                    <label for="mensaje">Mensaje</label>
                    <textarea id="mensaje" name="mensaje" required placeholder="Escribe tu mensaje aquí..."></textarea>
                </div>
                <button type="submit" class="btn-submit">
                    <i class="fas fa-paper-plane"></i> Enviar mensaje
                </button>
            </form>
        </div>
    </div>
</body>
<?php include "../../temp/footer.php"; ?>
</html>
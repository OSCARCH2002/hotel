<?php
// Configuración para el rol de administrador
$sender = "Administrador";
$receiver = "Recepcionista";

$mysqli = new mysqli("localhost", "root", "567890", "propuesta");
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

// Insertar mensaje con fecha y hora (la base de datos se encarga del timestamp automáticamente)
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['message'])) {
    $message = $mysqli->real_escape_string($_POST['message']);
    $stmt = $mysqli->prepare("INSERT INTO messages (sender, receiver, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $sender, $receiver, $message);
    $stmt->execute();
    $stmt->close();
    header("Location: " . $_SERVER['PHP_SELF']); // Redirect para evitar duplicados
    exit();
}

// Obtener mensajes de la base de datos, incluyendo la fecha y hora
$messages = $mysqli->query("SELECT sender, message, timestamp FROM messages ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #e5ddd5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .volver-button {
            position: absolute;
            top: 10px;
            left: 10px;
            padding: 8px 15px;
            background-color: #dcf8c6;
            color: black;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }
        .volver-button:hover {
            background-color: white;
        }
        .chat-container {
            width: 100%;
            max-width: 400px; /* Tamaño más pequeño */
            height: 600px; /* Altura ajustada */
            border: 1px solid #ddd;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            background-color: #ffffff;
            display: flex;
            flex-direction: column;
        }
        #chat-box {
            flex: 1;
            overflow-y: auto;
            padding: 15px; /* Espaciado reducido */
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .message-container {
            display: flex;
            flex-direction: column;
            margin-bottom: 10px;
        }
        .message {
            padding: 10px 15px;
            border-radius: 20px;
            max-width: 75%;
            font-size: 14px;
            line-height: 1.4;
            word-wrap: break-word;
            position: relative;
            box-shadow: 0px 1px 3px rgba(0,0,0,0.1);
        }
        .sent {
            background-color:  #dcf8c6; /* Color azul claro para mensajes enviados */
            color: #004085;
            align-self: flex-end;
            text-align: right;
        }
        .received {
            background-color:   #ffffff; /* Color verde claro para mensajes recibidos */
            color: #155724;
            align-self: flex-start;
            text-align: left;
        }
        .timestamp {
            font-size: 12px;
            color: #888;
            margin-top: 5px;
        }
        .input-container {
            display: flex;
            align-items: center;
            padding: 10px;
            border-top: 1px solid #ddd;
        }
        .input-container textarea {
            flex: 1;
            padding: 10px;
            border-radius: 20px;
            border: 1px solid #ddd;
            resize: none;
            outline: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            font-size: 14px;
            margin-right: 10px;
        }
        .input-container button {
            padding: 10px 20px;
            background-color: #25D366; /* Color verde de WhatsApp */
            color: white;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
            transition: background-color 0.3s;
        }
        .input-container button:hover {
            background-color: #128C7E; /* Color verde más oscuro al pasar el mouse */
        }
        .title {
            text-align: center;
            color: #333;
            font-size: 24px;
            margin: 15px 0;
            font-weight: bold;
            letter-spacing: 1px;
        }
    </style>
</head>
<body>
<a href="../admin/dasboard.php" class="volver-button">Volver</a> 
    <div class="chat-container">
        <h2 class="title">ADMINISTRADOR</h2>
        <div id="chat-box">
            <?php while ($row = $messages->fetch_assoc()): ?>
                <div class="message-container">
                    <div class="message <?php echo ($row['sender'] === $sender) ? 'sent' : 'received'; ?>">
                        <span class="username"><?php echo htmlspecialchars($row['sender']); ?>:</span>
                        <p><?php echo htmlspecialchars($row['message']); ?></p>
                        <span class="timestamp"><?php echo date('d/m/Y H:i', strtotime($row['timestamp'])); ?></span>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <form method="POST" class="input-container" id="chatForm">
            <textarea name="message" placeholder="Escribe tu mensaje..." required onkeydown="submitOnEnter(event)"></textarea>
            <button type="submit">Enviar</button>
        </form>
    </div>

    <script>
        function submitOnEnter(event) {
            if (event.key === "Enter" && !event.shiftKey) {
                event.preventDefault();
                document.getElementById("chatForm").submit();
            }
        }
    </script>
</body>
</html>
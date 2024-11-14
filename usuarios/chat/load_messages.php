<?php
$sender = $_GET['sender'];
$receiver = $_GET['receiver'];

$mysqli = new mysqli("localhost", "root", "567890", "propuesta");
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

$messages = $mysqli->query("SELECT sender, message, timestamp FROM messages ORDER BY id ASC");

while ($row = $messages->fetch_assoc()) {
    $messageClass = ($row['sender'] === $sender) ? 'sent' : 'received';
    echo "<div class='message-container'>";
    echo "<div class='message {$messageClass}'>";
    echo "<span class='username'>" . htmlspecialchars($row['sender']) . ":</span>";
    echo "<p>" . htmlspecialchars($row['message']) . "</p>";
    echo "<span class='timestamp'>" . date('d/m/Y H:i', strtotime($row['timestamp'])) . "</span>";
    echo "</div></div>";
}
?>

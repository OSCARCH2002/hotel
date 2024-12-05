<?php
$servername = "localhost";
$username = "root";
$password = "567890";
$dbname = "propuesta";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$sql = "SELECT habitacion.nombre AS nombre_habitacion, COUNT(reservas.id) AS total_reservas 
        FROM reservas
        JOIN habitacion ON reservas.id_habitacion = habitacion.id
        GROUP BY habitacion.nombre
        ORDER BY total_reservas DESC";
$result = $conn->query($sql);

$habitaciones = [];
$totales = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $habitaciones[] = $row['nombre_habitacion'];
        $totales[] = $row['total_reservas'];
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total de Reservas por Habitación</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            width: 80%;
            max-width: 800px;
        }
        canvas {
            width: 100% !important;
            height: auto !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Total de Reservas por Habitación</h2>
        <canvas id="reservasChart"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('reservasChart').getContext('2d');
        const reservasChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($habitaciones); ?>,
                datasets: [{
                    label: 'Total de Reservas',
                    data: <?php echo json_encode($totales); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Total de Reservas'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                    },
                    title: {
                        display: true,
                        text: 'Reservas Totales por Habitación'
                    }
                }
            }
        });
    </script>
</body>
</html>

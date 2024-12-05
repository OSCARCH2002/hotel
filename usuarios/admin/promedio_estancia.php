<?php
$servername = "localhost";
$username = "root"; 
$password = "567890"; 
$dbname = "propuesta"; 


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$sql = "SELECT AVG(DATEDIFF(fecha_salida, fecha_llegada)) AS duracion_promedio_estancia FROM reservas";
$result = $conn->query($sql);

$duracion_promedio = 0;

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $duracion_promedio = round($row["duracion_promedio_estancia"], 0);
} else {
    echo "Error en la consulta: " . $conn->error;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Duración Promedio de Estancia</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e9ecef;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            width: 90%;
            max-width: 600px;
            text-align: center;
        }
        canvas {
            width: 100% !important;
            height: auto !important;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Duración Promedio de Estancia</h2>
        <canvas id="myChart"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Duración Promedio'],
                datasets: [{
                    label: 'Días',
                    data: [<?php echo $duracion_promedio; ?>],
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Días'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                    },
                    title: {
                        display: true,
                        text: 'Duración Promedio de Estancia en Días',
                        font: {
                            size: 18
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
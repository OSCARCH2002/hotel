<?php
$mysqli = new mysqli("localhost", "root", "567890", "propuesta");

if ($mysqli->connect_error) {
    die("Conexión fallida: " . $mysqli->connect_error);
}

$query = "SELECT h.nombre AS nombre_habitacion, SUM(r.total_pagar) AS ingresos_totales 
          FROM reservas r 
          JOIN habitacion h ON r.id_habitacion = h.id 
          GROUP BY h.id, h.nombre 
          ORDER BY ingresos_totales DESC";

$result = $mysqli->query($query);

$habitaciones = [];
$ingresos = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $habitaciones[] = $row['nombre_habitacion'];
        $ingresos[] = (float)$row['ingresos_totales'];
    }
} else {
    echo "Error en la consulta: " . $mysqli->error;
}
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresos por Habitación</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }

        /* Contenedor principal que utiliza Flexbox */
        .container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-top: 30px;
        }

        /* Estilo de la gráfica */
        .chart-container {
            flex: 1; /* La gráfica ocupará la mitad */
            max-width: 800px;
            margin: 0;
        }

        /* Estilo de la tabla */
        .table-container {
            flex: 1; /* La tabla también ocupará la mitad */
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #34495e;
        }

        th {
            background-color: #34495e;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>

<h1>Ingresos Totales por Habitación</h1>

<!-- Contenedor principal que tendrá la gráfica y la tabla -->
<div class="container">
    <!-- Gráfica -->
    <div class="chart-container">
        <canvas id="myChart"></canvas>
    </div>

    <!-- Tabla -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Habitación</th>
                    <th>Ingresos Totales ($)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($habitaciones as $index => $nombre_habitacion) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($nombre_habitacion) . "</td>";
                    echo "<td>" . htmlspecialchars(number_format($ingresos[$index], 2)) . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    const labels = <?php echo json_encode($habitaciones); ?>;
    const data = {
        labels: labels,
        datasets: [{
            label: 'Ingresos Totales ($)',
            data: <?php echo json_encode($ingresos); ?>,
            backgroundColor: '#34495e)',
            borderColor: '#34495e',
            borderWidth: 1
        }]
    };

    const config = {
        type: 'bar', 
        data: data,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Ingresos ($)'
                    }
                }
            }
        },
    };

    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
</script>

</body>
</html>

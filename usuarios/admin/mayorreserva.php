<?php
$servername = "localhost";
$username = "root";
$password = "567890";
$dbname = "propuesta";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$sql = "
    SELECT 
        YEAR(fecha_llegada) AS anio,
        MONTH(fecha_llegada) AS mes,
        COUNT(*) AS total_reservas
    FROM 
        reservas
    GROUP BY 
        anio, mes
    ORDER BY 
        total_reservas DESC
";
$result = $conn->query($sql);


$labels = [];
$data = [];

$nombres_meses = [
    1 => 'Enero',
    2 => 'Febrero',
    3 => 'Marzo',
    4 => 'Abril',
    5 => 'Mayo',
    6 => 'Junio',
    7 => 'Julio',
    8 => 'Agosto',
    9 => 'Septiembre',
    10 => 'Octubre',
    11 => 'Noviembre',
    12 => 'Diciembre'
];

if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      
        $mes_nombre = $nombres_meses[$row["mes"]];
        $labels[] = $row["anio"] . ' - ' . $mes_nombre; 
        $data[] = $row["total_reservas"];
    }
} else {
    echo "<p style='text-align:center;'>No se encontraron resultados</p>";
}

$labels_json = json_encode($labels);
$data_json = json_encode($data);

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meses con Más Reservas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            text-align: center;
        }
        table {
            width: 80%;
            max-width: 600px;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }
        th, td {
            padding: 15px;
            border-bottom: 1px solid #34495e;
            text-align: center;
        }
        th {
            background-color: #34495e;
            color: white;
            font-weight: bold;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        h1 {
            color: #34495e;
        }
        .chart-container {
            width: 80%;
            max-width: 700px;
            margin: 0 auto;
            padding: 20px;
            height: 400px; 
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">
</head>
<body>
    <h1>MESES CON MÀS RESERVAS</h1>

    <button onclick="history.back()" style="
        position: absolute;
        top: 20px;
        left: 20px; /* Cambiado a la izquierda */
        padding: 10px 20px;
        font-size: 16px;
        background-color:#34495e;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    ">
        <span style="margin-right: 8px;">Volver</span>
        <span style="
            display: inline-block;
            width: 0; 
            height: 0; 
            border-top: 6px solid transparent;
            border-bottom: 6px solid transparent; 
            border-left: 8px solid white;
        "></span>
    </button>



    <table>
        <tr>
            <th>Año</th>
            <th>Mes</th>
            <th>Total de Reservas</th>
        </tr>

        <?php
        foreach ($labels as $index => $label) {
            $anio_mes = explode(' - ', $label);
            $anio = $anio_mes[0];
            $mes = $anio_mes[1];
            $total_reservas = $data[$index];
            echo "<tr>";
            echo "<td>" . $anio . "</td>";
            echo "<td>" . $mes . "</td>";
            echo "<td>" . $total_reservas . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

 
    <div class="chart-container">
        <canvas id="reservasChart"></canvas>
    </div>

    <script>
        const labels = <?php echo $labels_json; ?>;
        const dataValues = <?php echo $data_json; ?>;

        console.log("Etiquetas:", labels);
        console.log("Datos:", dataValues);

        if (labels.length > 0 && dataValues.length > 0) {
            const data = {
                labels: labels,
                datasets: [{
                    label: 'Reservas del mes',
                    data: dataValues,
                    backgroundColor: '#34495e',
                    borderColor: '#34495e',
                    borderWidth: 1
                }]
            };

            
            const config = {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                        },
                        title: {
                            display: true,
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Total de Reservas'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Año-Mes'
                            }
                        }
                    }
                }
            };

            
            const reservasChart = new Chart(
                document.getElementById('reservasChart'),
                config
            );
        } else {
            console.error('No hay datos para la gráfica.');
        }
    </script>
</body>
</html>
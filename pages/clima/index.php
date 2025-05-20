<?php
include("../../temp/header.php");

date_default_timezone_set('America/Mexico_City');

$apiKey = "b7a78e8d69f835ed44e7c49de9e85089";
$lat = 16.8070694;
$lon = -98.7350079;

$currentWeatherUrl = "https://api.openweathermap.org/data/2.5/weather?lat={$lat}&lon={$lon}&units=metric&appid={$apiKey}&lang=es";
$forecastUrl = "https://api.openweathermap.org/data/2.5/forecast?lat={$lat}&lon={$lon}&units=metric&appid={$apiKey}&lang=es";

$currentWeatherResponse = file_get_contents($currentWeatherUrl);
$currentWeatherData = json_decode($currentWeatherResponse, true);

$forecastResponse = file_get_contents($forecastUrl);
$forecastData = json_decode($forecastResponse, true);

// Función para formatear fechas en español
function formatDateSpanish($dateString) {
    $days = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
    $months = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
    
    $timestamp = strtotime($dateString);
    $dayOfWeek = $days[date('w', $timestamp)];
    $dayOfMonth = date('d', $timestamp);
    $month = $months[date('n', $timestamp) - 1];
    $year = date('Y', $timestamp);
    $time = date('H:i', $timestamp);
    
    return "$dayOfWeek, $dayOfMonth de $month de $year $time";
}

if ($currentWeatherData['cod'] == 200) {
    $locationName = $currentWeatherData['name'];
    $temperature = round($currentWeatherData['main']['temp'], 1);
    $description = $currentWeatherData['weather'][0]['description'];
    $icon = $currentWeatherData['weather'][0]['icon'];
    $humidity = $currentWeatherData['main']['humidity'];
    $windSpeed = round($currentWeatherData['wind']['speed'], 1);
    $currentDayTime = formatDateSpanish(date('Y-m-d H:i'));
} else {
    $error = $currentWeatherData['message'];
}

$forecastByDay = [];
if ($forecastData['cod'] == "200") {
    foreach ($forecastData['list'] as $forecast) {
        $date = date("Y-m-d", $forecast['dt']);
        $time = date('H:i', $forecast['dt']);
        $temp = round($forecast['main']['temp'], 1);
        $desc = $forecast['weather'][0]['description'];
        $icon = $forecast['weather'][0]['icon'];

        $forecastByDay[$date][] = [
            'time' => $time,
            'temp' => $temp,
            'desc' => $desc,
            'icon' => $icon
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clima en San Luis Acatlán | Hotel Quinta Micaela</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --color-primary: #884E40;
            --color-primary-light: #a87a6c;
            --color-primary-dark: #5f342b;
            --color-secondary: #D7C4BC;
            --color-light: #F8F5F3;
            --color-white: #ffffff;
            --color-dark: #3a1f19;
        }
        
        body {
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            padding: 0;
            background: var(--color-light);
            color: var(--color-dark);
            min-height: 100vh;
        }
        
        .weather-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        
        .weather-header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .weather-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            margin-bottom: 10px;
            color: var(--color-primary);
        }
        
        .weather-header p {
            color: var(--color-primary-dark);
        }
        
        .current-weather {
            background: var(--color-white);
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 40px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(136, 78, 64, 0.1);
            border: 1px solid var(--color-secondary);
        }
        
        .current-date {
            font-size: 1.2rem;
            margin-bottom: 20px;
            color: var(--color-primary-dark);
        }
        
        .weather-main {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 30px;
            margin-bottom: 20px;
        }
        
        .weather-icon {
            width: 120px;
            height: 120px;
        }
        
        .weather-temp {
            font-size: 3rem;
            font-weight: 600;
            color: var(--color-primary);
        }
        
        .weather-desc {
            font-size: 1.5rem;
            text-transform: capitalize;
            margin-bottom: 10px;
            color: var(--color-primary-dark);
        }
        
        .location {
            color: var(--color-primary);
            font-weight: 600;
        }
        
        .weather-details {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }
        
        .detail-item {
            background: var(--color-light);
            border-radius: 8px;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            border: 1px solid var(--color-secondary);
        }
        
        .detail-item i {
            color: var(--color-primary);
        }
        
        .forecast-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            text-align: center;
            margin: 40px 0 20px;
            color: var(--color-primary);
        }
        
        .forecast-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }
        
        .forecast-day {
            background: var(--color-white);
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(136, 78, 64, 0.1);
            border: 1px solid var(--color-secondary);
        }
        
        .forecast-day:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(136, 78, 64, 0.2);
        }
        
        .forecast-day h3 {
            margin-bottom: 15px;
            font-weight: 600;
            color: var(--color-primary);
        }
        
        .forecast-day img {
            width: 80px;
            height: 80px;
            margin: 0 auto;
        }
        
        .forecast-temp {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 10px 0;
            color: var(--color-primary);
        }
        
        .forecast-desc {
            font-size: 0.9rem;
            text-transform: capitalize;
            color: var(--color-primary-dark);
        }
        
        .hourly-forecast {
            display: none;
            background: var(--color-white);
            border-radius: 15px;
            padding: 30px;
            margin-top: 20px;
            box-shadow: 0 5px 20px rgba(136, 78, 64, 0.1);
            border: 1px solid var(--color-secondary);
        }
        
        .hourly-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: var(--color-primary);
            text-align: center;
        }
        
        .hourly-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 15px;
        }
        
        .hourly-item {
            background: var(--color-light);
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            border: 1px solid var(--color-secondary);
        }
        
        .hourly-time {
            font-weight: 600;
            margin-bottom: 5px;
            color: var(--color-primary);
        }
        
        .hourly-icon {
            width: 50px;
            height: 50px;
            margin: 0 auto;
        }
        
        .hourly-temp {
            font-weight: 600;
            margin: 5px 0;
            color: var(--color-primary);
        }
        
        .hourly-desc {
            font-size: 0.8rem;
            color: var(--color-primary-dark);
        }
        
        .error-message {
            background: var(--color-white);
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            color: var(--color-primary-dark);
            border: 1px solid var(--color-secondary);
        }
        
        @media (max-width: 768px) {
            .forecast-container {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            }
            
            .weather-header h1 {
                font-size: 2rem;
            }
            
            .weather-temp {
                font-size: 2.5rem;
            }
            
            .hourly-grid {
                grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            }
        }
    </style>
</head>

<body>
    <div class="weather-container">
        <div class="weather-header">
            <h1>Clima en San Luis Acatlán</h1>
            <p>Información meteorológica actualizada para tu estancia</p>
        </div>
        
        <?php if (isset($temperature)): ?>
            <div class="current-weather">
                <div class="current-date"><?= $currentDayTime ?></div>
                <div class="weather-main">
                    <img src="https://openweathermap.org/img/wn/<?= $icon ?>@4x.png" alt="Estado del clima" class="weather-icon">
                    <div>
                        <div class="weather-temp"><?= $temperature ?>°C</div>
                        <div class="weather-desc"><?= ucfirst($description) ?></div>
                        <div class="location"><?= htmlspecialchars($locationName) ?></div>
                    </div>
                </div>
                <div class="weather-details">
                    <div class="detail-item">
                        <i class="fas fa-tint"></i>
                        <span>Humedad: <?= $humidity ?>%</span>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-wind"></i>
                        <span>Viento: <?= $windSpeed ?> m/s</span>
                    </div>
                </div>
            </div>
            
            <h2 class="forecast-title">Pronóstico para los próximos días</h2>
            <div class="forecast-container">
                <?php foreach ($forecastByDay as $day => $details): 
                    $dayName = date('l', strtotime($day));
                    $spanishDays = [
                        'Monday' => 'Lunes',
                        'Tuesday' => 'Martes',
                        'Wednesday' => 'Miércoles',
                        'Thursday' => 'Jueves',
                        'Friday' => 'Viernes',
                        'Saturday' => 'Sábado',
                        'Sunday' => 'Domingo'
                    ];
                    $dayNameSpanish = $spanishDays[$dayName] ?? $dayName;
                ?>
                    <div class="forecast-day" onclick="toggleHourlyForecast('<?= $day ?>')">
                        <h3><?= $dayNameSpanish ?></h3>
                        <img src="https://openweathermap.org/img/wn/<?= $details[0]['icon'] ?>.png" alt="Icono del clima">
                        <div class="forecast-temp"><?= $details[0]['temp'] ?>°C</div>
                        <div class="forecast-desc"><?= ucfirst($details[0]['desc']) ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <?php foreach ($forecastByDay as $day => $details): 
                $dayName = date('l', strtotime($day));
                $spanishDays = [
                    'Monday' => 'Lunes',
                    'Tuesday' => 'Martes',
                    'Wednesday' => 'Miércoles',
                    'Thursday' => 'Jueves',
                    'Friday' => 'Viernes',
                    'Saturday' => 'Sábado',
                    'Sunday' => 'Domingo'
                ];
                $dayNameSpanish = $spanishDays[$dayName] ?? $dayName;
                $formattedDate = date('d/m/Y', strtotime($day));
            ?>
                <div class="hourly-forecast" id="forecast-<?= $day ?>">
                    <h3 class="hourly-title">Pronóstico por horas para <?= $dayNameSpanish ?> (<?= $formattedDate ?>)</h3>
                    <div class="hourly-grid">
                        <?php foreach ($details as $detail): ?>
                            <div class="hourly-item">
                                <div class="hourly-time"><?= $detail['time'] ?></div>
                                <img src="https://openweathermap.org/img/wn/<?= $detail['icon'] ?>.png" alt="Icono del clima" class="hourly-icon">
                                <div class="hourly-temp"><?= $detail['temp'] ?>°C</div>
                                <div class="hourly-desc"><?= ucfirst($detail['desc']) ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
            
        <?php else: ?>
            <div class="error-message">
                <p>Error al obtener los datos del clima: <?= htmlspecialchars($error) ?></p>
                <p>Por favor intenta nuevamente más tarde.</p>
            </div>
        <?php endif; ?>
    </div>

    <script>
        function toggleHourlyForecast(day) {
            // Oculta todos los pronósticos por hora primero
            document.querySelectorAll('.hourly-forecast').forEach(el => {
                el.style.display = 'none';
            });
            
            // Muestra el pronóstico seleccionado
            const forecastElement = document.getElementById(`forecast-${day}`);
            if (forecastElement) {
                forecastElement.style.display = 'block';
                
                // Desplazamiento suave al elemento
                forecastElement.scrollIntoView({ behavior: 'smooth' });
            }
        }
        
        // Mostrar el primer día por defecto
        document.addEventListener('DOMContentLoaded', function() {
            const firstDay = document.querySelector('.forecast-day');
            if (firstDay) {
                const firstDayId = firstDay.getAttribute('onclick').match(/'([^']+)'/)[1];
                toggleHourlyForecast(firstDayId);
            }
        });
    </script>
</body>
</html>
<?php include("../../temp/footer.php"); ?>
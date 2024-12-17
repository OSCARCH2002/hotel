<?php
include("../../temp/header.php");

setlocale(LC_TIME, 'es_ES.UTF-8');
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

if ($currentWeatherData['cod'] == 200) {
    $locationName = $currentWeatherData['name'];
    $temperature = $currentWeatherData['main']['temp'];
    $description = $currentWeatherData['weather'][0]['description'];
    $icon = $currentWeatherData['weather'][0]['icon'];
    $humidity = $currentWeatherData['main']['humidity'];
    $windSpeed = $currentWeatherData['wind']['speed'];
    $currentDayTime = strftime('%A, %d de %B de %Y %H:%M');
} else {
    $error = $currentWeatherData['message'];
}

$forecastByDay = [];
if ($forecastData['cod'] == "200") {
    foreach ($forecastData['list'] as $forecast) {
        $date = date("Y-m-d", strtotime($forecast['dt_txt']));
        $time = strftime('%H:%M', strtotime($forecast['dt_txt'])); // Hora en español
        $temp = $forecast['main']['temp'];
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
    <title>Clima en San Luis Acatlán</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom, #1e3c72, #2a5298);
            color: #fff;
            text-align: center;
            min-height: 100vh;
        }

        .container {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 30px;
            width: 90%;
            max-width: 450px;
            margin: 20px auto;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .weather-info img {
            width: 120px;
            height: 120px;
        }

        .forecast-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            margin: 20px auto;
            max-width: 1200px;
        }

        .forecast-item {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            cursor: pointer;
            width: 150px;
            transition: transform 0.2s ease-in-out;
        }

        .forecast-item:hover {
            transform: scale(1.1);
            background: rgba(255, 255, 255, 0.3);
        }

        .details {
            display: none;
            margin-top: 20px;
            text-align: center;
            width: 90%;
            max-width: 1200px;
            margin: 20px auto;
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
        }

        .detail-item {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            padding: 10px;
            text-align: center;
            transition: transform 0.2s ease-in-out;
        }

        .detail-item:hover {
            transform: scale(1.05);
            background: rgba(255, 255, 255, 0.3);
        }

        footer {
            width: 100%;
            background-color: #002A32;
            position: relative;
            left: 0;
            right: 0;
            padding: 2rem 0;
        }

        .footer-content {
            margin: 0 auto;
            padding: 0;
            max-width: 1200px;
        }

        .footer-content .row {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .footer-content .col-md-3,
        .footer-content .col-md-2,
        .footer-content .col-md-4 {
            flex: 1 1 200px;
            margin: 10px;
        }

        .footer-content h4,
        .footer-content h6 {
            color: white;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .footer-content p {
            color: white;
            font-size: 14px;
        }

        .footer-content .btn {
            margin-top: 10px;
        }
    </style>
    <script>
        function toggleDetails(day) {
            document.querySelectorAll('.details').forEach(el => el.style.display = 'none');
            document.getElementById(day).style.display = 'block';
        }
    </script>
</head>
<br><br><br>

<body>
    <div class="container">
        <div class="weather-info">
            <?php if (isset($temperature)): ?>
                <h1>San Luis Acatlán</h1>
                <h3><?= ucfirst($currentDayTime) ?></h3>
                <img src="https://openweathermap.org/img/wn/<?= $icon ?>@4x.png" alt="Icono del clima">
                <p><strong><?= htmlspecialchars($locationName) ?></strong></p>
                <p><?= ucfirst($description) ?>, <?= $temperature ?>°C</p>
                <p>Humedad: <?= $humidity ?>% | Viento: <?= $windSpeed ?> m/s</p>
            <?php else: ?>
                <p>Error: <?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
        </div>
    </div>

    <h2>Pronóstico para los siguientes dias</h2>
    <div class="forecast-container">
        <?php foreach ($forecastByDay as $day => $details): ?>
            <div class="forecast-item" onclick="toggleDetails('day-<?= $day ?>')">
                <h3><?= ucfirst(strftime('%A', strtotime($day))) ?></h3>
                <img src="https://openweathermap.org/img/wn/<?= $details[0]['icon'] ?>.png" alt="Icono del clima">
                <p><strong><?= $details[0]['temp'] ?>°C</strong></p>
                <p><?= ucfirst($details[0]['desc']) ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <?php foreach ($forecastByDay as $day => $details): ?>
        <div class="details" id="day-<?= $day ?>">
            <h3>Detalles para <?= ucfirst(strftime('%A, %d de %B', strtotime($day))) ?></h3>
            <div class="details-grid">
                <?php foreach ($details as $detail): ?>
                    <div class="detail-item">
                        <p><strong><?= $detail['time'] ?></strong></p>
                        <img src="https://openweathermap.org/img/wn/<?= $detail['icon'] ?>.png" alt="Icono del clima">
                        <p><?= $detail['temp'] ?>°C</p>
                        <p><?= ucfirst($detail['desc']) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>
    <footer>
        <div class="container-fluid footer-content">
            <div class="text-center text-lg-start text-white">
                <section>
                    <div class="row">
                        <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                            <h4 class="text-uppercase mb-4">Hotel Quinta Micaela</h4>
                            <p>Somos un hotel comprometido socialmente con las personas, ofreciendo los mejores servicios de la costa. ¡Somos tu mejor opción!</p>
                        </div>
                        <hr class="w-100 clearfix d-md-none" />
                        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                            <h6 class="text-uppercase mb-4">Servicios</h6>
                            <p>Renta Mensual</p>
                            <p>Eventos Sociales</p>
                            <p>Hospedaje por noche</p>
                        </div>
                        <hr class="w-100 clearfix d-md-none" />
                        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                            <h6 class="text-uppercase mb-4">Contacto</h6>
                            <p><i class="fas fa-home mr-3"></i> Visítanos en: Calle 20 de noviembre, Barrio de Playa Larga, a un costado de Bodega Aurrera</p>
                            <p><i class="fas fa-envelope mr-3"></i> calixto75@gmail.com</p>
                            <p><i class="fas fa-phone mr-3"></i>+52 741-113-6523 </p>
                        </div>
                        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                            <h6 class="text-uppercase mb-4">Síguenos</h6>
                            <a class="btn btn-primary btn-floating m-1" style="background-color: #3b5998" href="https://es-la.facebook.com/" role="button">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </footer>
</body>

</html>

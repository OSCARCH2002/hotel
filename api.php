https://api.openweathermap.org/data/2.5/weather?lat=16.806928732886348&lon=-98.73548463476729&appid=2cb4eb4a40fdb54c74ad930cbfbe7a01



<?php
include("../../temp/header.php");

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
    $icon = $currentWeatherData['weather'][0]['icon']; // Icono del clima
    $humidity = $currentWeatherData['main']['humidity'];
    $windSpeed = $currentWeatherData['wind']['speed'];
} else {
    $error = $currentWeatherData['message'];
}

$forecastList = [];
if ($forecastData['cod'] == "200") {
    foreach ($forecastData['list'] as $forecast) {
        $dateTime = $forecast['dt_txt'];
        $temp = $forecast['main']['temp'];
        $desc = $forecast['weather'][0]['description'];
        $icon = $forecast['weather'][0]['icon'];
        $forecastList[] = [
            'datetime' => $dateTime,
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
            background: linear-gradient(to bottom, #0f2027, #203a43, #2c5364);
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            min-height: 100vh;
        }

        .container {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 20px;
            padding: 30px;
            width: 90%;
            max-width: 450px;
            text-align: center;
            margin: 30px auto 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(10px);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .container:hover {
            transform: scale(1.02);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.6);
        }

        .weather-info img {
            width: 120px;
            height: 120px;
            margin-bottom: 20px;
            filter: drop-shadow(0 4px 10px rgba(0, 0, 0, 0.4));
        }

        .weather-info h1 {
            font-size: 2.5rem;
            text-shadow: 2px 4px 8px rgba(0, 0, 0, 0.7);
        }

        .weather-info p {
            margin: 10px 0;
            font-size: 1.2rem;
        }

        .forecast-container {
            display: flex;
            gap: 15px;
            overflow-x: auto;
            padding: 20px;
            width: 90%;
            max-width: 1200px;
            margin: 20px 0;
        }

        .forecast-item {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.05));
            border-radius: 15px;
            padding: 20px;
            min-width: 160px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease, background 0.3s ease;
            backdrop-filter: blur(5px);
        }

        .forecast-item:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.5);
        }

        .forecast-item img {
            width: 70px;
            height: 70px;
            margin-bottom: 10px;
        }

        .forecast-item h4 {
            font-size: 1.1rem;
            margin: 5px 0;
            color: #e0f7fa;
        }

        .forecast-item p {
            font-size: 1rem;
            margin: 5px 0;
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
            /* Limita el ancho máximo del contenido */
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

        @media (max-width: 768px) {
            .forecast-container {
                flex-wrap: wrap;
                gap: 15px;
            }

            .forecast-item {
                min-width: 120px;
            }
        }
    </style>
</head>

<body>
    <br><br><br><br>
    <div class="container">
        <div class="weather-info">
            <?php if (isset($temperature)): ?>
                <i class="fas fa-cloud-sun icon"></i>
                <h1>Clima en San Luis Acatlán</h1>
                <img src="https://openweathermap.org/img/wn/<?= $icon ?>@4x.png" alt="Icono del clima">
                <h2><?= htmlspecialchars($locationName) ?></h2>
                <p><strong>Temperatura:</strong> <?= $temperature ?>°C</p>
                <p><strong>Descripción:</strong> <?= ucfirst($description) ?></p>
                <p><strong>Humedad:</strong> <?= $humidity ?>%</p>
                <p><strong>Viento:</strong> <?= $windSpeed ?> m/s</p>
            <?php elseif (isset($error)): ?>
                <p><strong>Error:</strong> <?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
        </div>
    </div>

    <h3 style="margin-top: 20px; text-shadow: 2px 4px 8px rgba(0, 0, 0, 0.7);">Pronóstico de los próximos días</h3>
    <div class="forecast-container">
        <?php foreach ($forecastList as $forecast): ?>
            <div class="forecast-item">
                <h4><?= date("d/m H:i", strtotime($forecast['datetime'])) ?></h4>
                <img src="https://openweathermap.org/img/wn/<?= $forecast['icon'] ?>@2x.png" alt="Icono del clima">
                <p><strong><?= $forecast['temp'] ?>°C</strong></p>
                <p><?= ucfirst($forecast['desc']) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
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
    </footer>
</body>
</html>
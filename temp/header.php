<?php
$host = $_SERVER['HTTP_HOST'];
$url = "http://$host/hotel/";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Micaela</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <style>
    /* General Styles */
    body {
      padding-top: 70px; /* Espacio para el navbar fijo */
      font-family: 'Arial', sans-serif;
      background-color: #f4f4f9;
      margin: 0;
    }

    .navbar {
      background-color: #23272F !important;
      border-radius: 0;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand img {
      border-radius: 50%;
      height: 50px;
    }

    .nav-link {
      font-size: 18px;
      padding: 12px 20px;
      color: #fff;
      text-transform: uppercase;
      letter-spacing: 1px;
      transition: background-color 0.3s ease, color 0.3s ease;
    }

    .nav-link:hover,
    .nav-link:focus {
      background-color: #dd5cd9;
      color: white;
    }

    .nav-item {
      margin-left: 15px;
    }

    .navbar-toggler {
      border: none;
      background-color: transparent; /* Sin color de fondo */
    }

    .navbar-toggler-icon {
      background-color: transparent; /* Sin fondo */
    }

    .navbar-toggler-icon:before,
    .navbar-toggler-icon:after,
    .navbar-toggler-icon span {
      background-color: #fff; /* Las rayas del ícono serán blancas */
    }

    .btn-primary {
      border: none;
      border-radius: 5px;
      padding: 12px 20px;
      background-color: #dd5cd9;
      color: white;
      font-weight: bold;
      transition: background-color 0.3s;
    }

    .btn-primary:hover {
      background-color: #59a3dc;
    }

    /* Estilos para dispositivos pequeños y medianos (mobile-first) */
    @media (max-width: 1024px) {
      .navbar-collapse {
        position: fixed;
        top: 0;
        right: -100%;
        height: 100%;
        width: 100%;
        background-color: rgba(52, 58, 64, 0.9);
        transition: transform 0.5s ease-out;
        padding-top: 20px;
        z-index: 9999;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
      }

      .navbar-collapse.show {
        transform: translateX(0);
        right: 0;
      }

      .nav-link {
        font-size: 20px;
        text-align: center;
        display: block;
        padding: 15px;
        border-bottom: 1px solid #ddd;
        transition: transform 0.3s ease;
      }

      .navbar-toggler {
        display: block;
      }

      .close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        color: white;
        font-size: 36px;
        cursor: pointer;
        z-index: 10000;
      }

      .navbar-toggler:focus {
        outline: none;
      }

      .navbar-toggler-icon {
        background-color: transparent; /* Fondo transparente para el ícono */
      }

      .nav-item {
        margin-bottom: 10px; /* Separar más los elementos */
      }
    }

    /* Estilos para pantallas grandes */
    @media (min-width: 1025px) {
      .navbar-collapse {
        display: flex !important;
        justify-content: flex-end;
      }

      .navbar-nav {
        display: flex;
        justify-content: flex-end;
      }

      .close-btn {
        display: none;
      }

      .nav-item {
        margin-left: 20px;
      }

      .navbar-toggler {
        display: none;
      }
    }

    /* Fondo para todas las secciones */
    .section {
      padding: 60px 20px;
      text-align: center;
      background-color: #fff;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
      margin: 20px 0;
      border-radius: 10px;
    }

    .section h2 {
      font-size: 2.5rem;
      font-weight: bold;
      color: #333;
    }

    .section p {
      font-size: 1.2rem;
      color: #555;
      line-height: 1.6;
    }
  </style>
</head>

<body>

  <!-- Barra de navegación -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <a class="navbar-brand" href="<?php echo $url; ?>">
      <img src="<?php echo $url; ?>log/logo.png" alt="Logo de Micaela Confort">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <span class="close-btn" data-toggle="collapse" data-target="#navbarSupportedContent">&times;</span>
      <ul class="navbar-nav">
        <?php
        $paginas = array(
          "Principal" => "principal",
          "Reservar" => "reservas",
          "Evento" => "evento",
          "Galería" => "galeria",
          "Clima" => "clima",
          "Contacto" => "contacto"
        );

        foreach ($paginas as $nombre => $ruta) {
          echo '<li class="nav-item">';
          echo '<a class="nav-link" href="' . $url . 'pages/' . $ruta . '/">' . $nombre . '</a>';
          echo '</li>';
        }
        ?>
      </ul>
    </div>
  </nav>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>

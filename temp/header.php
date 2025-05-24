<?php
$host = $_SERVER['HTTP_HOST'];
$url = "http://$host/hotel/";
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel Quinta Micaela</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;700&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: {
              DEFAULT: '#884E40',
              600: '#734035',
              700: '#5f342b',
              800: '#4c2921',
              900: '#3a1f19'
            },
            light: '#F8F5F3',
            cream: '#F0EAE6'
          },
          fontFamily: {
            playfair: ['Playfair Display', 'serif'],
            montserrat: ['Montserrat', 'sans-serif'],
          },
          animation: {
            'fade-in': 'fadeIn 0.5s ease-in-out',
            'slide-down': 'slideDown 0.5s ease-out',
          },
          keyframes: {
            fadeIn: {
              '0%': { opacity: '0' },
              '100%': { opacity: '1' },
            },
            slideDown: {
              '0%': { transform: 'translateY(-20px)', opacity: '0' },
              '100%': { transform: 'translateY(0)', opacity: '1' },
            },
          }
        }
      }
    }
  </script>
  <style>
    .mobile-menu {
      transition: transform 0.3s ease-in-out;
    }
    .mobile-menu-hidden {
      transform: translateX(100%);
    }
    .mobile-menu-visible {
      transform: translateX(0);
    }
    .nav-link {
      position: relative;
      transition: all 0.3s ease;
    }
    .nav-link:after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 0;
      height: 2px;
      background: #884E40;
      transition: width 0.3s ease;
    }
    .nav-link:hover:after {
      width: 100%;
    }
    .nav-link:hover {
      color: #884E40;
    }
    .nav-link-active {
      color: #884E40;
    }
    .nav-link-active:after {
      width: 100%;
    }
  </style>
</head>

<body class="font-montserrat bg-light text-primary-800 pt-16">
  <!-- Barra de navegación -->
  <nav class="fixed top-0 left-0 right-0 z-50 bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-20">
        <!-- Logo -->
        <div class="flex-shrink-0">
          <a href="<?php echo $url; ?>" class="flex items-center">
            <img class="h-12 w-12 rounded-full" src="<?php echo $url; ?>assets/images/logo.png" alt="Logo Hotel Quinta Micaela">
            <span class="ml-3 text-xl font-playfair font-bold text-primary-700">Quinta Micaela</span>
          </a>
        </div>

        <!-- Menú desktop -->
        <div class="hidden md:block">
          <div class="ml-10 flex items-center space-x-8">
            <?php
            $paginas = array(
              "Principal" => "principal",
              "Reservar" => "reservas",
              "Evento" => "evento",
              "Galería" => "galeria",
              "Clima" => "clima",
              "Contacto" => "contacto",
              "Promociones" => "promociones",
              "Registrate" => "registro",
            );

            $iconos = array(
              "Principal" => "fas fa-home",
              "Reservar" => "fas fa-calendar-check",
              "Evento" => "fas fa-calendar-alt",
              "Galería" => "fas fa-images",
              "Clima" => "fas fa-sun",
              "Contacto" => "fas fa-envelope",
              "Promociones" => "fas fa-percent",
              "Registrate" => "fas fa-user-plus"
            );

            foreach ($paginas as $nombre => $ruta) {
              $activeClass = (basename($_SERVER['PHP_SELF']) == "$ruta.php") ? 'nav-link-active' : '';
              echo '<a href="' . $url . 'pages/' . $ruta . '/" class="nav-link text-primary-600 px-3 py-2 text-sm font-medium flex items-center animate-fade-in ' . $activeClass . '">';
              echo '<i class="' . $iconos[$nombre] . ' mr-2"></i>' . $nombre;
              echo '</a>';
            }
            ?>
          </div>
        </div>

        <!-- Botón móvil -->
        <div class="md:hidden">
          <button id="mobile-menu-button" class="text-primary-600 hover:text-primary-800 focus:outline-none">
            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Menú móvil -->
    <div id="mobile-menu" class="mobile-menu mobile-menu-hidden md:hidden fixed inset-0 bg-white z-50 overflow-y-auto">
      <div class="max-w-7xl mx-auto px-4 pt-24 pb-12 sm:px-6">
        <div class="flex justify-end">
          <button id="close-menu-button" class="text-primary-600 hover:text-primary-800 focus:outline-none mr-4 mt-4">
            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>
        <div class="flex flex-col space-y-4 px-4">
          <?php
          foreach ($paginas as $nombre => $ruta) {
            $activeClass = (basename($_SERVER['PHP_SELF']) == "$ruta.php" ? 'text-primary-700 font-bold' : 'text-primary-600');
            echo '<a href="' . $url . 'pages/' . $ruta . '/" class="' . $activeClass . ' hover:text-primary-800 px-3 py-3 rounded-md text-lg font-medium border-b border-cream transition duration-300 flex items-center animate-slide-down">';
            echo '<i class="' . $iconos[$nombre] . ' mr-3"></i>' . $nombre;
            echo '</a>';
          }
          ?>
        </div>
      </div>
    </div>
  </nav>

  <script>
    // Menu mobile toggle
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const closeMenuButton = document.getElementById('close-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    mobileMenuButton.addEventListener('click', () => {
      mobileMenu.classList.remove('mobile-menu-hidden');
      mobileMenu.classList.add('mobile-menu-visible');
      document.body.style.overflow = 'hidden';
    });

    closeMenuButton.addEventListener('click', () => {
      mobileMenu.classList.remove('mobile-menu-visible');
      mobileMenu.classList.add('mobile-menu-hidden');
      document.body.style.overflow = 'auto';
    });

    // Cerrar menú al hacer clic en un enlace
    const mobileLinks = document.querySelectorAll('#mobile-menu a');
    mobileLinks.forEach(link => {
      link.addEventListener('click', () => {
        mobileMenu.classList.remove('mobile-menu-visible');
        mobileMenu.classList.add('mobile-menu-hidden');
        document.body.style.overflow = 'auto';
      });
    });

    // Animación de elementos del menú
    const navLinks = document.querySelectorAll('.animate-fade-in');
    navLinks.forEach((link, index) => {
      link.style.animationDelay = `${index * 0.1}s`;
    });

    const mobileNavLinks = document.querySelectorAll('.animate-slide-down');
    mobileNavLinks.forEach((link, index) => {
      link.style.animationDelay = `${index * 0.1}s`;
    });

    // Detectar página activa
    const currentPage = window.location.pathname.split('/').pop() || 'principal';
    document.querySelectorAll('.nav-link').forEach(link => {
      if (link.getAttribute('href').includes(currentPage)) {
        link.classList.add('nav-link-active');
      }
    });
  </script>
</body>
</html>
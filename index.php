<?php include("./temp/header.php"); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hotel Quinta Micaela - Excelencia y Sofisticación</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;700&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: '#884E40',
                            50: '#f8f5f4',
                            100: '#e8dfdc',
                            200: '#d8c4bd',
                            300: '#c19e93',
                            400: '#a87a6c',
                            500: '#884E40',
                            600: '#734035',
                            700: '#5f342b',
                            800: '#4c2921',
                            900: '#3a1f19'
                        },
                        light: '#F8F5F3',
                        cream: '#F0EAE6',
                        sand: '#D7C4BC'
                    },
                    fontFamily: {
                        playfair: ['Playfair Display', 'serif'],
                        montserrat: ['Montserrat', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style type="text/css">
        .text-stroke {
            -webkit-text-stroke: 1px #F8F5F3;
            color: transparent;
        }
        
        .card {
            background: white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(136, 78, 64, 0.1);
        }
        
        .btn-primary {
            background: #884E40;
            color: white;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background: #734035;
            transform: translateY(-2px);
        }
        
        .btn-outline {
            border: 2px solid #884E40;
            color: #884E40;
            transition: all 0.3s ease;
        }
        
        .btn-outline:hover {
            background: #884E40;
            color: white;
        }
        
        .section-title {
            position: relative;
            padding-bottom: 1rem;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 2px;
            background: #884E40;
        }
        
        .image-overlay {
            background: linear-gradient(to top, rgba(88, 46, 36, 0.7) 0%, rgba(88, 46, 36, 0.3) 50%, rgba(88, 46, 36, 0) 100%);
        }
    </style>
</head>

<body class="font-montserrat bg-light text-primary-800">
    <!-- Hero Section -->
    <section class="relative h-screen flex items-center justify-center bg-cover bg-center" style="background-image: url('./assets/images/banner.jpg');">
        <div class="absolute inset-0 bg-primary-700 opacity-40"></div>
        <div class="relative z-10 text-center px-6 max-w-5xl mx-auto">
            <p class="text-primary-100 tracking-widest mb-4">BIENVENIDO A</p>
            <h1 class="text-5xl md:text-7xl lg:text-8xl font-playfair font-bold mb-8 text-white">
                <span class="text-stroke">HOTEL</span> <br>
                <span class="text-white">QUINTA MICAELA</span>
            </h1>
            <p class="text-xl md:text-2xl mb-12 text-primary-100 max-w-2xl mx-auto">Comodidad y confort</p>
            <div>
                <a href="./pages/reservas/index.php" class="inline-block px-12 py-4 btn-primary font-bold rounded-sm text-lg uppercase tracking-wider">
                    Reservar Ahora
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 px-6 bg-cream">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <p class="text-primary-500 tracking-widest mb-3">EXPERIENCIA</p>
                <h2 class="text-3xl md:text-4xl font-playfair text-primary-700 mb-6 section-title">Nuestras Exclusividades</h2>
                <p class="text-primary-600 max-w-2xl mx-auto">Diseñado para quienes aprecian los detalles y la excelencia en cada aspecto</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="card p-8 rounded-sm">
                    <div class="text-primary-600 text-4xl mb-6 h-12 flex items-center justify-center">
                        <i class="fas fa-wifi"></i>
                    </div>
                    <h3 class="text-xl font-playfair mb-4 text-primary-700">WIFI</h3>
                    <p class="text-primary-600">Internet de fibra óptica de alta velocidad en todas las instalaciones</p>
                </div>
                
                <div class="card p-8 rounded-sm">
                    <div class="text-primary-600 text-4xl mb-6 h-12 flex items-center justify-center">
                        <i class="fas fa-umbrella-beach"></i>
                    </div>
                    <h3 class="text-xl font-playfair mb-4 text-primary-700">Agua Caliente</h3>
                    <p class="text-primary-600">Contamos con agua caliente</p>
                </div>
                
                <div class="card p-8 rounded-sm">
                    <div class="text-primary-600 text-4xl mb-6 h-12 flex items-center justify-center">
                        <i class="fas fa-parking"></i>    
                    </div>
                    <h3 class="text-xl font-playfair mb-4 text-primary-700">Estacionamiento</h3>
                    <p class="text-primary-600">Amplio estacionamiento vigilado las 24 horas para la seguridad y comodidad</p>
                </div>
                
                <div class="card p-8 rounded-sm">
                    <div class="text-primary-600 text-4xl mb-6 h-12 flex items-center justify-center">
                        <i class="fas fa-tv"></i>                  
                    </div>
                    <h3 class="text-xl font-playfair mb-4 text-primary-700">TV</h3>
                    <p class="text-primary-600">Contamos con TV por cable</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-20 px-6 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="lg:w-1/2 relative">
                    <div class="relative overflow-hidden rounded-sm h-96 lg:h-[500px] w-full">
                        <img src="./assets/images/alberca - copia.jpeg" alt="Hotel Quinta Micaela" class="absolute inset-0 w-full h-full object-cover">
                        <div class="absolute inset-0 image-overlay"></div>
                    </div>
                </div>
                
                <div class="lg:w-1/2">
                    <p class="text-primary-500 tracking-widest mb-3">EL HOTEL</p>
                    <h2 class="text-3xl md:text-4xl font-playfair text-primary-700 mb-6 section-title">Excelencia Redefinida</h2>

                    <p class="text-primary-600 mb-8 leading-relaxed">
                        Descubre el confort y la hospitalidad de primera en el Hotel Quinta Micaela. Ubicado en el corazón de San Luis Acatlán, nuestras elegantes habitaciones y nuestro salón de eventos nos hace tu mejor opción. Nuestro dedicado equipo está listo para hacer de tu estancia una experiencia inolvidable. ¡Ven y disfruta de lo mejor de San Luis Acatlán con nosotros!
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="./pages/reservas/index.php" class="px-8 py-3 btn-primary font-bold rounded-sm">
                            Descubre Nuestras Habitaciones
                        </a>
                        <a href="./pages/galeria/index.php" class="px-8 py-3 btn-outline font-bold rounded-sm">
                            Ver galeria
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Location Section -->
    <section id="contact" class="py-20 px-6 bg-cream">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col lg:flex-row gap-12">
                <div class="lg:w-1/2">
                    <p class="text-primary-500 tracking-widest mb-3">UBICACIÓN PRIVILEGIADA</p>
                    <h2 class="text-3xl md:text-4xl font-playfair text-primary-700 mb-6 section-title">Conectado con lo Mejor</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                        <div>
                            <h3 class="text-xl font-playfair mb-4 text-primary-700">Atracciones</h3>
                            <ul class="space-y-4">
                                <li class="flex items-start">
                                    <i class="fas fa-umbrella-beach text-primary-600 mt-1 mr-3"></i>
                                    <span class="text-primary-600">Plaza Principal de San Luis Acatlán</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-golf-ball text-primary-600 mt-1 mr-3"></i>
                                    <span class="text-primary-600">Iglesia de San Luis Rey</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-shopping-bag text-primary-600 mt-1 mr-3"></i>
                                    <span class="text-primary-600">Mercado Municipal</span>
                                </li>
                            </ul>
                        </div>
                        
                        <div>
                            <h3 class="text-xl font-playfair mb-4 text-primary-700">Contacto</h3>
                            <div class="space-y-4">
                                <div class="flex items-start">
                                    <i class="fas fa-map-marker-alt text-primary-600 mt-1 mr-3"></i>
                                    <span class="text-primary-600">Playa Larga, 41600 San Luis Acatlán, Gro.</span>
                                </div>
                                <div class="flex items-start">
                                    <i class="fas fa-envelope text-primary-600 mt-1 mr-3"></i>
                                    <a href="mailto:QMicaela01@gmail.com" class="text-primary-600 hover:text-primary-800 transition">QMicaela01@gmail.com</a>
                                </div>
                                <div class="flex items-start">
                                    <i class="fas fa-phone-alt text-primary-600 mt-1 mr-3"></i>
                                    <a href="tel:+527411136523" class="text-primary-600 hover:text-primary-800 transition">+52 741-113-6523</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-8">
                        <a href="https://www.google.com/maps/place/Hotel+Quinta+Micaela/@16.8121465,-98.7350555,17z/data=!4m6!3m5!1s0x85c9b9ab0955ae1b:0xb70f095c77b1917b!8m2!3d16.8121414!4d-98.7324752!16s%2Fg%2F11g197z7s_?entry=ttu" target="_blank" class="inline-flex items-center px-6 py-3 btn-outline rounded-sm">
                            <i class="fas fa-map-marked-alt mr-2"></i>
                            Ver en Mapa
                        </a>
                    </div>
                    
                    <div class="card p-6 rounded-sm">
                        <h3 class="text-xl font-playfair mb-4 text-primary-700">Cómo Llegar</h3>
                        <div class="mb-4">
                            <input type="text" id="userLocation" placeholder="Ingresa tu ubicación" class="w-full px-4 py-3 bg-white border border-primary-200 rounded-sm text-primary-700 focus:outline-none focus:ring-1 focus:ring-primary-500 focus:border-primary-500 placeholder-primary-400">
                            <div id="suggestions" class="mt-2 max-h-40 overflow-y-auto bg-white rounded-sm border border-primary-200 hidden"></div>
                        </div>
                        <button onclick="findRoute()" class="w-full px-6 py-3 btn-primary font-bold rounded-sm">
                            Calcular Ruta
                        </button>
                    </div>
                </div>
                
                <div class="lg:w-1/2 h-96 lg:h-[500px] rounded-sm overflow-hidden shadow-lg">
                    <div id="map" class="w-full h-full"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="py-20 px-6 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <p class="text-primary-500 tracking-widest mb-3">GALERÍA</p>
                <h2 class="text-3xl md:text-4xl font-playfair text-primary-700 mb-6 section-title">Nuestros Espacios</h2>
                <p class="text-primary-600 max-w-2xl mx-auto">Una muestra de los ambientes exclusivos que le esperan</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="relative overflow-hidden rounded-sm h-80 group">
                    <img src="./assets/images/EventoXD.jpeg" alt="Spa" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-primary-800 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-8">
                        <h3 class="text-xl font-playfair text-white translate-y-4 group-hover:translate-y-0 transition-transform duration-500">Spa & Wellness</h3>
                    </div>
                </div>
                
                <div class="relative overflow-hidden rounded-sm h-80 group">
                    <img src="./assets/images/evento3.jpeg" alt="Piscina" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-primary-800 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-8">
                        <h3 class="text-xl font-playfair text-white translate-y-4 group-hover:translate-y-0 transition-transform duration-500">Piscina Infinity</h3>
                    </div>
                </div>
                
                <div class="relative overflow-hidden rounded-sm h-80 md:col-span-2 lg:col-span-1 lg:row-span-2 group">
                    <img src="./assets/images/fondo.jpeg" alt="Salón de Eventos" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-primary-800 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-8">
                        <h3 class="text-2xl font-playfair text-white translate-y-4 group-hover:translate-y-0 transition-transform duration-500">Salón de Eventos</h3>
                    </div>
                </div>
                
                <div class="relative overflow-hidden rounded-sm h-80 group">
                    <img src="./assets/images/Establecimiento.jpg" alt="Lobby" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-primary-800 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-8">
                        <h3 class="text-xl font-playfair text-white translate-y-4 group-hover:translate-y-0 transition-transform duration-500">Lobby Principal</h3>
                    </div>
                </div>
                
                <div class="relative overflow-hidden rounded-sm h-80 group">
                    <img src="./assets/images/fondo1.jpeg" alt="Vistas" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-primary-800 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-8">
                        <h3 class="text-xl font-playfair text-white translate-y-4 group-hover:translate-y-0 transition-transform duration-500">Vistas Exclusivas</h3>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-12">
                <a href="./pages/galeria/index.php" class="inline-flex items-center px-8 py-4 btn-primary font-bold rounded-sm transform hover:-translate-y-1 hover:shadow-lg group">
                    <span class="mr-2">Ver Galería Completa</span>
                    <i class="fas fa-images transform group-hover:rotate-12 transition-transform"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-20 px-6 bg-cream">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <p class="text-primary-500 tracking-widest mb-3">SERVICIOS</p>
                <h2 class="text-3xl md:text-4xl font-playfair text-primary-700 mb-6 section-title">Ofrecemos los siguientes servicios</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="card overflow-hidden rounded-sm group">
                    <a href="./pages/reservas/index.php" class="block">
                        <div class="relative h-64 overflow-hidden">
                            <img src="./assets/images/huesped.jpeg" alt="Hospedaje" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-primary-800 via-transparent to-transparent"></div>
                        </div>
                        <div class="p-8">
                            <p class="text-primary-500 tracking-widest mb-2">HOSPEDAJE</p>
                            <h3 class="text-xl font-playfair mb-4 text-primary-700">Habitaciones Exclusivas</h3>
                            <p class="text-primary-600 mb-6">
                                Habitaciones diseñadas con los más altos estándares de confort y elegancia.
                            </p>
                            <div class="flex items-center text-primary-500 group-hover:text-primary-700 transition">
                                <span class="mr-2 font-medium">Explorar Opciones</span>
                                <i class="fas fa-arrow-right transform group-hover:translate-x-2 transition"></i>
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="card overflow-hidden rounded-sm group">
                    <a href="./pages/evento/index.php" class="block">
                        <div class="relative h-64 overflow-hidden">
                            <img src="./assets/images/EventoXD.jpeg" alt="Eventos" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-primary-800 via-transparent to-transparent"></div>
                        </div>
                        <div class="p-8">
                            <p class="text-primary-500 tracking-widest mb-2">EVENTOS</p>
                            <h3 class="text-xl font-playfair mb-4 text-primary-700">Salón de Eventos</h3>
                            <p class="text-primary-600 mb-6">
                                Contamos con un espacio para eventos de todo tipo.
                            </p>
                            <div class="flex items-center text-primary-500 group-hover:text-primary-700 transition">
                                <span class="mr-2 font-medium">Planificar Evento</span>
                                <i class="fas fa-arrow-right transform group-hover:translate-x-2 transition"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Reviews Section -->
    <section class="py-20 px-6 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <p class="text-primary-500 tracking-widest mb-3">OPINIONES</p>
                <h2 class="text-3xl md:text-4xl font-playfair text-primary-700 mb-6 section-title">Lo que dicen nuestros huéspedes</h2>
                <p class="text-primary-600 max-w-2xl mx-auto">Comparte tu experiencia con nosotros</p>
            </div>
            
            <!-- Review Form -->
            <div class="card p-8 rounded-sm mb-16 max-w-2xl mx-auto">
                <h3 class="text-2xl font-playfair mb-6 text-primary-700">Deja tu reseña</h3>
                <form id="reviewForm" action="submit_review.php" method="POST">
                    <div class="mb-6">
                        <label for="nombre" class="block text-primary-600 mb-2">Nombre</label>
                        <input type="text" id="nombre" name="nombre" required class="w-full px-4 py-3 bg-white border border-primary-200 rounded-sm text-primary-700 focus:outline-none focus:ring-1 focus:ring-primary-500 focus:border-primary-500 placeholder-primary-400">
                    </div>
                    <div class="mb-6">
                        <label for="calificacion" class="block text-primary-600 mb-2">Calificación</label>
                        <div class="flex items-center">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <input type="radio" id="star<?php echo $i; ?>" name="calificacion" value="<?php echo $i; ?>" class="hidden" <?php echo $i == 5 ? 'checked' : ''; ?>>
                                <label for="star<?php echo $i; ?>" class="text-2xl cursor-pointer text-primary-300 hover:text-primary-500 transition-colors mr-1">
                                    <i class="far fa-star"></i>
                                </label>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <div class="mb-6">
                        <label for="comentario" class="block text-primary-600 mb-2">Comentario</label>
                        <textarea id="comentario" name="comentario" rows="4" required class="w-full px-4 py-3 bg-white border border-primary-200 rounded-sm text-primary-700 focus:outline-none focus:ring-1 focus:ring-primary-500 focus:border-primary-500 placeholder-primary-400"></textarea>
                    </div>
                    <button type="submit" class="px-8 py-3 btn-primary font-bold rounded-sm">
                        Enviar Reseña
                    </button>
                </form>
            </div>
            
            <!-- Reviews Display -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="reviewsContainer">
                <?php
                $conn = new mysqli("localhost", "root", "567890", "propuesta");
                
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                
                $sql = "SELECT * FROM resenas ORDER BY fecha DESC LIMIT 6";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '
                        <div class="card p-8 rounded-sm">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 rounded-full bg-primary-100 flex items-center justify-center text-xl font-bold text-primary-600 mr-4">' 
                                    . substr($row['nombre'], 0, 1) . 
                                '</div>
                                <div>
                                    <h4 class="font-playfair text-primary-700">' . htmlspecialchars($row['nombre']) . '</h4>
                                    <div class="flex items-center">
                                        ' . str_repeat('<i class="fas fa-star text-primary-500"></i>', $row['calificacion']) . 
                                        str_repeat('<i class="far fa-star text-primary-500"></i>', 5 - $row['calificacion']) . '
                                    </div>
                                </div>
                            </div>
                            <p class="text-primary-600 mb-4">' . nl2br(htmlspecialchars($row['comentario'])) . '</p>
                            <p class="text-primary-400 text-sm">' . date('d M Y', strtotime($row['fecha'])) . '</p>
                        </div>';
                    }
                } else {
                    echo '<p class="text-primary-600 col-span-3 text-center">No hay reseñas aún. ¡Sé el primero en opinar!</p>';
                }
                
                $conn->close();
                ?>
            </div>
        </div>
    </section>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        // Initialize the map
        var map = L.map('map').setView([16.8121414, -98.7324752], 16);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var hotelMarker = L.marker([16.8121414, -98.7324752], {
            icon: L.icon({
                iconUrl: 'https://cdn-icons-png.flaticon.com/512/2776/2776067.png',
                iconSize: [48, 48],
                iconAnchor: [24, 48],
                popupAnchor: [0, -48]
            })
        }).addTo(map)
        .bindPopup('<div class="font-playfair font-bold text-primary-800">Hotel Quinta Micaela</div><div class="text-sm text-primary-600">San Luis Acatlán, Gro.</div>')
        .openPopup();

        function findRoute() {
            var userLocation = document.getElementById('userLocation').value;
            if (userLocation.trim() === "") {
                alert("Por favor ingresa tu ubicación.");
                return;
            }

            if (window.routeLayer) {
                map.removeLayer(window.routeLayer);
                map.eachLayer(function(layer) {
                    if (layer !== hotelMarker && layer instanceof L.Marker) {
                        map.removeLayer(layer);
                    }
                });
            }

            fetch("https://nominatim.openstreetmap.org/search?format=json&q=" + encodeURIComponent(userLocation))
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        var userLat = parseFloat(data[0].lat);
                        var userLon = parseFloat(data[0].lon);
                        
                        var userMarker = L.marker([userLat, userLon], {
                            icon: L.icon({
                                iconUrl: 'https://cdn-icons-png.flaticon.com/512/447/447031.png',
                                iconSize: [36, 36],
                                iconAnchor: [18, 36],
                                popupAnchor: [0, -36]
                            })
                        }).addTo(map)
                        .bindPopup('Tu ubicación: ' + data[0].display_name);
                        
                        fetch(`https://router.project-osrm.org/route/v1/driving/${userLon},${userLat};-98.7324752,16.8121414?overview=full&geometries=geojson`)
                            .then(response => response.json())
                            .then(data => {
                                if (data.routes && data.routes[0]) {
                                    window.routeLayer = L.geoJSON(data.routes[0].geometry, {
                                        style: {
                                            color: '#884E40',
                                            weight: 5,
                                            opacity: 0.9,
                                            dashArray: '10, 10'
                                        }
                                    }).addTo(map);
                                    
                                    var group = new L.featureGroup([hotelMarker, userMarker, window.routeLayer]);
                                    map.fitBounds(group.getBounds(), { padding: [50, 50] });
                                    
                                    var distance = (data.routes[0].distance / 1000).toFixed(1);
                                    var duration = (data.routes[0].duration / 60).toFixed(0);
                                    
                                    var routeInfo = L.control({position: 'bottomleft'});
                                    routeInfo.onAdd = function(map) {
                                        this._div = L.DomUtil.create('div', 'bg-white text-primary-700 p-4 rounded-sm border border-primary-300 shadow-lg');
                                        this._div.innerHTML = `
                                            <h4 class="font-bold text-primary-600 mb-2">Ruta al hotel</h4>
                                            <p class="text-sm mb-1"><i class="fas fa-road mr-2 text-primary-500"></i> Distancia: ${distance} km</p>
                                            <p class="text-sm"><i class="fas fa-clock mr-2 text-primary-500"></i> Tiempo estimado: ${duration} min</p>
                                        `;
                                        return this._div;
                                    };
                                    routeInfo.addTo(map);
                                }
                            });
                    } else {
                        alert("No se encontraron resultados para la ubicación ingresada.");
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert("Ocurrió un error al buscar la ubicación. Por favor intenta nuevamente.");
                });
        }

        // Autocomplete for location input
        document.getElementById('userLocation').addEventListener('input', function() {
            var inputValue = this.value;
            if (inputValue.trim() !== "") {
                fetch("https://nominatim.openstreetmap.org/search?format=json&q=" + encodeURIComponent(inputValue))
                    .then(response => response.json())
                    .then(data => {
                        var suggestions = document.getElementById('suggestions');
                        suggestions.innerHTML = "";
                        
                        if (data.length > 0) {
                            suggestions.classList.remove('hidden');
                            data.slice(0, 5).forEach(function(item) {
                                var suggestionItem = document.createElement('div');
                                suggestionItem.textContent = item.display_name;
                                suggestionItem.classList.add('cursor-pointer', 'p-2', 'hover:bg-primary-100', 'text-primary-700');
                                suggestionItem.addEventListener('click', function() {
                                    document.getElementById('userLocation').value = item.display_name;
                                    suggestions.classList.add('hidden');
                                });
                                suggestions.appendChild(suggestionItem);
                            });
                        } else {
                            suggestions.classList.add('hidden');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        document.getElementById('suggestions').classList.add('hidden');
                    });
            } else {
                document.getElementById('suggestions').classList.add('hidden');
            }
        });
        
        document.addEventListener('click', function(e) {
            if (e.target.id !== 'userLocation') {
                document.getElementById('suggestions').classList.add('hidden');
            }
        });

        // Star rating interaction
        document.querySelectorAll('input[name="calificacion"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const rating = this.value;
                const stars = document.querySelectorAll('label[for^="star"] i');
                
                stars.forEach((star, index) => {
                    if (index < rating) {
                        star.classList.remove('far');
                        star.classList.add('fas');
                    } else {
                        star.classList.remove('fas');
                        star.classList.add('far');
                    }
                });
            });
        });
        
        // AJAX form submission
        document.getElementById('reviewForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch(this.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const reviewsContainer = document.getElementById('reviewsContainer');
                    const newReview = document.createElement('div');
                    newReview.className = 'card p-8 rounded-sm';
                    newReview.innerHTML = `
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 rounded-full bg-primary-100 flex items-center justify-center text-xl font-bold text-primary-600 mr-4">
                                ${data.nombre.charAt(0)}
                            </div>
                            <div>
                                <h4 class="font-playfair text-primary-700">${data.nombre}</h4>
                                <div class="flex items-center">
                                    ${'<i class="fas fa-star text-primary-500"></i>'.repeat(data.calificacion) + 
                                     '<i class="far fa-star text-primary-500"></i>'.repeat(5 - data.calificacion)}
                                </div>
                            </div>
                        </div>
                        <p class="text-primary-600 mb-4">${data.comentario.replace(/\n/g, '<br>')}</p>
                        <p class="text-primary-400 text-sm">${new Date().toLocaleDateString('es-MX', { day: 'numeric', month: 'short', year: 'numeric' })}</p>
                    `;
                    
                    reviewsContainer.prepend(newReview);
                    
                    this.reset();
                    document.querySelector('input[name="calificacion"][value="5"]').checked = true;
                    document.querySelectorAll('label[for^="star"] i').forEach(star => {
                        star.classList.remove('fas');
                        star.classList.add('far');
                    });
                    
                    alert('¡Gracias por tu reseña!');
                } else {
                    alert('Hubo un error al enviar tu reseña. Por favor intenta nuevamente.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Hubo un error al enviar tu reseña. Por favor intenta nuevamente.');
            });
        });
    </script>
</body>
</html>
<?php include("./temp/footer.php"); ?>
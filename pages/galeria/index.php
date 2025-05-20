<?php include("../../temp/header.php"); ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Galería | Hotel Quinta Micaela</title>
  
  <!-- Fuentes y estilos -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  
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
      background-color: var(--color-light);
      color: var(--color-dark);
      margin: 0;
      padding: 0;
      overflow-x: hidden;
    }
    
    /* Header con efecto parallax */
    .gallery-header {
      background: linear-gradient(rgba(88, 46, 36, 0.8), rgba(88, 46, 36, 0.8));
      height: 60vh;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      position: relative;
      overflow: hidden;
    }
    
    .gallery-header::before {
      content: '';
      position: absolute;
      bottom: -50px;
      left: 0;
      width: 100%;
      height: 100px;
      background: var(--color-light);
      transform: skewY(-3deg);
      z-index: 1;
    }
    
    .gallery-title {
      color: var(--color-white);
      text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.6);
      z-index: 2;
    }
    
    .gallery-title h1 {
      font-family: 'Playfair Display', serif;
      font-size: 4rem;
      margin-bottom: 1rem;
      animation: fadeInDown 1.5s;
    }
    
    .gallery-title p {
      font-size: 1.2rem;
      max-width: 700px;
      margin: 0 auto;
      animation: fadeInUp 1.5s;
    }
    
    /* Filtros de categoría */
    .gallery-filters {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 15px;
      padding: 2rem 0;
      background: var(--color-white);
    }
    
    .filter-btn {
      background: transparent;
      border: 2px solid var(--color-primary);
      color: var(--color-primary);
      padding: 0.6rem 1.5rem;
      border-radius: 50px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      text-transform: uppercase;
      font-size: 0.8rem;
      letter-spacing: 1px;
    }
    
    .filter-btn:hover, .filter-btn.active {
      background: var(--color-primary);
      color: var(--color-white);
    }
    
    /* Galería con efecto masonry */
    .gallery-container {
      padding: 3rem 5%;
      background: var(--color-white);
    }
    
    .gallery-grid {
      columns: 4 250px;
      column-gap: 1.5rem;
    }
    
    .gallery-item {
      position: relative;
      margin-bottom: 1.5rem;
      break-inside: avoid;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      transition: all 0.4s ease;
      transform: scale(0.98);
    }
    
    .gallery-item:hover {
      transform: scale(1);
      box-shadow: 0 15px 40px rgba(136, 78, 64, 0.2);
    }
    
    .gallery-img {
      width: 100%;
      height: auto;
      display: block;
      transition: transform 0.5s ease;
    }
    
    .gallery-item:hover .gallery-img {
      transform: scale(1.05);
    }
    
    .gallery-caption {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      background: linear-gradient(to top, rgba(88, 46, 36, 0.8), transparent);
      color: var(--color-white);
      padding: 1.5rem 1rem 1rem;
      transform: translateY(100%);
      transition: transform 0.3s ease;
    }
    
    .gallery-item:hover .gallery-caption {
      transform: translateY(0);
    }
    
    .gallery-caption h3 {
      font-family: 'Playfair Display', serif;
      margin: 0;
      font-size: 1.3rem;
    }
    
    .gallery-caption p {
      margin: 0.5rem 0 0;
      font-size: 0.9rem;
      opacity: 0.8;
    }
    
    /* Lightbox personalizado */
    .lightbox {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(88, 46, 36, 0.95);
      z-index: 1000;
      display: flex;
      align-items: center;
      justify-content: center;
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.3s ease;
    }
    
    .lightbox.active {
      opacity: 1;
      pointer-events: all;
    }
    
    .lightbox-content {
      position: relative;
      max-width: 90%;
      max-height: 90%;
    }
    
    .lightbox-img {
      max-width: 100%;
      max-height: 80vh;
      border-radius: 8px;
      box-shadow: 0 5px 30px rgba(0, 0, 0, 0.6);
    }
    
    .lightbox-caption {
      color: var(--color-white);
      text-align: center;
      margin-top: 1rem;
    }
    
    .lightbox-close {
      position: absolute;
      top: -40px;
      right: 0;
      color: var(--color-white);
      font-size: 2rem;
      cursor: pointer;
      transition: color 0.3s ease;
    }
    
    .lightbox-close:hover {
      color: var(--color-secondary);
    }
    
    .lightbox-nav {
      position: absolute;
      top: 50%;
      width: 100%;
      display: flex;
      justify-content: space-between;
      padding: 0 2rem;
      transform: translateY(-50%);
    }
    
    .lightbox-btn {
      color: var(--color-white);
      font-size: 2.5rem;
      cursor: pointer;
      background: rgba(88, 46, 36, 0.7);
      width: 60px;
      height: 60px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
    }
    
    .lightbox-btn:hover {
      background: var(--color-primary-light);
      transform: scale(1.1);
    }
    
    /* Responsive */
    @media (max-width: 768px) {
      .gallery-header {
        height: 50vh;
      }
      
      .gallery-title h1 {
        font-size: 2.5rem;
      }
      
      .gallery-grid {
        columns: 2 200px;
      }
      
      .lightbox-btn {
        width: 50px;
        height: 50px;
        font-size: 2rem;
      }
    }
  </style>
</head>

<body>

  <!-- Header con efecto parallax -->
  <header class="gallery-header">
    <div class="gallery-title animate__animated animate__fadeIn">
      <h1>Nuestra Galería</h1>
      <p>Descubre los rincones y experiencias exclusivas del Hotel Quinta Micaela</p>
    </div>
  </header>

  <!-- Filtros de categoría -->
  <div class="gallery-filters">
    <button class="filter-btn active" data-filter="all">Todo</button>
    <button class="filter-btn" data-filter="instalaciones">Instalaciones</button>
    <button class="filter-btn" data-filter="habitaciones">Habitaciones</button>
    <button class="filter-btn" data-filter="eventos">Eventos</button>
    <button class="filter-btn" data-filter="alrededores">Alrededores</button>
  </div>

  <!-- Galería con efecto masonry -->
  <section class="gallery-container">
    <div class="gallery-grid">
      <!-- Item 1 -->
      <div class="gallery-item" data-category="instalaciones">
        <img src="../../assets/images/Establecimiento.jpg" alt="Nuestro establecimiento" class="gallery-img">
        <div class="gallery-caption">
          <h3>Nuestro Establecimiento</h3>
          <p>Arquitectura tradicional con toques modernos</p>
        </div>
      </div>
      
      <!-- Item 2 -->
      <div class="gallery-item" data-category="habitaciones">
        <img src="../../assets/images/huesped.jpeg" alt="Habitación estándar" class="gallery-img">
        <div class="gallery-caption">
          <h3>Habitación Estándar</h3>
          <p>Comodidad y elegancia para tu estancia</p>
        </div>
      </div>
      
      <!-- Item 3 -->
      <div class="gallery-item" data-category="eventos">
        <img src="../../assets/images/EventoXD.jpeg" alt="Salón de eventos" class="gallery-img">
        <div class="gallery-caption">
          <h3>Salón de Eventos</h3>
          <p>Espacio perfecto para tus celebraciones</p>
        </div>
      </div>
      
      <!-- Item 4 -->
      <div class="gallery-item" data-category="instalaciones">
        <img src="../../assets/images/alberca - copia.jpeg" alt="Área de alberca" class="gallery-img">
        <div class="gallery-caption">
          <h3>Área de Alberca</h3>
          <p>Disfruta de nuestro espacio acuático</p>
        </div>
      </div>
      
      <!-- Item 5 -->
      <div class="gallery-item" data-category="alrededores">
        <img src="../../assets/images/Zocalo.jpg" alt="Zócalo de San Luis Acatlán" class="gallery-img">
        <div class="gallery-caption">
          <h3>Zócalo Municipal</h3>
          <p>Corazón de San Luis Acatlán</p>
        </div>
      </div>
      
      <!-- Item 6 -->
      <div class="gallery-item" data-category="eventos">
        <img src="../../assets/images/evento3.jpeg" alt="Evento social" class="gallery-img">
        <div class="gallery-caption">
          <h3>Evento Social</h3>
          <p>Celebraciones memorables en nuestro hotel</p>
        </div>
      </div>
      
      <!-- Item 7 -->
      <div class="gallery-item" data-category="alrededores">
        <img src="../../assets/images/Jardin.jpg" alt="Jardín central" class="gallery-img">
        <div class="gallery-caption">
          <h3>Jardín Central</h3>
          <p>Patrimonio cultural de la región</p>
        </div>
      </div>
      
      <!-- Item 8 -->
      <div class="gallery-item" data-category="instalaciones">
        <img src="../../assets/images/fondo.jpeg" alt="Vista del hotel" class="gallery-img">
        <div class="gallery-caption">
          <h3>Vista del Hotel</h3>
          <p>Nuestras instalaciones desde otra perspectiva</p>
        </div>
      </div>
      
      <!-- Item 9 -->
      <div class="gallery-item" data-category="habitaciones">
        <img src="../../assets/images/fondo1.jpeg" alt="Habitación premium" class="gallery-img">
        <div class="gallery-caption">
          <h3>Habitación Premium</h3>
          <p>Mayor espacio y comodidades exclusivas</p>
        </div>
      </div>
      
      <!-- Item 10 -->
      <div class="gallery-item" data-category="instalaciones">
        <img src="../../assets/images/Villa.jpg" alt="Villa privada" class="gallery-img">
        <div class="gallery-caption">
          <h3>Villa Privada</h3>
          <p>Espacio exclusivo para eventos especiales</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Lightbox para ver imágenes en grande -->
  <div class="lightbox" id="lightbox">
    <div class="lightbox-content">
      <span class="lightbox-close">&times;</span>
      <img src="" alt="" class="lightbox-img">
      <div class="lightbox-caption">
        <h3></h3>
        <p></p>
      </div>
    </div>
    <div class="lightbox-nav">
      <div class="lightbox-btn" id="prev-btn"><i class="fas fa-chevron-left"></i></div>
      <div class="lightbox-btn" id="next-btn"><i class="fas fa-chevron-right"></i></div>
    </div>
  </div>

  <!-- Scripts para funcionalidad -->
  <script>
    // Filtrado de categorías
    const filterBtns = document.querySelectorAll('.filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');
    
    filterBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        // Activar botón seleccionado
        filterBtns.forEach(btn => btn.classList.remove('active'));
        btn.classList.add('active');
        
        const filter = btn.dataset.filter;
        
        // Filtrar elementos
        galleryItems.forEach(item => {
          if (filter === 'all' || item.dataset.category === filter) {
            item.style.display = 'block';
            item.classList.add('animate__animated', 'animate__fadeIn');
          } else {
            item.style.display = 'none';
          }
        });
      });
    });
    
    // Lightbox
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.querySelector('.lightbox-img');
    const lightboxCaption = document.querySelector('.lightbox-caption');
    const lightboxTitle = lightboxCaption.querySelector('h3');
    const lightboxDesc = lightboxCaption.querySelector('p');
    const closeBtn = document.querySelector('.lightbox-close');
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');
    
    let currentIndex = 0;
    const items = Array.from(galleryItems);
    
    // Abrir lightbox
    galleryItems.forEach((item, index) => {
      item.addEventListener('click', () => {
        currentIndex = index;
        updateLightbox();
        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden';
      });
    });
    
    // Cerrar lightbox
    closeBtn.addEventListener('click', () => {
      lightbox.classList.remove('active');
      document.body.style.overflow = 'auto';
    });
    
    // Navegación
    prevBtn.addEventListener('click', () => {
      currentIndex = (currentIndex - 1 + items.length) % items.length;
      updateLightbox();
    });
    
    nextBtn.addEventListener('click', () => {
      currentIndex = (currentIndex + 1) % items.length;
      updateLightbox();
    });
    
    // Teclado
    document.addEventListener('keydown', (e) => {
      if (lightbox.classList.contains('active')) {
        if (e.key === 'Escape') {
          lightbox.classList.remove('active');
          document.body.style.overflow = 'auto';
        } else if (e.key === 'ArrowLeft') {
          currentIndex = (currentIndex - 1 + items.length) % items.length;
          updateLightbox();
        } else if (e.key === 'ArrowRight') {
          currentIndex = (currentIndex + 1) % items.length;
          updateLightbox();
        }
      }
    });
    
    // Actualizar lightbox
    function updateLightbox() {
      const item = items[currentIndex];
      const imgSrc = item.querySelector('img').src;
      const title = item.querySelector('h3').textContent;
      const desc = item.querySelector('p').textContent;
      
      lightboxImg.src = imgSrc;
      lightboxTitle.textContent = title;
      lightboxDesc.textContent = desc;
      
      // Efecto de transición
      lightboxImg.style.opacity = 0;
      setTimeout(() => {
        lightboxImg.style.opacity = 1;
      }, 100);
    }
    
    // Efecto de carga inicial
    document.addEventListener('DOMContentLoaded', () => {
      galleryItems.forEach((item, i) => {
        setTimeout(() => {
          item.classList.add('animate__animated', 'animate__fadeIn');
        }, i * 100);
      });
    });
  </script>

</body>

<?php include "../../temp/footer.php"; ?>

</html>
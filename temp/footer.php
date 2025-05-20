<style>
  footer a {
    transition: all 0.3s ease;
  }
  footer a:hover {
    color: #884E40;
    transform: translateY(-2px);
  }
  .social-icon {
    transition: all 0.3s ease;
  }
  .social-icon:hover {
    background: #884E40;
    color: white;
    transform: translateY(-3px);
  }
</style>

<footer class="bg-primary-800 text-white pt-12 pb-8">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
      <!-- Columna 1: Información del hotel -->
      <div>
        <h4 class="text-xl font-playfair font-bold mb-6 text-white border-b border-primary-500 pb-2 inline-block">
          Hotel Quinta Micaela
        </h4>
        <p class="text-primary-100 mt-4 leading-relaxed">
          Somos un hotel comprometido socialmente con las personas, ofreciendo los mejores servicios de la costa.
          ¡Somos tu mejor opción!
        </p>
      </div>

      <!-- Columna 2: Servicios -->
      <div>
        <h6 class="text-lg font-playfair font-bold mb-6 text-white border-b border-primary-500 pb-2 inline-block">
          Servicios
        </h6>
        <ul class="space-y-3 text-primary-100">
          <li class="flex items-start">
            <i class="fas fa-chevron-right text-primary-500 mr-2 mt-1 text-xs"></i>
            <span>Renta Mensual</span>
          </li>
          <li class="flex items-start">
            <i class="fas fa-chevron-right text-primary-500 mr-2 mt-1 text-xs"></i>
            <span>Eventos Sociales</span>
          </li>
          <li class="flex items-start">
            <i class="fas fa-chevron-right text-primary-500 mr-2 mt-1 text-xs"></i>
            <span>Hospedaje por noche</span>
          </li>
        </ul>
      </div>

      <!-- Columna 3: Contacto -->
      <div>
        <h6 class="text-lg font-playfair font-bold mb-6 text-white border-b border-primary-500 pb-2 inline-block">
          Contacto
        </h6>
        <div class="space-y-4 text-primary-100">
          <div class="flex items-start">
            <i class="fas fa-map-marker-alt text-primary-500 mr-3 mt-1"></i>
            <span>Playa Larga, 41600 San Luis Acatlán, Gro.</span>
          </div>
          <div class="flex items-start">
            <i class="fas fa-envelope text-primary-500 mr-3 mt-1"></i>
            <a href="mailto:QMicaela01@gmail.com" class="hover:text-primary-300">
              QMicaela01@gmail.com
            </a>
          </div>
          <div class="flex items-start">
            <i class="fas fa-phone-alt text-primary-500 mr-3 mt-1"></i>
            <a href="tel:+527411136523" class="hover:text-primary-300">+52 741-113-6523</a>
          </div>
        </div>
      </div>

      <!-- Columna 4: Redes Sociales -->
      <div>
        <h6 class="text-lg font-playfair font-bold mb-6 text-white border-b border-primary-500 pb-2 inline-block">
          Síguenos
        </h6>
        <div class="flex space-x-4">
          <a href="https://es-la.facebook.com/" target="_blank" class="social-icon bg-white text-primary-700 w-10 h-10 rounded-full flex items-center justify-center">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="#" target="_blank" class="social-icon bg-white text-primary-700 w-10 h-10 rounded-full flex items-center justify-center">
            <i class="fab fa-instagram"></i>
          </a>
          <a href="#" target="_blank" class="social-icon bg-white text-primary-700 w-10 h-10 rounded-full flex items-center justify-center">
            <i class="fab fa-whatsapp"></i>
          </a>
        </div>
        
        <!-- Horario -->
        <div class="mt-8">
          <h6 class="text-lg font-playfair font-bold mb-3 text-white border-b border-primary-500 pb-2 inline-block">
            Horario
          </h6>
          <p class="text-primary-100">
            <i class="fas fa-clock text-primary-500 mr-2"></i> 24 horas / 7 días
          </p>
        </div>
      </div>
    </div>

    <!-- Derechos de autor -->
    <div class="border-t border-primary-700 mt-12 pt-6 text-center text-primary-300 text-sm">
      <p>&copy; <?php echo date('Y'); ?> Hotel Quinta Micaela. Todos los derechos reservados.</p>
    </div>
  </div>
</footer>
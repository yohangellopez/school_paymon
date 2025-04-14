<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paymon - Sistema de Gestión Académica</title>
    @vite('resources/css/app.css', 'resources/js/app.js')
    @livewireStyles

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <style>
        .course-card:hover .course-overlay {
            opacity: 1;
        }
        .enrollment-steps li.completed {
            @apply border-green-500 bg-green-50;
        }
    </style>

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body class="pl-0 pt-0 bg-slate-50">
    <nav class="bg-white shadow-lg fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="flex-shrink-0 flex items-center">
                        <img class="h-8 w-auto" src="{{ asset('img/logo.png') }}" alt="Paymon Logo">
                        <span class="ml-2 text-xl font-bold text-gray-800">Paymon Academy</span>
                    </a>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#courses" class="text-gray-600 hover:text-blue-600 transition-colors">Cursos</a>
                    <a href="#academies" class="text-gray-600 hover:text-blue-600 transition-colors">Academias</a>
                    <a href="#contact" class="text-gray-600 hover:text-blue-600 transition-colors">Contacto</a>
                    <a href="{{ route('login') }}" 
                       class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                        Acceso Administrador
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <header class="pt-20 pb-24 bg-gradient-to-r from-blue-600 to-blue-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
                Transformando la Educación con Excelencia
            </h1>
            <p class="text-xl text-blue-100 mb-8 max-w-3xl mx-auto">
                Descubre nuestra oferta académica y comienza tu camino hacia el éxito profesional
            </p>
            
            <!-- Estadísticas destacadas -->
            <div class="grid md:grid-cols-3 gap-8 text-white mb-12">
                <div class="bg-white/10 p-6 rounded-xl">
                    <div class="text-3xl font-bold mb-2">+150</div>
                    <div class="text-sm">Cursos Disponibles</div>
                </div>
                <div class="bg-white/10 p-6 rounded-xl">
                    <div class="text-3xl font-bold mb-2">+5K</div>
                    <div class="text-sm">Estudiantes Activos</div>
                </div>
                <div class="bg-white/10 p-6 rounded-xl">
                    <div class="text-3xl font-bold mb-2">98%</div>
                    <div class="text-sm">Satisfacción</div>
                </div>
            </div>
        </div>
    </header>


    <section class="section main-section">
        {{ $slot }}
    </section>

    <footer class="bg-gray-900 text-gray-300 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h4 class="text-lg font-semibold mb-4">Paymon Academy</h4>
                    <p class="text-sm">Transformando la educación mediante soluciones innovadoras y accesibles.</p>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-sm">
                © 2024 Paymon. Yohangel Lopez Todos los derechos reservados.
            </div>
        </div>
    </footer>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script>
        document.getElementById('menu-toggle').addEventListener('click', function() {
            var menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        document.getElementById('user-menu-toggle').addEventListener('click', function(event) {
            var userMenu = document.getElementById('user-dropdown-menu');
            userMenu.classList.toggle('show');
            event.stopPropagation(); // Prevents the document click event from closing the menu immediately
        });

        // Close the user menu if clicked outside
        document.addEventListener('click', function(event) {
            var userMenu = document.getElementById('user-dropdown-menu');
            var userMenuButton = document.getElementById('user-menu-toggle');
            if (!userMenu.contains(event.target) && !userMenuButton.contains(event.target)) {
                userMenu.classList.remove('show');
            }
        });
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>


    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>


    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>
    @livewireScripts
    <script>
        // Scripts para interactividad
        document.addEventListener('livewire:load', function() {
            Livewire.on('enrollmentCompleted', (data) => {
                Swal.fire({
                    icon: 'success',
                    title: '¡Matrícula Exitosa!',
                    html: `Recibirás un correo de confirmación en <strong>${data.email}</strong>`,
                    confirmButtonText: 'Aceptar'
                });
            });
        });
    </script>
</body>


</html>

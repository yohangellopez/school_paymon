<x-frontend>
    <div>
         <!-- Sección de Academias y Cursos -->
        <section class="py-16 bg-white" id="courses">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Nuestra Oferta Académica</h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">Selecciona entre nuestras diferentes academias y cursos disponibles</p>
                </div>

                @livewire('frontend.course-selector')
            </div>
        </section>

        <!-- Proceso de Matrícula -->
        <section class="py-16 bg-gray-50" id="enrollment">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Matricúlate en 3 Pasos</h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">Un proceso simple y seguro para comenzar tu formación</p>
                </div>

                <ol class="enrollment-steps grid md:grid-cols-3 gap-8 mb-12">
                    <li class="p-6 border-2 border-dashed border-gray-200 rounded-lg text-center">
                        <div class="w-12 h-12 bg-blue-600 text-white rounded-full mx-auto mb-4 flex items-center justify-center">1</div>
                        <h3 class="text-lg font-semibold mb-2">Selecciona tu Curso</h3>
                        <p class="text-gray-600">Explora nuestra oferta académica y elige el programa que mejor se adapte a tus necesidades</p>
                    </li>
                    <!-- Pasos 2 y 3 similares -->
                </ol>

                @livewire('frontend.enrollment-form')
            </div>
        </section>

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
    </div>
</x-frontend>

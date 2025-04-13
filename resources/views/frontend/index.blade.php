<x-frontend>
    <div>
        <!-- Carousel Start -->
        <div class="container-fluid p-0 mb-5 pb-5">
            <div id="header-carousel" class="carousel slide carousel-fade" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#header-carousel" data-slide-to="1"></li>
                    <li data-target="#header-carousel" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item position-relative active" style="min-height: 100vh;">
                        <img class="position-absolute w-100 h-100" src="{{ asset('img/home_1.jpg') }}"
                            style="object-fit: cover;">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 900px;">
                                <h6 class="text-white text-uppercase mb-3 animate__animated animate__fadeInDown"
                                    style="letter-spacing: 3px;">Estudia en</h6>
                                <h3 class="display-3 text-capitalize text-white mb-3">Unidad Educativa Teresa Carreño
                                </h3>
                                <p class="mx-md-5 px-5">Accede a formación de calidad y transforma el mundo
                                    con una enseñanza de calidad .</p>
                                <a class="btn btn-outline-light py-3 px-4 mt-3 animate__animated animate__fadeInUp"
                                    href="#">consulta aqui</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item position-relative" style="min-height: 100vh;">
                        <img class="position-absolute w-100 h-100" src="{{ asset('img/home_2.jpg') }}"
                            style="object-fit: cover;">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 900px;">
                                <h6 class="text-white text-uppercase mb-3 animate__animated animate__fadeInDown"
                                    style="letter-spacing: 3px; ">Profesores de calidad</h6>
                                <h3 class="display-3 text-capitalize text-white mb-3">Tnemos un gran variedad de
                                    mentores de calidad
                                </h3>
                                <p class="mx-md-5 px-5">No pierdas esta oportunidad de ser parte de nuestra enseñanza
                                    unica.</p>
                                <a class="btn btn-outline-light py-3 px-4 mt-3 animate__animated animate__fadeInUp"
                                    target="_blank" href="#">Mas
                                    Informacion</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item position-relative" style="min-height: 100vh;">
                        <img class="position-absolute w-100 h-100" src="{{ asset('img/home_3.jpg') }}"
                            style="object-fit: cover;">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 900px;">
                                <h6 class="text-white text-uppercase mb-3 animate__animated animate__fadeInDown"
                                    style="letter-spacing: 3px;">Tu Espacio de Aprendizaje</h6>
                                <h3 class="display-3 text-capitalize text-white mb-3">Desarrolla tu Potencial en
                                    Teresa Carreño </h3>
                                <p class="mx-md-5 px-5">
                                    tenemos materiales de calidad y sobre todo buen ambiente para que puedan
                                    desenvolverse
                                </p>
                                <a class="btn btn-outline-light py-3 px-4 mt-3 animate__animated animate__fadeInUp"
                                    href="#">Ver vacantes</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Carousel End -->
        <!-- About Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <div class="row align-items-center">
                    <div class="col-lg-6 pb-5 pb-lg-0">
                        <img class="img-fluid w-100 h-100" src="#" alt="">
                    </div>
                    <div class="col-lg-6">
                        <h6 class="d-inline-block text-primary text-uppercase bg-light py-1 px-2">About Us</h6>
                        <h1 class="mb-4">Impacto de NovaCursos</h1>
                        <p class="pl-4 border-left border-primary">En NovaCursos, hemos transformado la educación
                            para que
                            sea accesible y efectiva. A lo largo de nuestra trayectoria, hemos ayudado a miles de
                            estudiantes a alcanzar sus metas profesionales mediante formación especializada y
                            certificación
                            reconocida. Nuestro compromiso es seguir brindando oportunidades de aprendizaje a todos.
                        </p>
                        <div class="row pt-3">
                            <div class="col-6">
                                <div class="bg-light text-center p-4">
                                    <h3 class="display-4 text-primary" data-toggle="counter-up">+10,000</h3>
                                    <h6 class="text-uppercase"> Estudiantes Capacitados</h6>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-light text-center p-4">
                                    <h3 class="display-4 text-primary" data-toggle="counter-up">+999</h3>
                                    <h6 class="text-uppercase">Cursos Disponibles y Certificados</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->

        <!-- Open Hours Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <div class="row">
                    <div class="col-lg-6" style="min-height: 500px;">
                        <div class="position-relative h-100">
                            <img class="position-absolute w-100 h-100" src="{{ asset('img/history.jpg') }}"
                                style="object-fit: cover;">
                        </div>
                    </div>
                    <div class="col-lg-6 pt-5 pb-lg-5">
                        <div class="hours-text bg-light p-4 p-lg-5 my-lg-5">
                            <h6 class="d-inline-block text-white text-uppercase bg-primary py-1 px-2">Historia</h6>
                            <h1 class="mb-4">Hitos Clave en Nuestra Historia</h1>
                            <p>Descubre algunos de los momentos clave que han definido nuestro crecimiento y éxito
                                en
                                NovaCursos. Cada fecha representa un paso importante en nuestro compromiso con la
                                formación
                                y el desarrollo profesional.</p>
                            <ul class="list-inline">
                                <li class="h6 py-1"><i class="far fa-circle text-primary mr-3"></i>1,000
                                    Inscripciones -
                                    Abril 2021</li>
                                <li class="h6 py-1"><i class="far fa-circle text-primary mr-3"></i>Primera
                                    Certificación
                                    Internacional - Julio 2022</li>
                                <li class="h6 py-1"><i class="far fa-circle text-primary mr-3"></i>Reforma de
                                    Plataforma -
                                    Octubre 2023</li>
                            </ul>
                            <a href="#" class="btn btn-primary mt-2">Estudiar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Open Hours End -->

        <!-- Team Start -->
        <div class="container-fluid py-5">
            <div class="container pt-5">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-6">
                        <h6 class="d-inline-block bg-light text-primary text-uppercase py-1 px-2">Nuestros
                            Especialistas
                        </h6>
                        <h1 class="mb-5">Especialistas en Cada Rubro</h1>
                        <p>En NovaCursos, contamos con un equipo de expertos en diversas áreas para garantizar una
                            formación
                            de alta calidad. Nuestros cursos están diseñados y dictados por profesionales con
                            experiencia
                            real en cada campo, brindándote la mejor preparación para tu carrera.</p>
                        <br>
                    </div>
                </div>
                <div class="row justify-content-center">

                    {{-- @foreach ($randomExhibitors as $randomExhibitor)
                    <div class="col-lg-3 col-md-6">
                        <div class="team position-relative overflow-hidden mb-5">
                            @if ($randomExhibitor->photo)
                                <img src="" alt="Imagen del servicio"
                                    style="max-width: 100%; max-height: 100%;">
                            @else
                                <img src="  " alt="Imagen predeterminada"
                                    style="max-width: 100%; max-height: 100%;">
                            @endif
                            <div class="position-relative text-center">
                                <div class="team-text bg-primary text-white">
                                    <h5 class="text-white ">{{ $randomExhibitor->prefix }}
                                        {{ $randomExhibitor->name }} {{ $randomExhibitor->last_name }}</h5>
                                    <p class="m-0">{{ $randomExhibitor->type_service }}</p>
                                </div>
                                <div class="team-social bg-dark text-center">
                                    <a class="btn btn-outline-primary btn-square mr-2" target="_blank"
                                        href="{{ $randomExhibitor->link }}"><i class="fas fa-file-alt"></i></a>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach --}}
                    {{-- <div class="col-lg-3 col-md-6">
                    <div class="team position-relative overflow-hidden mb-5">
                        <img class="img-fluid" src="img/team-1.jpg" alt="">
                        <div class="position-relative text-center">
                            <div class="team-text bg-primary text-white">
                                <h5 class="text-white text-uppercase">Olivia Mia</h5>
                                <p class="m-0">Spa & Beauty Expert</p>
                            </div>
                            <div class="team-social bg-dark text-center">
                                <a class="btn btn-outline-primary btn-square mr-2" href="#"><i
                                        class="fab fa-twitter"></i></a>
                                <a class="btn btn-outline-primary btn-square mr-2" href="#"><i
                                        class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-outline-primary btn-square mr-2" href="#"><i
                                        class="fab fa-linkedin-in"></i></a>
                                <a class="btn btn-outline-primary btn-square" href="#"><i
                                        class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="team position-relative overflow-hidden mb-5">
                        <img class="img-fluid" src="img/team-2.jpg" alt="">
                        <div class="position-relative text-center">
                            <div class="team-text bg-primary text-white">
                                <h5 class="text-white text-uppercase">Cory Brown</h5>
                                <p class="m-0">Spa & Beauty Expert</p>
                            </div>
                            <div class="team-social bg-dark text-center">
                                <a class="btn btn-outline-primary btn-square mr-2" href="#"><i
                                        class="fab fa-twitter"></i></a>
                                <a class="btn btn-outline-primary btn-square mr-2" href="#"><i
                                        class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-outline-primary btn-square mr-2" href="#"><i
                                        class="fab fa-linkedin-in"></i></a>
                                <a class="btn btn-outline-primary btn-square" href="#"><i
                                        class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="team position-relative overflow-hidden mb-5">
                        <img class="img-fluid" src="img/team-3.jpg" alt="">
                        <div class="position-relative text-center">
                            <div class="team-text bg-primary text-white">
                                <h5 class="text-white text-uppercase">Elizabeth Ross</h5>
                                <p class="m-0">Spa & Beauty Expert</p>
                            </div>
                            <div class="team-social bg-dark text-center">
                                <a class="btn btn-outline-primary btn-square mr-2" href="#"><i
                                        class="fab fa-twitter"></i></a>
                                <a class="btn btn-outline-primary btn-square mr-2" href="#"><i
                                        class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-outline-primary btn-square mr-2" href="#"><i
                                        class="fab fa-linkedin-in"></i></a>
                                <a class="btn btn-outline-primary btn-square" href="#"><i
                                        class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="team position-relative overflow-hidden mb-5">
                        <img class="img-fluid" src="img/team-4.jpg" alt="">
                        <div class="position-relative text-center">
                            <div class="team-text bg-primary text-white">
                                <h5 class="text-white text-uppercase">Kelly Walke</h5>
                                <p class="m-0">Spa & Beauty Expert</p>
                            </div>
                            <div class="team-social bg-dark text-center">
                                <a class="btn btn-outline-primary btn-square mr-2" href="#"><i
                                        class="fab fa-twitter"></i></a>
                                <a class="btn btn-outline-primary btn-square mr-2" href="#"><i
                                        class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-outline-primary btn-square mr-2" href="#"><i
                                        class="fab fa-linkedin-in"></i></a>
                                <a class="btn btn-outline-primary btn-square" href="#"><i
                                        class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div> --}}
                </div>
            </div>
        </div>
        <!-- Team End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
    </div>
</x-frontend>

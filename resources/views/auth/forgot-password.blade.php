<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>
    <meta charset="UTF-8">
    <title>
        SevenCrown Hotel Panel administrativo
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Plantilla de administración y panel de control premium y multipropósito" name="description">
    <meta content="Themesbrand" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Layout config Js -->
    <script src="{{ asset('assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    
    <!--Recaptcha-->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <div class="auth-page-wrapper pt-5">
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>
            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="index.html" class="d-inline-block auth-logo">
                                    <img src="{{ asset('assets/images/seven_crown_logo.png') }}"
                                    alt="" height="100">
                                </a>
                            </div>
                            <p class="mt-3 fs-15 fw-medium">Panel de Recuperación de Contraseña</p>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">¿Olvidaste tu contraseña?</h5>

                                    <lord-icon src="https://cdn.lordicon.com/rhvddzym.json" trigger="loop" colors="primary:#0ab39c" class="avatar-xl"></lord-icon>

                                </div>

                                <div class="alert alert-borderless alert-warning text-center mb-2 mx-2" role="alert">
                                    Ingresa tu correo electrónico para enviar las instrcciones.
                                </div>
                                <div class="p-2">
                                    <form action="{{ route('forgot.password.email') }}" method="POST"
                                    onsubmit="validateLogin(event, '{{App\Models\Setting::first()->google_recaptcha}}')">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label" for="email">Correo Electrónico</label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Ingrese su correo electrónico" required>
                                        </div>
                                         
                                        @if(App\Models\Setting::first()->google_recaptcha)
                                        <div class="g-recaptcha my-4" data-sitekey="{{App\Models\Setting::first()->google_recaptcha_public_key}}"></div>
                                        @endif

                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" type="submit">Restablecer Contraseña</button>
                                        </div>
                                    </form><!-- end form -->
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="mt-4 text-center">
                            <p class="mb-0"><a href="/" class="fw-semibold text-primary text-decoration-underline">Volver</a></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <script>document.write(new Date().getFullYear())</script> Hoteles Seven Crown panel administrador. Crafted with <i class="mdi mdi-heart text-danger"></i> by DevcoBaja
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <!-- particles js -->
    <script src="{{ asset('assets/libs/particles.js/particles.js') }}"></script>
    <!-- particles app js -->
    <script src="{{ asset('assets/js/pages/particles.app.js') }}"></script>
    <!-- password create init -->
    <script src="{{ asset('assets/js/pages/passowrd-create.init.js') }}"></script>

    <script>
        document.oncontextmenu = function(){ return false }

        function validateLogin(e, active){
            
            if(!active){ return true }

            if (grecaptcha.getResponse()){
                return true
            }else{
                e.preventDefault();
                Swal.fire(
                    '',
                    'Es necesario verificar el google reCaptcha',
                    'warning'
                )
                return false;
            }
        }
        console.clear();
        var cssRule =
            "color: rgb(0, 0, 0);" +
            "font-size: 60px;" +
            "font-weight: bold;" +
            "text-shadow: 1px 1px 5px rgb(0, 0, 0);" +
            "filter: dropshadow(color=rgb(0, 0, 0), offx=1, offy=1);";
        console.log("%c¡Detente!", cssRule);
        setTimeout(console.log.bind(console, '%cEsta función del navegador está pensada para desarrolladores. Si alguien te indicó que copiaras y pegaras algo aquí para habilitar una función de E-commerce o para ´hackear´ la cuenta de alguien, se trata de un fraude. Si lo haces, esta persona podrá acceder a tu cuenta.', 'color: #9e202ad1;font-size: 30px;'), 0);
    </script>
</body>
</html>

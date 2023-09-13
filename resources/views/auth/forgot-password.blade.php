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
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <script src="assets/js/layout.js"></script>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css">
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
                                    <form action="{{ route('forgot.password.email') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label" for="email">Correo Electrónico</label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Ingrese su correo electrónico" required>
                                        </div>
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
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/libs/particles.js/particles.js"></script>
    <script src="assets/js/pages/particles.app.js"></script>
    <script src="assets/js/pages/password-create.init.js"></script>
</body>
</html>

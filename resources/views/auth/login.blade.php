<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="{{ asset('be/assets/img/favicon.png') }}">
    <title>Login - Madura Mart</title>
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('be/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('be/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('be/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('be/assets/css/soft-ui-dashboard.css?v=1.0.7') }}" rel="stylesheet" />
</head>

<body class="">
    <main class="main-content mt-0">
        <section>
            <div class="page-header min-vh-75">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header pb-0 text-left bg-transparent">
                                    <h3 class="font-weight-bolder text-primary text-gradient">Welcome back</h3>
                                    <p class="mb-0">Enter your email and password to sign in</p>
                                </div>
                                <div class="card-body">
                                    
                                    @if ($errors->any())
                                    <div class="alert alert-danger text-sm text-white py-2" role="alert">
                                        @foreach($errors->all() as $e) {{ $e }}<br> @endforeach
                                    </div>
                                    @endif
        
                                    @if(session('error'))
                                    <div class="alert alert-danger text-sm text-white py-2">{{ session('error') }}</div>
                                    @endif
        
                                    @if(session('success'))
                                    <div class="alert alert-success text-sm text-white py-2">{{ session('success') }}</div>
                                    @endif

                                    <form role="form" method="POST" action="/login">
                                        @csrf
                                        <label>Email</label>
                                        <div class="mb-3">
                                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="email-addon" required autofocus>
                                        </div>
                                        <label>Password</label>
                                        <div class="mb-3">
                                            <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon" required>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
                                            <label class="form-check-label" for="rememberMe">Remember me</label>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn bg-gradient-primary w-100 mt-4 mb-0">Sign in</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">
                                        Don't have an account?
                                        <a href="{{ route('register') }}" class="text-primary text-gradient font-weight-bold">Sign up</a>
                                    </p>
                                    
                                    <div class="mt-2 text-start p-3 bg-light rounded shadow-sm">
                                        <p class="text-xs font-weight-bold text-dark mb-1">Demo Admin Akun:</p>
                                        <p class="text-xs mb-0">Email: <code>admin@123.com</code></p>
                                        <p class="text-xs mb-0">Password: <code>Admin123!</code></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('{{ asset('be/assets/img/curved-images/curved6.jpg') }}')"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Core JS Files -->
    <script src="{{ asset('be/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('be/assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('be/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('be/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Control Center for Soft Dashboard -->
    <script src="{{ asset('be/assets/js/soft-ui-dashboard.min.js?v=1.0.7') }}"></script>
</body>

</html>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="{{ asset('be/assets/img/favicon.png') }}">
    <title>Daftar - Madura Mart</title>
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
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent mt-4">
        <div class="container">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-white" href="#">
                Madura Mart
            </a>
        </div>
    </nav>
    <!-- End Navbar -->
    <main class="main-content mt-0">
        <section class="min-vh-100 mb-8">
            <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('{{ asset('be/assets/img/curved-images/curved14.jpg') }}');">
                <span class="mask bg-gradient-dark opacity-6"></span>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 text-center mx-auto">
                            <h1 class="text-white mb-2 mt-5">Welcome!</h1>
                            <p class="text-lead text-white">Create new account for Madura Mart in a few clicks.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row mt-lg-n10 mt-md-n11 mt-n10">
                    <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                        <div class="card z-index-0">
                            <div class="card-header text-center pt-4">
                                <h5>Register</h5>
                            </div>
                            <div class="card-body">
                                @if ($errors->any())
                                <div class="alert alert-danger text-sm text-white py-2" role="alert">
                                    @foreach($errors->all() as $e) {{ $e }}<br> @endforeach
                                </div>
                                @endif

                                <form role="form text-left" method="POST" action="/register">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Name" aria-label="Name" aria-describedby="email-addon" required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="email-addon" required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" name="password" class="form-control" placeholder="Password (Min. 8 char, Large, Number)" aria-label="Password" aria-describedby="password-addon" required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" aria-label="Password" aria-describedby="password-addon" required>
                                    </div>
                                    <div class="form-check form-check-info text-left">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            I agree the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and Conditions</a>
                                        </label>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign up</button>
                                    </div>
                                    <p class="text-sm mt-3 mb-0">Already have an account? <a href="{{ route('login') }}" class="text-dark font-weight-bolder">Sign in</a></p>
                                </form>
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

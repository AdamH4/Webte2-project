<!DOCTYPE html>
<html lang="sk">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        @livewireStyles
        @yield ('title')
        {{-- <link rel="icon" href="{{ asset('kobera_logo.jpg') }}" type="image/gif" sizes="16x16"> --}}
        {{-- <script>
        window.myToken = <?php echo json_encode(['csrfToken' => csrf_token()]) ?>
        </script> --}}
          <!-- Bootstrap core CSS -->
        <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- Custom fonts for this template -->
        <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/simple-line-icons/css/simple-line-icons.css') }}" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <!-- Custom styles for this template -->
        <link href="{{ asset('frontend/css/app.css') }}" rel="stylesheet">
        @yield ('head')
  </head>
  <body>
    @include('sweet::alert')
    <!-- Navigation -->
        <nav class="navbar navbar-light bg-light static-top">
            <div class="container">
                <div class="wrapper-logo">
                    <a href="{{ route('home') }}"><img src="{{ asset('frontend/img/logo.svg') }}" alt="Examio" class="logo"></a>
                </div>
                @yield('header')
            </div>
        </nav>

      </form>
    @yield('content')


    <!-- Footer -->
    <footer class="footer bg-light">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
            <p class="text-muted small mb-4 mb-lg-0">&copy; 2021 Z??vere??n?? projekt</p>
          </div>
          <div class="col-lg-6 h-100 text-center text-lg-right my-auto">
            <small>Attila Mucska, Imrich Budinsk??, Emma ??avojov??, Adam Harn????ek, Samuel Kobera</small>
          </div>
        </div>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/js/app.js') }}"></script>
    @livewireScripts
    @yield ('bottom-script')
</body>
</html>

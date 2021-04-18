<!DOCTYPE html>
<html lang="sk">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        @yield ('title')
        {{-- <link rel="icon" href="{{ asset('kobera_logo.jpg') }}" type="image/gif" sizes="16x16"> --}}
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
        {{-- <script>
        window.myToken = <?php echo json_encode(['csrfToken' => csrf_token()]) ?>
        </script> --}}
        @yield ('head')
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                
            </nav>
            @yield ('content')
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
        @yield ('bottom-script')
    </body>
</html>
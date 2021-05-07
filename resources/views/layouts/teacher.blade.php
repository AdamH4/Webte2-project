<!doctype html>
<html lang="en">
 <head>
 <!-- Required meta tags -->
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">

 <!-- CoreUI CSS -->
 <link rel="stylesheet" href="https://unpkg.com/@coreui/coreui/dist/css/coreui.min.css" crossorigin="anonymous">
 <link href="{{ asset('frontend/css/app.css') }}" rel="stylesheet">

 {{-- <title>Administrácia učiteľa</title> --}}
@livewireStyles
 @yield('head')
 </head>
 <body class="c-app">
    <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
      <div class="c-sidebar-brand d-lg-down-none">
       <img src="{{ asset('img/logo-white.svg') }}" class="logo" width="100px">
      </div>
      <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="index.html">
        {{-- <li class="c-sidebar-nav-title">Theme</li> --}}
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('teacher.exams') }}">Testy</a></li>
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('teacher.examsFinished') }}">Testy ukončené</a></li>
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="colors.html"> Colors</a></li>
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="typography.html">Typography</a></li>
      </ul>
      <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
    </div>
    <div class="c-wrapper c-fixed-components">
      @include('layouts.partials.teacher-header')
      <div class="c-body">
        <main class="c-main">
          <div class="container-fluid">
            <div class="fade-in">
                @yield('content')
            </div>
          </div>
        </main>
        <footer class="c-footer">
          <div><a href="https://coreui.io">CoreUI</a> &copy; 2020 Záverečné zadanie.</div>
          <div class="ml-auto">Powered by&nbsp;<a href="https://coreui.io/">CoreUI</a></div>
        </footer>
      </div>
    </div>
 <!-- Optional JavaScript -->
 <!-- Popper.js first, then CoreUI JS -->
 <script src="https://unpkg.com/@popperjs/core@2"></script>
 <script src="https://unpkg.com/@coreui/coreui/dist/js/coreui.min.js"></script>
@livewireScripts
 @yield('bottom-scripts')
 </body>
</html>
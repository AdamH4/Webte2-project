@extends('layouts.student')

@section('header')
        @auth
        <a class="btn btn-register" href="{{ route('teacher.dashboard') }}">Administrácia</a>
        @else 
        <a class="btn btn-register" href="{{ route('register') }}">Registrácia</a>
        @endauth
@endsection

@section('content')
<section class="landing-login">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-4">
                <h1 class="landing-login__title">
                    Pre spustenie <span>examio</span> testu je potrebné prihlásenie.
                </h1>
                <div class="landing-login__panel panel">
                    <ul class="nav nav-pills nav-fill navtop">
                        <li class="nav-item">
                            <a class="nav-link active" href="#student" data-toggle="tab" id="student-tab">
                                <img src="{{ asset('frontend/img/student.svg') }}" class="mr-2" alt="Študent" width="20px" id="student-icon">
                                <img src="{{ asset('frontend/img/student-hover.svg') }}" class="mr-2" alt="Študent" width="20px" id="student-icon-hover">
                                ŠTUDENT
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link second" href="#ucitel" data-toggle="tab" id="teacher-tab">
                                <img src="{{ asset('frontend/img/teacher.svg') }}" class="mr-2" alt="Učiteľ" width="20px" id="teacher-icon">
                                <img src="{{ asset('frontend/img/teacher-hover.svg') }}" class="mr-2" alt="Učitel" width="20px" id="teacher-icon-hover">
                                UČITEĽ
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" role="tabpanel" id="student">
                            @include('landing.partials.student-login')
                        </div>
                        <div class="tab-pane" role="tabpanel" id="ucitel">
                            @include('landing.partials.teacher-login')
                        </div>
                    </div>
                </div>
                <img src="{{ asset('frontend/img/bubble.svg') }}" alt="Bublinka" class="landing-login__bubble">
            </div>
            <div class="col-12 col-lg-8 text-right">
                <img src="{{ asset('frontend/img/graphics.svg') }}" alt="Ucitel" width="80%">
            </div>
        </div>
    </div>
</section>
@endsection
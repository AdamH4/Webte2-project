@extends('layouts.student')

@section('content')
<section class="register">
    <div class="container">
        <div class="row p-3">
            <div class="col-12 col-lg-4 offset-lg-4 register__panel mb-5">
                <div class="register__panel-title mt-3">
                    <img src="{{ asset('frontend/teacher.svg') }}" width="20px" class="d-inline mr-3">
                    <h1>registrácia učiteľa</h1>
                </div>
                <div class="form">
                    <form action="{{ route('register') }}" method="POST">
                      @csrf
                      <div class="form-group">
                        <input type="text" class="form-control form__input" name="name" id="meno" aria-describedby="menoHelp" placeholder="Meno">
                        {{-- <small id="menoHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                      </div>
                      <div class="form-group">
                          <input type="text" class="form-control form__input" name="surname" id="priezvisko" aria-describedby="menoHelp" placeholder="Priezvisko">
                          {{-- <small id="menoHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                      </div>
                      <div class="form-group">
                          <input type="email" class="form-control form__input" name="email" id="email" aria-describedby="emailHelp" placeholder="E-mail">
                          {{-- <small id="menoHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                      </div>
                      <div class="form-group">
                        <input type="password" class="form-control form__input" name="password" id="password" aria-describedby="passwordHelp" placeholder="Heslo">
                        {{-- <small id="menoHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                    </div>
                      <div class="form-group text-center mt-5 mb-5">       
                          <button type="submit" class="btn btn-login">ZAREGISTROVAŤ</button>
                      </div>
                      </form>
                  </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
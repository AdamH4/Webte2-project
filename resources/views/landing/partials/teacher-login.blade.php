@auth 
<div class="row">
  <div class="col-12 text-center">
    <div class="alert alert-info">
      Už ste prihlásený.
    </div>
    <a class="btn btn-register" href="{{ route('teacher.dashboard') }}">Administrácia</a>
  </div>
</div>
@else
<div class="form">
  <form action="{{ route('login') }}" method="POST">
    @csrf
      <div class="form-group">
        <input type="email" class="form-control form__input" id="e-mail" name="email" aria-describedby="menoHelp" placeholder="E-mail">
        {{-- <small id="menoHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
      </div>
      <div class="form-group">
          <input type="password" class="form-control form__input" name="password" id="password" aria-describedby="passwordHelp" placeholder="Heslo">
          {{-- <small id="menoHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
      </div>
      <div class="form-group text-center">       
          <button type="submit" class="btn btn-login">PRIHLÁSIŤ SA</button>
      </div>
    </form>
</div>
@endauth
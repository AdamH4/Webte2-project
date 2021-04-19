<div class="form">
    <form action="" method="POST">
        <div class="form-group">
          <input type="text" class="form-control form__input" id="meno" aria-describedby="menoHelp" placeholder="Meno">
          {{-- <small id="menoHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
        </div>
        <div class="form-group">
            <input type="text" class="form-control form__input" id="priezvisko" aria-describedby="menoHelp" placeholder="Priezvisko">
            {{-- <small id="menoHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
        </div>
        <div class="form-group">
            <input type="text" class="form-control form__input" id="ais" aria-describedby="menoHelp" placeholder="Identifikačné číslo študenta">
            {{-- <small id="menoHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
        </div>
        <div class="form-group">
            <div class="row align-items-center">
                <div class="col-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                              <img src="{{ asset('frontend/img/key.svg') }}" width="10px">
                          </div>
                        </div>
                        <input type="text" class="form-control form__input form__input--key" id="key" placeholder="Kľúč">
                      </div>
                    {{-- <input type="text" class="form-control form__input form__input--key" id="key" aria-describedby="aisHelp" placeholder="Kľúč"> --}}
                </div>
                <div class="col-6 text-right">
                    <button type="submit" class="btn btn-login">SPUSTIŤ TEST</button>
                </div>
            </div>
        </div>
      </form>
</div>
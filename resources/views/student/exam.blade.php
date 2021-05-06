@extends('layouts.student')

@section('title')
    <title>Test</title>
@endsection

@section('header')
    <div class="timer-form">
        <div class="timer-form__wrapper">
            <img src="{{ asset('frontend/img/clock.svg')}}" alt="Clock">
            <b id="timer">00:00:00</b>
        </div>
        <button type="submit" class="btn btn-login" id="examFormButton">Odoslať test</button>
    </div>
@endsection

@section('content')
    <section class="questions">
        <div class="container">
            <form action="{{ route('exam.done', $exam->id) }}" method="POST" id="examForm">
                @csrf
                <div class="row">
                    <div class="col-12 col-lg-10 mb-5">
                        <div class="questions__card">
                                <div class="questions__section">
                                    <div class="question__text">
                                        1. Vyberte na akej hodnote sa ustali prechodova charakteristika systemu
                                    </div>
                                    <div class="question__answer-title">
                                        Odpoved:
                                    </div>
                                    <div class="question__points">
                                        (1B)
                                    </div>
                                    <div class="question__answer">
                                        @include('components.questions.select-answer')
                                    </div>
                                </div>
                                <hr class="question__delimeter">
                                <div class="questions__section">
                                    <div class="question__text">
                                        2. S akym sklonom bude koncit aplitudova funkcia alebo aj moj zivot? :D Ziadne opustaci len nemam lorem ipsum generator package
                                    </div>
                                    <div class="question__answer-title">
                                        Odpoved:
                                    </div>
                                    <div class="question__points">
                                        (4B)
                                    </div>
                                    <div class="question__answer">
                                        @include('components.questions.short-answer')
                                    </div>
                                </div>
                                <hr class="question__delimeter">
                                <div class="questions__section">
                                    <div class="question__text">
                                        3. Namalujte nam nieco prekrasne nech sa potesime ! <3
                                    </div>
                                    <div class="question__answer-title">
                                        Odpoved:
                                    </div>
                                    <div class="question__points">
                                        (2B)
                                    </div>
                                    <div class="question__answer">
                                        @include("components.questions.draw-answer")
                                    </div>
                                </div>
                                <hr class="question__delimeter">
                                <div class="questions__section">
                                    <div class="question__text">
                                        4.Vypocitajme si spolu nieco
                                    </div>
                                    <div class="question__answer-title">
                                        Odpoved:
                                    </div>
                                    <div class="question__points">
                                        (1B)
                                    </div>
                                    <div class="question__answer">
                                        @include("components.questions.math-answer")
                                    </div>
                                </div>
                                <hr class="question__delimeter">
                                <div class="questions__section">
                                    <div class="question__text">
                                        5. Spojte co sa vam paci a co nie :)
                                    </div>
                                    <div class="question__answer-title">
                                        Odpoved:
                                    </div>
                                    <div class="question__points">
                                        (1B)
                                    </div>
                                    <div class="question__answer">
                                        @include("components.questions.pair-answer")
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@section("bottom-script")

<script>
    const timerElement = document.getElementById("timer")
    const examFormElement = document.getElementById("examForm")
    const examFormButton = document.getElementById("examFormButton")
    const testDuration = 10 // tu pride z PHP dlzka testu v [sec]

    const numberToStringWithTwoChars= (number) => {
        return ("0" + number).slice(-2)
    }

    // make nice time string from seconds
    const parseTime = (seconds) => {
        var hours = Math.floor((seconds % (60 * 60 * 24)) / (60 * 60))
        var minutes = Math.floor((seconds % (60 * 60)) / (60))
        var seconds = Math.floor(seconds % 60)
        return `${numberToStringWithTwoChars(hours)}:${numberToStringWithTwoChars(minutes)}:${numberToStringWithTwoChars(seconds)}`
    }

    let durationLeft = testDuration
    timerElement.innerHTML = parseTime(testDuration)
    const interval = setInterval(function() {
      durationLeft--
      timerElement.innerHTML = parseTime(durationLeft)
      if((durationLeft === testDuration * 0.1 || durationLeft <= 60)
        && timerElement.style.color !== "rgb(239, 71, 96)"){
          timerElement.style.color = "#ef4760"
      }
      if (durationLeft === 0) {
          clearInterval(interval)
          console.log("TIME IS UP!")
          // TODO: Production odosli formular cas vyprsal
          //examFormElement.submit();
      }
    }, 1000);

    const painterro = window.Painterro({
        id: "drawingCanvas",
        hiddenTools: ['close', 'rotate', 'crop', 'zoomin', 'zoomout', 'resize', 'open'],
        defaultTool: 'brush',
        onChange: (image) => {
            const input = document.getElementById("painteroInputId")
            input.value = image.image.asDataURL()
        }

    })
    painterro.show()

    const mathLiveInput = document.getElementById("mathLiveInput")
    const mathField = new window.MathLive.MathfieldElement({
        virtualKeyboardMode: "manual",
        virtualKeyboardLayout: "dvorak",
    })
    mathField.addEventListener("input", () => {
        mathLiveInput.value = mathField.value
        console.log(mathLiveInput.value)
    })
    document.getElementById("mathLive").appendChild(mathField)


     // -------------------------- Listeners -----------------------------------------
     examFormButton.addEventListener('click', () => { examFormElement.submit() });

    //-------------------------------- Leave tab, page is not visible -------------------------
    document.addEventListener('visibilitychange', onVisibilityChange);


    //-------------------------------- Functions -------------------------
    function onVisibilityChange(e) {
        //Ak leavne tab
        if(document.hidden) {
            changeStatusOfExam('left');
        } else {
            changeStatusOfExam('writing');
        }
    }

    function changeStatusOfExam(status) {
        fetch('/exam/change/'+ status)
        .then(function(response) {
            console.log(response)
        })
        .then(function(myJson) {
            console.log(myJson);
        });
    }

</script>
@endsection

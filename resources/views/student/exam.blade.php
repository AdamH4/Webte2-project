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
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-10 mb-5">
                        <div class="questions__card">
                            @foreach ($questions as $question)
                                <div class="questions__section">
                                    <div class="question__text">
                                        {{$question->question->question}}
                                    </div>
                                    <div class="question__answer-title">
                                        Odpoved:
                                    </div>
                                    <div class="question__points">
                                        ({{$question->points}}B)
                                    </div>
                                    <div class="question__answer">
                                        @switch($question->type)
                                            @case("draw_answer")
                                                @include("components.questions.draw-answer")
                                                @break
                                            @case("math_answer")
                                                @include("components.questions.math-answer")
                                                @break
                                            @case("pair_answer")
                                                @include("components.questions.pair-answer")
                                                @break
                                            @case("select_answer")
                                                @include("components.questions.select-answer")
                                                @break
                                            @case("short_answer")
                                                @include("components.questions.short-answer")
                                                @break
                                            @default
                                        @endswitch
                                    </div>
                                </div>
                                <hr class="question__delimeter">
                            @endforeach
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
    const exam = @json($exam);
    let testDuration = Math.round(Math.abs(((new Date(exam.end)).getTime() / 1e3) - ((new Date()).getTime() / 1e3)))

    const numberToStringWithTwoChars= (number) => {
        return ("0" + number).slice(-2)
    }

    //filter specified type of questions
    const filterQuestionsByType = (questions, types) => {
        let filter = {}
        questions.forEach(question => {
            if(types.includes(question.type)){
                if(Array.isArray(filter[question.type])){
                    filter[question.type].push(question)
                }else{
                    filter[question.type] = [question]
                }
            }
        })
        return filter
    }
    const filteredQuestions = filterQuestionsByType(exam.questions, ["draw_answer", "math_answer"])

    // make nice time string from seconds
    const timeToHourString = (seconds) => {
        var hours = Math.floor((seconds % (60 * 60 * 24)) / (60 * 60))
        var minutes = Math.floor((seconds % (60 * 60)) / (60))
        var seconds = Math.floor(seconds % 60)
        return `${numberToStringWithTwoChars(hours)}:${numberToStringWithTwoChars(minutes)}:${numberToStringWithTwoChars(seconds)}`
    }

    let durationLeft = testDuration
    timerElement.innerHTML = timeToHourString(testDuration)
    const interval = setInterval(function() {
      durationLeft--
      timerElement.innerHTML = timeToHourString(durationLeft)
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

    if(filteredQuestions.draw_answer != undefined) {
    filteredQuestions.draw_answer.forEach(question => {
        const painterro = window.Painterro({
            id: `drawingCanvas${question.id}`,
            hiddenTools: ['close', 'rotate', 'crop', 'zoomin', 'zoomout', 'resize', 'open'],
            defaultTool: 'brush',
            onChange: (image) => {
                const input = document.getElementById(`painteroInput${question.id}`)
                input.value = image.image.asDataURL()
            }

        })
        painterro.show()
    })
}

if(filteredQuestions.draw_answer != undefined) {
    filteredQuestions.math_answer.forEach(question => {
        const mathLiveInput = document.getElementById(`mathLiveInput${question.id}`)
        const mathField = new window.MathLive.MathfieldElement({
            virtualKeyboardMode: "manual",
            virtualKeyboardLayout: "dvorak",
        })
        mathField.addEventListener("input", () => {
            mathLiveInput.value = mathField.value
        })
        document.getElementById(`mathLive${question.id}`).appendChild(mathField)
    })
}



     // -------------------------- Listeners -----------------------------------------
     examFormButton.addEventListener('click', () => { 
        examFormElement.submit() 
        console.log('lol') });

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

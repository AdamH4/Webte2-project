@extends('layouts.student')

@section('title')
    <title>Test</title>
@endsection

@section('content')
    <section class="questions">
        <div class="container">
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
        </div>
    </section>
@endsection

@section("bottom-script")

<script>
    const painterro = window.Painterro({
        id: "drawingCanvas",
        hiddenTools: ['close', 'rotate', 'crop', 'zoomin', 'zoomout', 'resize', 'open'],
        defaultTool: 'brush',
        onChange: (image) => {
            const input = document.getElementById("painteroInputId")
            input.value = image.image.asDataURL()
            console.log(input.value)

        }

    })
    painterro.show()


    const mathField = new window.MathLive.MathfieldElement({
        virtualKeyboardMode: "manual",
        virtualKeyboardLayout: "dvorak",
    })
    document.getElementById("mathLive").appendChild(mathField)

</script>
@endsection

@extends ('layouts.teacher')

@section ('head')
<title>Zoznam odpovedí - Examio</title>
@endsection

@section ('content')
    <section>
        <div class="row">
            <div class="col-12">
                <h2>Test - Vyhodnotenie študenta - {{ $student->fullname }}</h2>
            </div>
        </div>
    </section>
    <section class="questions">
        <div class="container-fluid">
            <form action="{{ route("teacher.exams_reviews.update_points", [$exam->id, $student->id])}}" method="POST" id="examForm">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-12 mb-5">
                        <div class="questions__card">
                            @foreach ($questions as $question)
                                <div class="questions__section">
                                    <div class="question__text">
                                        {{$question->questionDecoded->question}}
                                    </div>
                                    <div class="question__answer-title">
                                        Odpoveď:
                                    </div>
                                    <div class="points__section">
                                        <input id="{{"points-" . $question->id}}" name="points[{{$question->answer->id}}]"
                                            class="form-control"
                                            {{-- max="{{$question->points}}" --}}
                                            min="0"
                                            step="0.5"
                                            type="number" value="{{$question->answer->points}}"
                                        >
                                        <label for="{{"points-" . $question->id}}">{{"/" . $question->points}}</label>
                                    </div>
                                    <div class="question__answer">
                                        @switch($question->type)
                                            @case("draw_answer")
                                                <img style="width:100%;border:1px solid" src="{{$question->answer->answer}}" alt="student's image">
                                                @break
                                            @case("math_answer")
                                                <div class="math__container">
                                                    <div id="{{"mathLive" . $question->id}}"></div>
                                                </div>
                                                @break
                                            @case("pair_answer")
                                                <div class="pair__answers">
                                                    @forelse ($question->questionDecoded->options->right as $rightKey => $right)
                                                        <div class="answer">
                                                            <span>{{$rightKey}}</span>
                                                            {{-- {{dd($question->question)}} --}}
                                                            @forelse ($question->answer->answerDecoded as $leftKey => $option)
                                                                @if($option->rightKey == $rightKey)
                                                                    <input class="form-control form__input pair__input" placeholder="{{$leftKey}}" disabled type="number">
                                                                @endif
                                                                @empty 
                                                                <input class="form-control form__input pair__input" placeholder="" disabled type="number">
                                                            @endforelse
                                                        </div>
                                                        @empty
                                                        
                                                    @endforelse
                                                </div>
                                                <div class="pair__options">
                                                    <ul class="first__group">
                                                        @foreach ($question->questionDecoded->options->right as $rightOption )
                                                            <li>{{$rightOption}}</li>
                                                        @endforeach
                                                    </ul>
                                                    <ul class="second__group">
                                                        @foreach ($question->questionDecoded->options->left as $left)
                                                            <li>{{$left}}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                @break
                                            @case("select_answer")
                                                <div class="text-center question__select">
                                                    @foreach ($question->questionDecoded->options as $optionKey => $option)
                                                        <input
                                                            disabled
                                                            class="checkbox__question"
                                                            type="checkbox"
                                                            id="{{"select" . $question->id . "-" . $optionKey}}"
                                                            {{isset($question->answer->answerDecoded->$optionKey) ? 'checked disabled' : 'disabled' }}
                                                        >
                                                        <label for="{{"select" . $question->id . "-" . $optionKey}}">{{$option}}</label>
                                                    @endforeach
                                                </div>
                                                @break
                                            @case("short_answer")
                                                <textarea class="form-control form__input" placeholder="{{$question->answer->answer}}" disabled ></textarea>
                                                @break
                                            @default
                                        @endswitch
                                    </div>
                                </div>
                                <hr class="question__delimeter">
                            @endforeach
                            <div class="row m-3">
                                <div class="col">
                                    <button type="submit" class="btn btn-outline-primary col">Uložiť hodnotenie</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@section ('bottom-scripts')
<script>
    const exam = @json($exam);

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

    // render all math answers
    filteredQuestions.math_answer.forEach(question => {
        const mathLiveInput = document.getElementById(`mathLiveInput${question.id}`)
        const mathField = new window.MathLive.MathfieldElement({
            readOnly: true
        })
        mathField.value = question.answer.answer
        document.getElementById(`mathLive${question.id}`).appendChild(mathField)
    })

</script>

@endsection

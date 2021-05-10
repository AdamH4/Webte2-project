@extends ('layouts.teacher')

@section ('head')
<title>Zoznam odpovedí - Examio</title>
@endsection

@section ('content')

	<div class="container">

		@foreach ($questions as $question)
            <div class="answer__review">
                <div>
                    @if (gettype(json_decode($question->question)) == "object")
                        {{json_decode($question->question)->question}}
                    @endif
                </div>
                <div>
                    <p><b>Zadana odpoved:</b></p>
                    @if($question->type == "draw_answer")
                        <div>Draw</div>
                        <img src="https://www.example.com/images/dinosaur.jpg" alt="student's image">
                    @endif
                    @if($question->type == "math_answer")
                        <div class="math__container">
                            <div id="{{"mathLive" . $question->id}}"></div>
                        </div>
                    @endif
                    @if($question->type == "select_answer")
                        {{-- {{dd(json_decode($question->question))}} --}}
                        {{-- @foreach (json_decode($question->question)->question->options as $option )
                            <input disabled type="checkbox" id="{{"select" . $question->id}}" name="answers[select][{{$question->id}}][]">
                            <label for="{{"select" . $question->id}}">{{$option}}</label>
                        @endforeach --}}
                    @endif
                    @if($question->type == "pair_answer")
                        <div>Pair</div>
                    @endif
                    @if($question->type == "short_answer")
                        <textarea class="form-control" value="Short answer"></textarea>
                    @endif
                    <p>{{ $answers->firstWhere('question_id', $question->id) }}</p>

                </div>
                <div class="points__section">
                    <input id="{{"points-" . $question->id}}" class="form-control" max="2" min="0" type="number" value="2">
                    <label for="{{"points-" . $question->id}}">{{"/" . $question->points}}</label>
                </div>
            </div>



		@endforeach

	</div>

@endsection

@section ('bottom-scripts')
<script>
    const exam = @json($exam);
    const answers = @json($answers);

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
    console.log(answers)

    // render all math answers
    filteredQuestions.math_answer.forEach(question => {
        const mathLiveInput = document.getElementById(`mathLiveInput${question.id}`)
        const mathField = new window.MathLive.MathfieldElement({
            readOnly: true
        })
        mathField.value = "f(x) = y^2"
        document.getElementById(`mathLive${question.id}`).appendChild(mathField)
    })

</script>

@endsection

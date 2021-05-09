@extends ('layouts.teacher')

@section ('head')
<title>Zoznam testov - Examio</title>
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
                    @endif
                    @if($question->type == "math_answer")
                        <div>Math</div>
                    @endif
                    @if($question->type == "select_answer")
                        <div>Select</div>
                    @endif
                    @if($question->type == "pair_answer")
                        <div>Pair</div>
                    @endif
                    @if($question->type == "short_answer")
                        <div>Short</div>
                    @endif
                    <p>{{ $answers->firstWhere('question_id', $question->id) }}</p>

                </div>
                <div>
                    <input class="form-control" max="2" min="0" type="number" value="2">
                    <span>{{"/" . $question->points}}</span>
                </div>
            </div>



		@endforeach

	</div>

@endsection

@section ('bottom-script')

@endsection

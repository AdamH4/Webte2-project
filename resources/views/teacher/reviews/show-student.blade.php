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
                        <img src="https://www.example.com/images/dinosaur.jpg" alt="student's image">
                    @endif
                    @if($question->type == "math_answer")
                        <div>Math</div>
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

@section ('bottom-script')

@endsection

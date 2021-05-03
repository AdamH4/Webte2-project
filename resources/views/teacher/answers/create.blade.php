@extends ('layouts.teacher')

@section ('head')
<title>Vytváranie odpovede - Examio</title>
@endsection

@section ('content')

	<div class="container">

		<h4>Pridávanie správnej odpovede k otázke {{ $qt->question }}</h4>

		<form action="{{ route('teacher.questions.answers.create', [$exam, $qt]) }}" method="POST">
			@csrf

			@if ($qt->type == 'short_answer')
				<div class="form-group">
	                <label for="answer">Odpoveď</label>
	                <input class="form-control" name="answer" required>
	            </div>
			@elseif ($qt->type == 'select_answer')
				b
			@elseif ($qt->type == 'pair_answer')
				c
			@endif

			<button type="submit" class="btn btn-primary">Uložiť</button>

		</form>

	</div>

@endsection

@section ('bottom-script')

@endsection
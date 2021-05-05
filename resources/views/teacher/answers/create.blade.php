@extends ('layouts.teacher')

@section ('head')
<title>Vytváranie odpovede - Examio</title>
@endsection

@section ('content')

	<div class="container">

		<h4>Pridávanie správnej odpovede k otázke</h4>
		<h4>{{ $qt->questionHuman }}</h4>

		<form action="{{ route('teacher.questions.answers.create', [$exam, $qt]) }}" method="POST">
			@csrf

			<div class="form-group">
	            <label for="points">Počet bodov za túto odpoveď</label>
	            <input type="number" class="form-control" name="points" required step="0.01">
	        </div>

			@if ($qt->type == 'short_answer')
				<div class="form-group">
	                <label for="answer">Odpoveď</label>
	                <input class="form-control" name="answer" required>
	            </div>
			@elseif ($qt->type == 'select_answer')

				@foreach ($qt->questionDecoded->options as $option)
		            <div class="custom-control custom-checkbox my-3">
						<input type="checkbox"
							class="custom-control-input" id="{{ $option }}" name="select_answers[]" value="{{ $option }}"
						>
						<label class="custom-control-label" for="{{ $option }}">{{ $option }}</label>
					</div>
				@endforeach

			@elseif ($qt->type == 'pair_answer')

				<div class="row">
					<div class="col">
						@foreach ($qt->questionDecoded->options->left as $option)
				            <div class="custom-control custom-checkbox my-3">
								<input type="checkbox"
									class="custom-control-input" id="{{ $option }}" name="select_answers[]" value="{{ $option }}"
								>
								<label class="custom-control-label" for="{{ $option }}">{{ $option }}</label>
							</div>
						@endforeach
					</div>
					<div class="col">
						@foreach ($qt->questionDecoded->options->right as $option)
				            <div class="custom-control custom-checkbox my-3">
								<input type="checkbox"
									class="custom-control-input" id="{{ $option }}" name="select_answers[]" value="{{ $option }}"
								>
								<label class="custom-control-label" for="{{ $option }}">{{ $option }}</label>
							</div>
						@endforeach
					</div>
				</div>

			@endif

			<button type="submit" class="btn btn-primary">Uložiť</button>

		</form>

	</div>

@endsection

@section ('bottom-script')

@endsection
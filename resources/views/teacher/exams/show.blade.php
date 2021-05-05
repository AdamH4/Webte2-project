@extends ('layouts.teacher')

@section ('head')
<title>{{ $exam->title }} - Examio</title>
@endsection

@section ('content')

	<div class="container">

		<h4>Test {{ $exam->title }}</h4>

		<div class="row m-3">
			<div class="col">
				<a href="{{ route('teacher.questions.create', $exam) }}" class="btn btn-outline-primary col">Pridať otázku</a>
			</div>

			<div class="col">
				<a href="{{ route('teacher.exams.edit', $exam) }}" class="btn btn-outline-secondary col">Upraviť test</a>
			</div>

			<div class="col">
				<button type="button" class="btn btn-outline-danger col" data-toggle="modal" data-target="#deleteExamModal">
  					Zmazať test
				</button>
			</div>
		</div>
		
		{{-- <div class="row">
			<div class="col-sm-6"> --}}
				<h5>Otázky</h5>				
			{{-- </div>
			<div class="col-sm-6">
				<h5>Správne odpovede</h5>
			</div>
		</div> --}}

		<div class="row">
			@foreach ($exam->questionsWithCorrectAnswers as $qt)
				<div class="col-sm-12">
					<div class="card">
						<div class="card-body">
							@if ($qt->type == 'select_answer')
								<h5 class="card-title">{{ $qt->questionDecoded->question }}</h5>
								<p class="card-text">{{ $qtTypes[$qt->type] . ' za ' . $qt->points . ' b.' }}</p>
								<p class="card-text">Možnosti: {{ $qt->getSelectOptionsStr() }}</p>
							@elseif ($qt->type == 'pair_answer')
								<h5 class="card-title">{{ $qt->questionDecoded->question }}</h5>
								<p class="card-text">{{ $qtTypes[$qt->type] . ' za ' . $qt->points . ' b.' }}</p>
								<p class="card-text">Ľavá strana: {{ $qt->getLeftsideOptionsStr() }}</p>
								<p class="card-text">Pravá strana: {{ $qt->getRightsideOptionsStr() }}</p>
							@else
								<h5 class="card-title">{{ $qt->questionDecoded->question }}</h5>
								<p class="card-text">{{ $qtTypes[$qt->type] . ' za ' . $qt->points . ' b.' }}</p>
							@endif
							@if ($qt->type != 'draw_answer' && $qt->type != 'math_answer')
								<a href="{{ route('teacher.questions.answers.create', [$exam, $qt]) }}" class="btn btn-primary mx-1">
									Pridať odpoveď
								</a>
							@endif
							<a href="{{ route('teacher.questions.edit', [$exam, $qt]) }}" class="btn btn-secondary mx-1">Upraviť</a>
							<form action="{{ route('teacher.questions.edit', [$exam, $qt]) }}" method="POST" class="d-inline-block mx-1">
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger">Odstrániť</button>
							</form>
						</div>
					</div>
				</div>
				
				@foreach ($qt->correctAnswers as $ans)
					<div class="col-sm-6">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">{{ $ans->answerHuman }}</h5>
								<p class="card-text">Počet bodov: {{ $ans->points }}</p>
								{{-- <a href="{{ route('teacher.questions.edit', [$exam, $qt]) }}" class="btn btn-primary mx-1">Upraviť</a>
								<form action="{{ route('teacher.questions.edit', [$exam, $qt]) }}" method="POST" class="d-inline-block mx-1">
									@csrf
									@method('DELETE')
									<button type="submit" class="btn btn-danger">Odstrániť</button>
								</form> --}}
							</div>
						</div>
					</div>
				@endforeach
			@endforeach
		</div>

	</div>

	<div class="modal fade" id="deleteExamModal" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Potvrdenie vymazania</h5>
					<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					Určite chcete vymazať test <strong>{{ $exam->title }}</strong>?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Nie</button>
					<form action="{{ route('teacher.exams.show', $exam) }}" method="POST">
						@csrf
						@method('DELETE')
						<button type="submit" class="btn btn-danger">Vymazať</button>
					</form>
				</div>
			</div>
		</div>
	</div>

@endsection

@section ('bottom-script')

@endsection
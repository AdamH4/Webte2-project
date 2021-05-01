@extends ('layouts.teacher')

@section ('head')
<title>{{ $exam->title }} - Examio</title>
@endsection

@section ('content')

	<div class="container">

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
		
		<div class="row">
			<div class="col-sm-6">
				<h4>Otázky</h4>				
			</div>
			{{-- <div class="col-sm-6">
				<h5>Správne odpovede</h5>
			</div> --}}
		</div>

		<div class="row">
			@foreach ($exam->questions as $qt)
				<div class="col">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title">{{ $qtTypes[$qt->type] }}</h5>
							<p class="card-text">{{ $qt->question }}</p>
							<a href="{{ route('teacher.questions.edit', [$exam, $qt]) }}" class="btn btn-primary mx-1">Upraviť</a>
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
								<h5 class="card-title">{{ $ans->points }}</h5>
								<p class="card-text">{{ $ans->answer }}</p>
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
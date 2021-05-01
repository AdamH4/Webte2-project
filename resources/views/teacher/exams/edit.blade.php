@extends ('layouts.teacher')

@section ('head')
<title>Úprava testu - Examio</title>
@endsection

@section ('content')

	<div class="container">

    <h4>Úprava testu</h4>
		
		<form action="{{ route('teacher.exams.edit', $exam) }}" method="POST">
			@csrf
      @method ('PUT')

			<div class="form-group">
    			<label for="title">Názov testu</label>
    			<input type="text" class="form-control" name="title" required value="{{ $exam->title }}">
  			</div>

  			<div class="form-group">
    			<label for="start">Začiatok testu</label>
    			<input type="datetime-local" class="form-control" name="start" required  value="{{ $exam->start->format('Y-m-d\TH:i') }}">
  			</div>

  			<div class="form-group">
    			<label for="end">Koniec testu</label>
    			<input type="datetime-local" class="form-control" name="end" required  value="{{ $exam->end->format('Y-m-d\TH:i') }}">
  			</div>

  			<button type="submit" class="btn btn-primary">Uložiť</button>
		</form>

	</div>

@endsection

@section ('bottom-script')

@endsection
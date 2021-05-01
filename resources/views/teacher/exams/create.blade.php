@extends ('layouts.teacher')

@section ('head')
<title>Vytváranie testu - Examio</title>
@endsection

@section ('content')

	<div class="container">

    <h4>Vytváranie nového testu</h4>
		
		<form action="{{ route('teacher.exams') }}" method="POST">
			@csrf

			<div class="form-group">
    			<label for="title">Názov testu</label>
    			<input type="text" class="form-control" name="title" required>
  			</div>

  			<div class="form-group">
    			<label for="start">Začiatok testu</label>
    			<input type="datetime-local" class="form-control" name="start" required value="{{ Carbon\Carbon::now()->format('Y-m-d\TH:i') }}">
  			</div>

  			<div class="form-group">
    			<label for="end">Koniec testu</label>
    			<input type="datetime-local" class="form-control" name="end" required value="{{ Carbon\Carbon::now()->addHour()->format('Y-m-d\TH:i') }}">
  			</div>

  			<button type="submit" class="btn btn-primary">Uložiť</button>
		</form>

	</div>

@endsection

@section ('bottom-script')

@endsection
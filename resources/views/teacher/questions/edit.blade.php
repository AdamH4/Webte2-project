@extends ('layouts.teacher')

@section ('head')
<title>Úprava otázky - Examio</title>
@endsection

@section ('content')

	<div class="container">

    <h4>Úprava otázky k testu {{ $exam->title }}</h4>
		
		<form action="{{ route('teacher.questions.edit', [$exam, $qt]) }}" method="POST">
			@csrf
            @method ('PUT')

            <div class="form-group">
                <label for="type">Typ otázky</label>
                <select class="form-control" name="type" required>
                    @foreach($types as $enType => $skType)
                        <option value="{{ $enType }}" {{ $enType == $qt->type ? 'selected' : '' }}>{{ $skType }}</option>
                    @endforeach
                </select>
            </div>

			<div class="form-group">
                <label for="question">Otázka</label>
                <textarea class="form-control" name="question" rows="3" required>{{ $qt->question }}</textarea>
            </div>

  			<button type="submit" class="btn btn-primary">Uložiť</button>
		</form>

	</div>

@endsection

@section ('bottom-script')

@endsection
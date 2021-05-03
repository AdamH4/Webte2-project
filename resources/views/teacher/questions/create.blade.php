@extends ('layouts.teacher')

@section ('head')
<title>Vytváranie otázky - Examio</title>
@endsection

@section ('content')

	<div class="container">

    <h4>Vytváranie otázky k testu {{ $exam->title }}</h4>

    @livewire ('create-question', ['exam' => $exam])
		
    	{{-- <form action="{{ route('teacher.questions.create', $exam) }}" method="POST">
    		@csrf

            <div class="form-group">
                <label for="type">Typ otázky</label>
                <select class="form-control" name="type" required>
                    @foreach($types as $enType => $skType)
                        <option value="{{ $enType }}">{{ $skType }}</option>
                    @endforeach
                </select>
            </div>

    		<div class="form-group">
                <label for="question">Otázka</label>
                <textarea class="form-control" name="question" rows="3" required></textarea>
            </div>

    			<button type="submit" class="btn btn-primary">Uložiť</button>
    	</form> --}}

	</div>

@endsection

@section ('bottom-script')

@endsection
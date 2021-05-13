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
                <input class="form-control" id="type" name="type" value="{{  $qt['type'] }}" readonly>
                <input hidden class="form-control" name="qt" value="{{ $qt }}" readonly>
            </div>
			<div class="form-group">
                <label for="question">Otázka</label>
                <textarea class="form-control" id="question" name="question" rows="3" required>{{ $qt->getQuestionDecodedAttribute()->question }}</textarea>
            </div>
            @switch($qt['type'])
                @case("pair_answer")
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            @foreach ($options['left'] as $numberKey => $value)
                                <label for="{{ $numberKey  }}">Možnosť {{ $numberKey  }}</label>
                                <input class="form-control" id="{{ $numberKey  }}" name="pair[left][{{$numberKey}}]" value="{{ $value }}" required>
                            @endforeach
                        </div>
                        <div class="col-md-6">
                            @foreach ($options['right'] as $letterKey => $value)
                                <label for="{{ $letterKey  }}">Možnosť {{ $letterKey  }}</label>
                                <input class="form-control" id="{{ $letterKey  }}" name="pair[right][{{$letterKey}}]" value="{{ $value }}" required>
                            @endforeach
                        </div>
                    </div>
                </div>
                @break
                @case("select_answer")
                <div class="form-group">
                    @foreach ($options as $position => $value)
                        <label for="question">Možnosť {{ $position  }}</label>
                        <input class="form-control mb-3" id="question" name="select[{{$position}}]" value="{{ $value }}" required>
                    @endforeach
                </div>
                @break
            @endswitch
  			<button type="submit" class="btn btn-primary">Uložiť</button>
		</form>
	</div>

@endsection

@section ('bottom-script')

@endsection

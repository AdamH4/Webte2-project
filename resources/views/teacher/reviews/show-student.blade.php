@extends ('layouts.teacher')

@section ('head')
<title>Zoznam testov - Examio</title>
@endsection

@section ('content')

	<div class="container">

		@foreach ($questions as $question)

			<p>{{ $question }}</p>

			<p>{{ $answers->firstWhere('question_id', $question->id) }}</p>

		@endforeach

	</div>

@endsection

@section ('bottom-script')

@endsection

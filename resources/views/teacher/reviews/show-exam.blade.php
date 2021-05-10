@extends ('layouts.teacher')

@section ('head')
<title>Zoznam testov - Examio</title>
@endsection

@section ('content')

	<div class="container">

		@foreach ($students as $student)

			<p>{{ $student }}</p>
			<a href="{{ route('teacher.exams_reviews.show_student', [$exam, $student]) }}">linkk</a>

		@endforeach

	</div>

@endsection

@section ('bottom-script')

@endsection

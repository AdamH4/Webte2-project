@extends ('layouts.teacher')

@section ('head')
<title>Vytváranie otázky - Examio</title>
@endsection

@section ('content')

	<div class="container">

    <h4>Vytváranie otázky k testu {{ $exam->title }}</h4>

    @livewire ('create-question', ['exam' => $exam])

	</div>

@endsection

@section ('bottom-script')

@endsection
@extends ('layouts.teacher', ['active' => 'exams'])

@section ('head')
<title>Zoznam testov - Examio</title>
@endsection

@section ('content')

	<div class="container">
		
		<div class="row">
			<div class="col-12">
				<h2>Nadchádzajúce testy</h2>
			</div>
		</div>

		<div class="row mt-3">
			<div class="col">
				<a href="{{ route('teacher.exams.create') }}" class="btn btn-outline-primary col">Vytvoriť test</a>
			</div>
		</div>

		<div class="row mt-3">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header"><i class="fa fa-align-justify"></i>Vaše testy</div>
					<div class="card-body">
						<table class="table table-responsive-sm">
							<thead>
								<tr>
									<th>Názov</th>
									<th>Kód</th>
									<th>Začiatok</th>
									<th>Koniec</th>
								</tr>
							</thead>
							<tbody>
								@forelse ($exams as $exam)
								<tr>
									<td><a href="{{ route('teacher.exams.show', $exam) }}">{{ $exam->title }}</a></td>
									<td><code>{{ $exam->code }}</code></td>
									<td>{{ $exam->start_human }}</td>
									<td>{{ $exam->end_human }}</td>
								</tr>
								@empty
									<td colspan="5">Ešte ste nevytvorili žiadne testy.</td>
								@endforelse
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

	</div>

@endsection

@section ('bottom-script')

@endsection

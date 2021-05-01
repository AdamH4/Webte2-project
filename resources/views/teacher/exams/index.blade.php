@extends ('layouts.teacher')

@section ('head')
<title>Zoznam testov - Examio</title>
@endsection

@section ('content')

	<div class="container">
		
		<div class="row m-3">
			<div class="col">
				<a href="{{ route('teacher.exams.create') }}" class="btn btn-outline-primary col">Vytvoriť test</a>
			</div>
		</div>

		<div class="row m-3">
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
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								@forelse ($exams as $exam)
								<tr>
									<td><a href="{{ route('teacher.exams.show', $exam) }}">{{ $exam->title }}</a></td>
									<td><code>{{ $exam->code }}</code></td>
									<td>{{ $exam->start->format('j.n.Y H:i') }}</td>
									<td>{{ $exam->end->format('j.n.Y H:i') }}</td>
									<td><span class="badge badge-success">Active</span></td>
								</tr>
								@empty
									<td colspan="5">Ešte ste nevytvorili žiadne testy.</td>
								@endforelse
							</tbody>
						</table>
						<ul class="pagination">
							<li class="page-item"><a class="page-link" href="#">Prev</a></li>
							<li class="page-item active"><a class="page-link" href="#">1</a></li>
							<li class="page-item"><a class="page-link" href="#">2</a></li>
							<li class="page-item"><a class="page-link" href="#">3</a></li>
							<li class="page-item"><a class="page-link" href="#">4</a></li>
							<li class="page-item"><a class="page-link" href="#">Next</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>

	</div>

@endsection

@section ('bottom-script')

@endsection
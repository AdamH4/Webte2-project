@extends ('layouts.teacher')

@section ('head')
<title>Zoznam testov - Examio</title>
@endsection

@section ('content')

	<div class="container">

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
									<th>Export</th>
								</tr>
							</thead>
							<tbody>
								@forelse ($exams as $exam)
								<tr>
									<td><a href="{{ route('teacher.exams_reviews.show_exam', $exam) }}">{{ $exam->title }}</a></td>
									<td><code>{{ $exam->code }}</code></td>
									<td>{{ $exam->start }}</td>
									<td>{{ $exam->end }}</td>
                                    <td>
                                        <a href="#">
                                            <span class="badge badge-info">CSV</span>
                                        </a>
                                    </td>
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

@extends ('layouts.teacher', ['active' => 'exams-active'])

@section ('head')
<title>{{ $exam->title }} - Examio</title>
@endsection

@section ('content')

	<div class="container">
		<div class="row">
			<div class="col-12">
				<h2>Test - {{ $exam->title }}</h2>
			</div>
		</div>
		<div class="row mt-3">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header"><i class="fa fa-align-justify"></i>Prítomní študenti v teste</div>
					<div class="card-body">
						<table class="table table-responsive-sm">
							<thead>
								<tr>
									<th>Meno študenta</th>
									<th>AIS ID</th>
									<th>Stav testu</th>
								</tr>
							</thead>
							<tbody id="studentsTable">
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		

	</div>

@endsection

@section ('bottom-scripts')
<script>
//-----------------------------Constants--------------------------------------------
const studentTableElement = document.getElementById("studentsTable");
const exam = @json($exam);
const getStatusOfExamInterval = 2 * 1000; // 2 * 1000 milsec

//----------------------------Init--------------------------------------------------
renderStudents(exam.students);

//----------------------------Websocket listener---------------------------------------------
window.Echo.private(`Exam.${exam.code}`).listen(".Exam", (data) => {
    this.renderStudents(data.exam.students);
});

//-------Websocket alternative setInterval (#websocket -> cely blok nižšie zakomentovať)------
// setInterval(function() {
//     	fetch('{{ route('teacher.exams_active.sse', $exam->id) }}')
//         .then(function(response) {
// 			return response.json();
//         })
//         .then(function(data) {
//             this.renderStudents(data.students);
//         });
// }, getStatusOfExamInterval);

//----------------------------Functions---------------------------------------------
function renderStudents(students) {
	let content = '';
	studentTableElement.innerHTML = '';
	students.forEach((student) => {
		content += `
		<tr>
			<td>
				${student.full_name}
			</td>
			<td>
				<code>${student.ais_id}</code>
			</td>
			<td>
				<span class="badge badge-${student.is_active}">
				${student.status}
				</span>
			</td>
		</tr>
		`;
	})
	studentTableElement.innerHTML = content;
}
</script>
@endsection
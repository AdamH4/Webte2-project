@extends ('layouts.teacher')

@section ('head')
<title>{{ $exam->title }} - Examio</title>
@endsection

@section ('content')

	<div class="container">

		<h4>Test - {{ $exam->title }}</h4>
		<div class="row m-3">
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

//----------------------------Init--------------------------------------------------
renderStudents(exam.students);

//----------------------------Websocket listener---------------------------------------------
window.Echo.private(`Exam.${exam.code}`).listen(".Exam", (data) => {
    this.renderStudents(data.exam.students);
});

//----------------------------Functions---------------------------------------------
function renderStudents(students) {
	console.log(students)
	studentTableElement.innerHTML = '';
	let content = '';
	students.forEach((student) => {
		content += `
		<tr>
			<td>
				${student.full_name}
			</td>
			<td>
				${student.ais_id}
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
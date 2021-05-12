@extends ('layouts.teacher')

@section ('head')
<title>Zoznam testov - Examio</title>
@endsection

@section ('content')

	<div class="container">
        <div class="row m-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><i class="fa fa-align-justify"></i>Vaši študenti</div>
                    <div class="card-body">
                        <table class="table table-responsive-sm">
                            <thead>
                                <tr>
                                    <th>Meno</th>
                                    <th>ID</th>
                                    <th>Status</th>
                                    <th>Odpovede</th>
                                    <th>Export</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($students as $student)
                                <tr>
                                    <td>{{ $student->full_name }}</td>
                                    <td><code>{{ $student->ais_id }}</code></td>
                                    @if($student->is_active == "left")
                                        <td><span class="badge badge-danger">Odišiel</span></td>
                                    @else
                                        <td><span class="badge badge-success">Odovzdal</span></td>
                                    @endif
                                    <td><a href="{{ route('teacher.exams_reviews.show_student', [$exam, $student]) }}">Odpovede</a></td>
                                    <td>
                                        <a href="{{ route('teacher.exams_reviews.export_submitted_exam', [$exam, $student]) }}">
                                            <span class="badge badge-info">PDF</span>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                    <td colspan="5">Ešte nemáme žiadne záznamy o tomto teste</td>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section ('bottom-script')

@endsection

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Exam;
use App\Models\Question;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExamController extends Controller
{

	public function index()
	{
		$exams = auth()->user()->examsPlanned;
		//set status? ci netreba?

		return view('teacher.exams.index', [
			'exams' => $exams
		]);
	}

	public function show(Exam $exam)
	{

		return view('teacher.exams.show', [
			'exam' => $exam,
			'qtTypes' => Question::types,
		]);
	}

	public function create()
	{

		return view('teacher.exams.create', []);
	}

	public function store(Request $request)
	{
		$val = $request->validate([
			'title' => 'required',
			'start' => 'required|date',
			'end' => 'required|date',
		]);

		$exam = Exam::make($val);

		$exams = Exam::all();

		$code = strtoupper(Str::random(4));
		$entry = $exams->firstWhere('code', $code);

		while ($entry != null) {
			$code = strtoupper(Str::random(4));
			$entry = $exams->firstWhere('code', $code);
		}

		$exam->code = $code;
		$exam->creator()->associate(auth()->user());

		$exam->save();

		return redirect()->route('teacher.exams.show', $exam);
	}

	public function edit(Exam $exam)
	{

		return view('teacher.exams.edit', [
			'exam' => $exam
		]);
	}

	public function update(Request $request, Exam $exam)
	{
		$val = $request->validate([
			'title' => 'required',
			'start' => 'required|date',
			'end' => 'required|date',
		]);

		$exam->title = $request->title;
		$exam->start = $request->start;
		$exam->end = $request->end;

		$exam->save();

		return redirect()->route('teacher.exams.show', $exam);
	}

	public function destroy(Request $request, Exam $exam)
	{
		if ($exam->creator_id == auth()->user()->id) {
			$exam->delete();
		}

		return redirect()->route('teacher.exams');
	}

	public function indexActive()
	{
		$exams = auth()->user()->examsActive;

		return view('teacher.exams.active.index', [
			'exams' => $exams
		]);
	}

	public function showActive(Exam $exam)
	{
		$exam->load('students');

		return view('teacher.exams.active.show', [
			'exam' => $exam,
		]);
	}

	public function sse(Exam $exam)
	{
		$exam->load('students');
		$response = new StreamedResponse(function () use ($exam) {
			while (true) {
				echo 'data: ' . json_encode($exam) . "\n\n";
				ob_flush();
				flush();
				usleep(200000);
			}
		});
		$response->headers->set('Content-Type', 'text/event-stream');
		$response->headers->set('X-Accel-Buffering', 'no');
		$response->headers->set('Cach-Control', 'no-cache');
		return $response;
	}
}

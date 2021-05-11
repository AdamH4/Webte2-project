<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Student;
use App\Models\Question;
use App\Models\Answer;

class ReviewController extends Controller
{
    public function index()
	{
		$exams = auth()->user()->examsFinished;
		//set status? ci netreba?

		return view('teacher.reviews.index', [
			'exams' => $exams
		]);
	}

	public function showExam(Exam $exam)
	{
		$students = Student::where('exam_code', $exam->code)->orderBy('surname')->orderBy('name')->get();

		return view('teacher.reviews.show-exam', [
			'exam' => $exam,
			'students' => $students
		]);
	}

	public function showStudent(Exam $exam, Student $student)
	{
		$questions = $exam->questions;
		$answers = $student->answers;

		foreach ($questions as $key => $question) {
			$theAns = $answers->firstWhere('question_id', $question->id);
			$question->answer = $theAns;

			if ($theAns) {
				// $answers->forget($theAns->key);
			}
		}

		return view('teacher.reviews.show-student', [
			'exam' => $exam,
			'student' => $student,
			'questions' => $questions,
			// 'answers' => $answers,
		]);
	}

    public function updatePoints(Request $request) {
        dd($request);
    }
}

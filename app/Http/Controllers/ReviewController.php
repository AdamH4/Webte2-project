<?php

namespace App\Http\Controllers;

use PDF;
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

    public function updatePoints(Exam $exam, Student $student, Request $request) {

    	$answers = $student->answers;

        foreach ($request->points as $key => $pts) {
        	$ans = $answers->find($key);

        	$ans->points = $pts;

        	$ans->save();
        }

        return redirect()->route('teacher.exams_reviews.show_exam', $exam);
    }

    public function exportExamResultsCSV(Request $request, Exam $exam)
    {
        $fileName = 'exam_' . $exam->code . '_results.csv';

        $students = Student::where('exam_code', $exam->code)->get();
        $questions = Question::where('exam_id', $exam->id)->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('id', 'meno', 'priezvisko', 'hodnotenie');

        $callback = function() use($students, $columns, $questions) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($students as $student) {
                $points = $this->calculateTotalPoints($student->id, $questions);
                $row['id']  = $student->id;
                $row['meno'] = $student->name;
                $row['priezvisko']  = $student->surname;
                $row['hodnotenie']  = $points;

                fputcsv($file, array($row['id'], $row['meno'], $row['priezvisko'], $row['hodnotenie']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function calculateTotalPoints($studentId, $questions)
    {
        $total = 0;

        foreach ($questions as $question) {
            $answer = Answer::where('authorable_type', 'App\Models\Student')
                ->where('authorable_id', $studentId)
                ->where('question_id', $question->id)
                ->first();
            $total += is_null($answer) ? 0 : $answer->points;
        }
        return $total;
    }

    public function exportPDF(Request $request, Exam $exam, Student $student)
    {
        $allQuestions = Question::where('exam_id', $exam->id)->get();

        $questions = array();
        $allQuestionOptions = array();
        $questionPoints = array();
        $answerPoints = array();
        $answers = array();

        foreach ($allQuestions as $question) {
            $answer = Answer::where('authorable_type', 'App\Models\Student')
                ->where('authorable_id', $student->id)
                ->where('question_id', $question->id)
                ->first();

            if ($question->type == 'select_answer' || $question->type == 'pair_answer') {
                array_push($answers, json_decode($answer->answer, true));
            } else {
                array_push($answers, json_decode($answer, true)['answer']);
            }

            array_push($questions, array(
                    'question' => json_decode($question->question, true)['question'],
                    'type' => $question->type)
            );
            array_push($questionPoints, $question->points);
            array_push($answerPoints, $answer->points);

            $decodedQuestion = json_decode($question->question, true);
            array_push($allQuestionOptions, key_exists('options', $decodedQuestion)
                ? $decodedQuestion['options']
                : null
            );
        }

        $data = [
            'questions' => $questions,
            'options' => $allQuestionOptions,
            'answers' => $answers,
            'maxPoints' => $questionPoints,
            'gainedPoints' => $answerPoints
        ];

        $pdf = PDF::loadView('teacher/reviews/exam-pdf', $data);

        return $pdf->download('exam_' . $student->ais_id . '.pdf');
    }
}

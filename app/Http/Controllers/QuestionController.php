<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Exam;

class QuestionController extends Controller
{

	var $types;

	public function __construct()
	{
		$this->types = collect([
			'short_answer' => 'Krátka odpoveď',
			'select_answer' => 'Výberová odpoveď',
			'pair_answer' => 'Párovacia odpoveď',
			'draw_answer' => 'Kreslená odpoveď',
			'math_answer' => 'Matematická odpoveď'
		]);
	}

    public function show(Question $qt)
    {

    	return view('teacher.questions.show', [
    		'qt' => $qt
    	]);
    }

    public function create(Exam $exam)
    {

    	return view('teacher.questions.create', [
    		'exam' => $exam,
    		'types' => $this->types,
    	]);
    }

    public function store(Request $request, Exam $exam)
    {
    	$vali = $request->validate([
    		'type' => 'required',
    		'question' => 'required',
    	]);

    	$qt = Question::make($vali);

    	$qt->exam()->associate($exam);

    	$qt->save();

    	return redirect()->route('teacher.exams.show', $exam);
    }

    public function edit(Exam $exam, Question $qt)
    {

    	return view('teacher.questions.edit', [
    		'exam' => $exam,
    		'qt' => $qt,
    		'types' => $this->types,
    	]);
    }

    public function update(Request $request, Exam $exam, Question $qt)
    {
    	$vali = $request->validate([
    		'type' => 'required',
    		'question' => 'required',
    	]);

    	$qt->type = $request->type;
    	$qt->question = $request->question;

    	$qt->save();

    	return redirect()->route('teacher.exams.show', $exam);
    }

    public function destroy(Request $request, Exam $exam, Question $qt)
    {
		$qt->delete();

    	return redirect()->route('teacher.exams.show', $exam);
    }
}

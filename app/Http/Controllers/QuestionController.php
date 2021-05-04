<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Exam;

class QuestionController extends Controller
{

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
    		'types' => Question::types,
    	]);
    }

    public function store(Request $request, Exam $exam)
    {
    	$vali = $request->validate([
    		'type' => 'required',
    		'question' => 'required',
            'short_ans_opts' => 'array|nullable',
            'pair_right' => 'array|nullable',
            'pair_left' => 'array|nullable'
    	]);

    	$qt = Question::make($vali);

    	$qt->exam()->associate($exam);

        // case - short answer question
        if ($request->short_ans_opts) {
            $question = collect(['question' => $vali['question']]);
            $question->put('options', $request->short_ans_opts);
            $qt->question = $question->toJson();
        }
        // end case - short answer question

        // case - pair answer question
        if ($request->pair_right && $request->pair_left) {
            $question = collect(['question' => $vali['question']]);
            // $pairAnsOpts = collect();
            // $pairAnsOpts->put('left', $request->pair_left);
            // $pairAnsOpts->put('right', $request->pair_right);
            // $question->put('options', $pairAnsOpts->whereNotNull()->toArray());
            $question->put('options', ['left' => $request->pair_left, 'right' => $request->pair_right]);
            $qt->question = $question->toJson();
        }
        // end case - pair answer question

    	$qt->save();

    	return redirect()->route('teacher.exams.show', $exam);
    }

    public function edit(Exam $exam, Question $qt)
    {

    	return view('teacher.questions.edit', [
    		'exam' => $exam,
    		'qt' => $qt,
    		'types' => Question::types,
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

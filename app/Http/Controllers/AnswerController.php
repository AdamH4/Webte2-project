<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Answer;

class AnswerController extends Controller
{
    public function create(Exam $exam, Question $qt)
    {

    	return view('teacher.answers.create', [
    		'exam' => $exam,
    		'qt' => $qt,
    		'qtTypes' => Question::types,
    	]);
    }

    public function store(Request $request, Exam $exam, Question $qt)
    {
    	$vali = $request->validate([
    		'answer' => 'required',
    		'points' => 'required',
            'short_ans_opts' => 'array|nullable',
            'pair_right' => 'array|nullable',
            'pair_left' => 'array|nullable'
    	]);

    	$ans = Answer::make($vali);

    	$ans->question()->associate($qt);
    	$ans->author()->associate(auth()->user());

        // case - short answer question
        if ($request->short_ans_opts) {
            $question = collect(['question' => $vali['question']]);
            $question->put('options', $request->short_ans_opts);
            $ans->question = $question->toJson();
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
            $ans->question = $question->toJson();
        }
        // end case - pair answer question

    	$ans->save();

    	return redirect()->route('teacher.exams.show', $exam);
    }
}

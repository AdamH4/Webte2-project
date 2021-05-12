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
        //treba zakazat po zacati testu
    	$vali = $request->validate([
    		'type' => 'required',
    		'question' => 'required',
            'points' => 'required',
            'short_ans_opts' => 'array|nullable',
            'pair_right' => 'array|nullable',
            'pair_left' => 'array|nullable',
            'pair_right_ind' => 'array|nullable',
            'pair_left_ind' => 'array|nullable',
    	]);

    	$qt = Question::make($vali);

    	$qt->exam()->associate($exam);
        $question = collect(['question' => $vali['question']]);

        // case - short answer question
        if ($request->short_ans_opts) {

            foreach ($request->short_ans_opts as $key => $opt) {
                if ($opt != null && $opt != '') {
                    $sao[$key + 1] = $opt;
                }
            }
            
            $question->put('options', $sao);
            $qt->question = $question->toJson();
        }
        // end case - short answer question

        // case - pair answer question
        else if ($request->pair_right && $request->pair_left) {
            $question = collect(['question' => $vali['question']]);

            $lefts = [];
            foreach ($request->pair_left_ind as $key => $pli) {
                $lefts[$pli] = $request->pair_left[$key];
            }

            $rights = [];
            foreach ($request->pair_right_ind as $key => $pri) {
                $rights[$pri] = $request->pair_right[$key];
            }

            $question->put('options', ['left' => $lefts, 'right' => $rights]);
            $qt->question = $question->toJson();
        }
        // end case - pair answer question

        else {
            $qt->question = $question->toJson();
        }

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
        //treba zakazat po zacati testu
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

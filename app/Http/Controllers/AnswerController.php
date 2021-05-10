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
    		'answers' => 'array|nullable',
    		'points' => 'required',
            'select_answers' => 'array|nullable',
            'pair_left' => 'array|nullable'
    	]);

    	$ans = Answer::make($vali);

    	$ans->question()->associate($qt);
    	$ans->author()->associate(auth()->user());

        if ($request->answers) {
            $ans->answer = json_encode($request->answers);
        }
        // case - short answer question
        else if ($request->select_answers) {
            $allOpts = (array) $qt->questionDecoded->options;

            foreach ($request->select_answers as $sa) {
                $selected[$sa] = $allOpts[$sa];
            }

            $ans->answer = json_encode($selected);
        }
        // end case - short answer question

        // case - pair answer question
        else if ($request->pair_left) {

            $allOpts = (array) $qt->questionDecoded->options;
            $answer = [];
            
            foreach ($request->pair_left as $left => $right) {

                $answer[$left]['left'] = $allOpts['left']->$left;
                $answer[$left]['right'] = $allOpts['right']->$right;
                $answer[$left]['rightKey'] = $right;
            }

            $ans->answer = json_encode($answer);

        }
        // end case - pair answer question
        dd($ans);

    	$ans->save();

    	return redirect()->route('teacher.exams.show', $exam);
    }
}
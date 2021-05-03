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
}

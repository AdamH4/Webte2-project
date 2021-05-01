<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Exam;

class ExamController extends Controller
{
    public function index()
    {
    	$exams = auth()->user()->exams;
    	//set status? ci netreba?

    	return view('teacher.exams.index', [
    		'exams' => $exams
    	]);
    }

    public function show(Exam $exam)
    {

    	return view('teacher.exams.show', [
    		'exam' => $exam,
            'qtTypes' => $this->getQuestionTypes()
    	]);
    }

    public function create()
    {

    	return view('teacher.exams.create', [

    	]);
    }

    public function store(Request $request)
    {
    	$val = $request->validate([
    		'title' => 'required',
    		'start' => 'required|date',
    		'end' => 'required|date',
    	]);

    	$exam = Exam::make($val);

    	while (true) {
    		$code = strtoupper(Str::random(4));
    		$entry = Exam::firstWhere('code', $code);

    		if ($entry == null) {
    			break;
    		}
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

    private function getQuestionTypes()
    {
        return collect([
            'short_answer' => 'Krátka odpoveď',
            'select_answer' => 'Výberová odpoveď',
            'pair_answer' => 'Párovacia odpoveď',
            'draw_answer' => 'Kreslená odpoveď',
            'math_answer' => 'Matematická odpoveď'
        ]);
    }
}

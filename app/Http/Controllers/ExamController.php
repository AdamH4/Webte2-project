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

    	return view('teacher.exams.index', [
    		'exams' => $exams
    	]);
    }

    public function show(Exam $exam)
    {

    	return view('teacher.exams.show', [
    		'exam' => $exam
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

    	$exam->code = strtoupper(Str::random(4));
    	$exam->creator()->associate(auth()->user());

    	$exam->save();

    	return redirect()->route('teacher.exams.show', $exam);
    }
}

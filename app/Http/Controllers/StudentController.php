<?php

namespace App\Http\Controllers;


use App\Models\Student;
use App\Models\Exam;
use App\Http\Requests\LoginTestRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class StudentController extends Controller
{
    public function loginToExam(LoginTestRequest $request)
    {
        $request = $request->getValidatedData();

        $exam = Exam::byExamCode($request['exam_code'])->firstOrFail();
        $studentInExam = Student::byExamCode($request['exam_code'])->byAis($request['ais_id'])->first();

        //Ak neexistuje student v teste, tak ho vytvorime
        if (!$studentInExam) {
            $studentInExam = Student::create($request);
        }

        //V pripade ak student uz ukoncil test alebo leavol
        //Tu otazka vznika ze ked leavne tak ci ho to ma pustit alebo nie
        if (!$studentInExam->isWritingExam()) {
            alert()->error('Test si už ukončil! Nevymýšlaj!', 'Test si ukončil!');
            return redirect()->route('home');
        }

        // [Best practise] vzdy pouzit helper metody ked sa da, 
        // prihlasujem studenta na guard in-exam
        auth()->guard('in-exam')->login($studentInExam);

        return redirect()->route('exam.show', $exam->code);
    }

    public function exam($code)
    {
        $exam = Exam::byExamCode($code)->firstOrFail();

        //Zistime ci moze pristupit k testu - StudentPolicy.php
        if (!auth('in-exam')->user()->can('show-exam', $exam)) return redirect()->route('home');

        $questions = $exam->questions;
        $student = auth('in-exam')->user();

        return view('student.exam', [
            'exam' => $exam,
            'questions' => $questions,
            'student' => $student
        ]);
    }

    public function leftExam(Request $request)
    {
        auth('in-exam')->user()->update([
            'is_active' => Student::LEFT
        ]);

        $this->logoutFromExam($request);

        return redirect()->route('home');
    }

    public function doneExam(Request $request)
    {
        auth('in-exam')->user()->update([
            'is_active' => Student::DONE
        ]);

        $this->logoutFromExam($request);

        //TODO: Tu spravit service na odoslanie testu z pohladu studenta

        alert()->success('Test bol úspešne odoslaný!', 'Úspešne!');
        return redirect()->route('home');
    }

    private function logoutFromExam($request)
    {
        auth('in-exam')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}

<?php

namespace App\Http\Controllers;

use App\Events\ExamEvent;
use App\Models\Student;
use App\Models\Exam;
use App\Http\Requests\LoginTestRequest;
use App\Services\ExamSubmissionService;
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

        $this->changeExamStatus(Student::WRITING);

        return redirect()->route('exam.show', $exam->code);
    }

    public function exam($code)
    {
        $exam = Exam::byExamCode($code)->firstOrFail();

        //Zistime ci moze pristupit k testu - StudentPolicy.php
        if (!auth('in-exam')->user()->can('show-exam', $exam)) {
            alert()->error('Nemáš oprávnenie vidieť test!', 'Zakázaný prístup!');
            return redirect()->route('home');
        }

        $this->changeExamStatus(Student::WRITING);

        $questions = $exam->questions;

        // decode all questions before passing to FE
        foreach ($questions as $question) {
            $question->question = json_decode($question->question);
        }

        return view('student.exam', [
            'exam' => $exam,
            'questions' => $questions,
            'student' => auth('in-exam')->user()
        ]);
    }

    public function leftExam(Request $request, Exam $exam)
    {
        $this->changeExamStatus(Student::LEFT);

        // Ak leavne tak ho  to hned odhlasi z testu
        //$this->logoutFromExam($request);

        return redirect()->route('home');
    }

    public function doneExam(Request $request, Exam $exam)
    {
        $this->changeExamStatus(Student::DONE);

        $submittedAnswers = $request->request->all()['answers'];

        (new ExamSubmissionService())->storeAnswers($submittedAnswers);

        $this->logoutFromExam($request);

        alert()->success('Test bol úspešne odoslaný!', 'Úspešne!');
        return redirect()->route('home');
    }

    public function changeExamStatus($status)
    {
        $student = auth('in-exam')->user();
        $student->update([
            'is_active' => $status
        ]);

        $exam = Exam::with('students')->byExamCode($student->exam_code)->firstOrFail();

        ExamEvent::dispatch($exam);  // #websocket
    }

    private function logoutFromExam($request)
    {
        auth('in-exam')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}

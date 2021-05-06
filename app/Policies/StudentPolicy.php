<?php

namespace App\Policies;

use App\Models\Exam;
use App\Models\Student;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StudentPolicy
{
    use HandlesAuthorization;


    public function exam(Student $student, Exam $exam)
    {
        //Tu otazka vznika ze ked leavne tak ci ho to ma pustit alebo nie, zatial to nepusta
        return $student->isInCorrectExam($exam) && $student->isWritingExam();
    }
}

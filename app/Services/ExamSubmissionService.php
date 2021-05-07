<?php


namespace App\Services;


use App\Models\Answer;
use App\Models\Question;
use App\Models\Student;
use function Symfony\Component\Translation\t;

class ExamSubmissionService
{
    public function storeAnswers($submittedAnswers)
    {
        // TODO : replace with dynamic questions id's
        $tmpQuestionIds = array(81, 2, 1, 17, 19);

        foreach ($submittedAnswers as $questionType => $submittedAnswer) {
            switch ($questionType) {
                case "select":
                   $this->storeAnswerForQuestionTypeSelect($tmpQuestionIds[0], $submittedAnswer);
                    break;
                case "short":
                    $this->storeAnswerForQuestionTypeShort($tmpQuestionIds[1], $submittedAnswer);
                    break;
                case "pair":
                    $this->storeAnswerForQuestionTypePair($tmpQuestionIds[2], $submittedAnswer);
                    break;
                case "draw":
                    $this->storeAnswerForQuestionTypeDraw($tmpQuestionIds[3], $submittedAnswer);
                    break;
                case "math":
                    $this->storeAnswerForQuestionTypeMath($tmpQuestionIds[4], $submittedAnswer);
                    break;
                default:
                    // empty test
           }
        }
    }

    private function storeAnswerForQuestionTypeSelect($questionId, $submittedAnswer)
    {
        $answer = $this->createAnswer($questionId);

        $questionObject = Question::where('id', $answer->question_id)->first();

        if (is_null($questionObject)) {
            return;
        }

        $allOptions = json_decode($questionObject->question, true)['options'];

        foreach ($submittedAnswer['id'] as $position => $selectedOption) {
            // find option key by value of selected option
            $isFoundKey = array_search($selectedOption, $allOptions);

            // array search returns false if not successful, if false
            if (! $isFoundKey) {
                continue;
            }

            $selectedOptions[$position] = array($isFoundKey => $selectedOption);
        }

        $answer->answer = json_encode($selectedOptions);

        $this->autoGradeAnswerForQuestionTypeSelect($answer, $questionId);

        $answer->save();
//        dd($answer);
    }

    private function autoGradeAnswerForQuestionTypeSelect($answer, $questionId)
    {
        $correctAnswer = Answer::where('question_id', $questionId)->where('authorable_type', 'App\Models\User')->first();

        if (is_null($correctAnswer)) {
            return;
        }

        $correctOptions = json_decode($correctAnswer->answer, true);

        $submittedOptions = json_decode($answer->answer, true);

        $maxPoints = $correctAnswer->points;
        $partialPointsPerQuestion = $maxPoints / count($correctOptions);

        for ($index = 0; $index < count($submittedOptions); $index++) {
            foreach ($submittedOptions[$index] as $answerKey => $option) {
                if (key_exists($answerKey, $correctOptions) && $this->valuesMatch($option, $correctOptions[$answerKey])) {
                    $answer->points += $partialPointsPerQuestion;
                }
            }
        }
    }

    private function valuesMatch($selected, $correct)
    {
        return $selected == $correct;
    }

    private function storeAnswerForQuestionTypeMath($questionId, $submittedAnswer)
    {
        $answer = $this->createAnswer($questionId);

        $answer->answer = $submittedAnswer['id'];

        $answer->save();
//        dd($answer);
    }

    private function storeAnswerForQuestionTypeDraw($questionId, $submittedAnswer)
    {
        $answer = $this->createAnswer($questionId);

        $answer->answer = $submittedAnswer['id'];

        $answer->save();
//        dd($answer);
    }

    private function storeAnswerForQuestionTypeShort($questionId, $submittedAnswer)
    {
        $answer = $this->createAnswer($questionId);
        $answer->answer = $submittedAnswer['id'];

        $this->autoGradeAnswerForQuestionTypeShort($answer, $questionId);

        $answer->save();
    }

    private function storeAnswerForQuestionTypePair($questionId, $submittedAnswer)
    {
//        $answer = $this->createAnswer($questionId);
//
//        foreach ($submittedAnswer['id'] as $option => $value) {
//
//        }
//        dd($submittedAnswer);
    }

    private function autoGradeAnswerForQuestionTypeShort($answer, $questionId)
    {
        $correctAnswers = Answer::where('question_id', $questionId)->where('authorable_type', 'App\Models\User')->first();

        if (is_null($correctAnswers)) {
            return;
        }

        $allCorrectAlternatives = json_decode($correctAnswers->answer, true);

        foreach ($allCorrectAlternatives as $index => $correctAnswer) {
            if ($answer->answer == $correctAnswer) {
                $answer->points = $correctAnswers->points;
            }
        }
    }

    private function createAnswer($questionId)
    {
        $answer = Answer::make();
        $answer->question_id = $questionId;
        $answer->author()->associate(auth()->guard('in-exam')->user());
        $answer->points = 0;

        return $answer;
    }

}

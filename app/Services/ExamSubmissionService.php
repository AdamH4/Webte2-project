<?php


namespace App\Services;


use App\Models\Answer;
use App\Models\Question;
use App\Models\Student;
use function GuzzleHttp\Promise\all;
use function PHPUnit\Framework\isEmpty;
use function Symfony\Component\Translation\t;

class ExamSubmissionService
{
    public function storeAnswers($submittedAnswers)
    {
        foreach ($submittedAnswers as $questionType => $questions) {
            switch ($questionType) {
                case "select":
                    foreach ($questions as $questionId => $submittedAnswer) {
                        $this->storeAnswerForQuestionTypeSelect($questionId, $submittedAnswer);
                    }
                    break;
                case "short":
                    foreach ($questions as $questionId => $submittedAnswer) {
                        $this->storeAnswerForQuestionTypeShort($questionId, $submittedAnswer);
                    }
                    break;
                case "pair":
                    foreach ($questions as $questionId => $submittedAnswer) {
                        $this->storeAnswerForQuestionTypePair($questionId, $submittedAnswer);
                    }
                    break;
                case "draw":
                    foreach ($questions as $questionId => $submittedAnswer) {
                        $this->storeAnswerForQuestionTypeDraw($questionId, $submittedAnswer);
                    }
                    break;
                case "math":
                    foreach ($questions as $questionId => $submittedAnswer) {
                        $this->storeAnswerForQuestionTypeMath($questionId, $submittedAnswer);
                    }
                    break;
           }
        }
    }

    private function storeAnswerForQuestionTypeSelect($questionId, $submittedAnswer)
    {
        $answer = $this->createAnswer($questionId);

        $questionObject = Question::where('id', $answer->question_id)->first();
        $allOptions = json_decode($questionObject->question, true)['options'];

        if ($this->handlesEmptyManyOptionsAnswer($answer, $submittedAnswer, count($allOptions))) {
            return;
        }

        if (is_null($questionObject)) {
            return;
        }

        $selectedOptions = array();

        foreach ($submittedAnswer as $position => $selectedOption) {
            // find option key by value of selected option
            $isFoundKey = array_search($selectedOption, $allOptions);

            // array search returns false if not successful
            if (! $isFoundKey) {
                continue;
            }

            $selectedOptions[$isFoundKey] = $selectedOption;
        }

        $answer->answer = json_encode($selectedOptions);

        (new AutoGradeService())->autoGradeAnswerForQuestionTypeSelect($answer, $questionId);

        $answer->save();
    }

    private function storeAnswerForQuestionTypeMath($questionId, $submittedAnswer)
    {
        $answer = $this->createAnswer($questionId);

        if ($this->handlesEmptyAnswer($answer, $submittedAnswer)) {
            return;
        }

        $answer->answer = $submittedAnswer;
        $answer->save();
    }

    private function storeAnswerForQuestionTypeDraw($questionId, $submittedAnswer)
    {
        $answer = $this->createAnswer($questionId);

        if ($this->handlesEmptyAnswer($answer, $submittedAnswer)) {
            return;
        }

        $answer->answer = $submittedAnswer;
        $answer->save();
    }

    private function storeAnswerForQuestionTypeShort($questionId, $submittedAnswer)
    {
        $answer = $this->createAnswer($questionId);

        if ($this->handlesEmptyAnswer($answer, $submittedAnswer)) {
            return;
        }

        $answer->answer = $submittedAnswer;

        (new AutoGradeService())->autoGradeAnswerForQuestionTypeShort($answer, $questionId);

        $answer->save();
    }

    private function storeAnswerForQuestionTypePair($questionId, $submittedAnswer)
    {
        $answer = $this->createAnswer($questionId);

        $question = Question::find($questionId);
        $allOptions = json_decode($question->question, true)['options'];

        $allNumberOptions = $allOptions['left'];
        $allLetterOptions = $allOptions['right'];

        if ($this->handlesEmptyManyOptionsAnswer($answer, $submittedAnswer, count($allLetterOptions))) {
            return;
        }

        $selectedOptions = array();

        foreach ($submittedAnswer as $letterKey => $numberKey) {
            if (key_exists($numberKey, $allNumberOptions) and  key_exists($letterKey, $allLetterOptions)) {
                // get value by key from all number|letter options
                $numberValue = $allNumberOptions[$numberKey];
                $letterValue = $allLetterOptions[$letterKey];

                $selectedOptions[$numberKey] = array();

                $selectedOptions[$numberKey]["left"] = $numberValue;
                $selectedOptions[$numberKey]["right"] = $letterValue;
                $selectedOptions[$numberKey]["rightKey"] = $letterKey;
            }
        }

        $answer->answer = isEmpty($selectedOptions) ? json_encode($selectedOptions) : "";

        (new AutoGradeService())->autoGradeAnswerForQuestionTypePair($answer, $questionId);

        $answer->save();
    }

    private function createAnswer($questionId)
    {
        $answer = Answer::make();
        $answer->question_id = $questionId;
        $answer->author()->associate(auth()->guard('in-exam')->user());
        $answer->points = 0;

        return $answer;
    }

    private function handlesEmptyAnswer($answer, $submittedAnswer)
    {
        if (is_null($submittedAnswer)) {
            $answer->answer = "";
            $answer->save();

            return true;
        }
        return false;
    }

    private function handlesEmptyManyOptionsAnswer($answer, $submittedAnswer, $countAllOptions)
    {
        $countOfNullOptions = $this->getCountOfNullOptions($submittedAnswer);

        // all options have null value -> create empty answer
        if ($countOfNullOptions == $countAllOptions) {
            $answer->answer = "";
            $answer->save();

            return true;
        }
        return false;
    }

    private function getCountOfNullOptions($submittedAnswer)
    {
        $countOfNullOptions = 0;

        foreach ($submittedAnswer as $letterKey => $numberKey) {
            if(is_null($numberKey)) {
                $countOfNullOptions++;
            }
        }

        return $countOfNullOptions;
    }

}

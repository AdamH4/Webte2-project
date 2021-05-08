<?php


namespace App\Services;


use App\Models\Answer;
use App\Models\Question;
use App\Models\Student;
use function GuzzleHttp\Promise\all;
use function Symfony\Component\Translation\t;

class ExamSubmissionService
{
    public function storeAnswers($submittedAnswers)
    {
        // TODO : replace with dynamic questions id's
        $tmpQuestionIds = array(81, 2, 83, 17, 19);

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
        $allOptions = json_decode($questionObject->question, true)['options'];

        if (is_null($questionObject)) {
            return;
        }

        foreach ($submittedAnswer['id'] as $position => $selectedOption) {
            // find option key by value of selected option
            $isFoundKey = array_search($selectedOption, $allOptions);

            // array search returns false if not successful
            if (! $isFoundKey) {
                continue;
            }

            $selectedOptions[$position] = array($isFoundKey => $selectedOption);
        }

        $answer->answer = json_encode($selectedOptions);

        (new AutoGradeService())->autoGradeAnswerForQuestionTypeSelect($answer, $questionId, count($allOptions));

        $answer->save();
    }



    private function storeAnswerForQuestionTypeMath($questionId, $submittedAnswer)
    {
        $answer = $this->createAnswer($questionId);

        $answer->answer = $submittedAnswer['id'];

        $answer->save();

    }

    private function storeAnswerForQuestionTypeDraw($questionId, $submittedAnswer)
    {
        $answer = $this->createAnswer($questionId);

        $answer->answer = $submittedAnswer['id'];

        $answer->save();
    }

    private function storeAnswerForQuestionTypeShort($questionId, $submittedAnswer)
    {
        $answer = $this->createAnswer($questionId);
        $answer->answer = $submittedAnswer['id'];

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

        foreach ($submittedAnswer['id'] as $letterKey => $numberKey) {
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
        $answer->answer = json_encode($selectedOptions);

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

}

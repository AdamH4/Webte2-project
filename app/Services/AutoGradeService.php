<?php


namespace App\Services;


use App\Models\Answer;

class AutoGradeService
{
    public function autoGradeAnswerForQuestionTypeSelect($answer, $questionId, $allOptionsCount)
    {
        $correctAnswer = $this->fetchCorrectAnswer($questionId);

        if (is_null($correctAnswer)) {
            return;
        }

        $correctOptions = json_decode($correctAnswer->answer, true);
        $submittedOptions = json_decode($answer->answer, true);

        $maxPoints = $correctAnswer->points;
        $partialPointsPerQuestion = $maxPoints / $allOptionsCount;

        for ($index = 0; $index < count($submittedOptions); $index++) {
            foreach ($submittedOptions[$index] as $answerKey => $option) {
                // if key does not exist in correct options, continue
                if (! key_exists($answerKey, $correctOptions)) {
                    continue;
                }
                // get correct option value, compare with submitted option value
                $correctOptionValue = $correctOptions[$answerKey];

                if ($this->match($option, $correctOptionValue)) {
                    $answer->points += $partialPointsPerQuestion;
                }
            }
        }
    }

    public function autoGradeAnswerForQuestionTypeShort($answer, $questionId)
    {
        $correctAnswer = $this->fetchCorrectAnswer($questionId);

        if (is_null($correctAnswer)) {
            return;
        }

        $allCorrectAlternatives = json_decode($correctAnswer->answer, true);
        foreach ($allCorrectAlternatives as $index => $correctAlternative) {
            if ($this->match($answer->answer, $correctAlternative)) {
                $answer->points = $correctAnswer->points;
            }
        }
    }

    public function autoGradeAnswerForQuestionTypePair($answer, $questionId)
    {
        $correctAnswer = $this->fetchCorrectAnswer($questionId);

        if (is_null($correctAnswer)) {
            return;
        }

        $allCorrectOptions = json_decode($correctAnswer->answer, true);
        $submittedOptions = json_decode($answer->answer, true);

        $maxPoints = $correctAnswer->points;
        $partialPointsPerQuestion = $maxPoints / count($allCorrectOptions);

        // iterate [
        //    "2" => [ "left":"dva","right":"acko","rightKey":"A" ],
        //    "3" => [ "left":"tri","right":"becko","rightKey":"B" ],
        //    "1" => [ "left":"jedna","right":"cecko","rightKey":"C" ]
        // ]
        foreach ($submittedOptions as $numberKey => $optionData) {
            // iterate [ "left":"dva","right":"acko","rightKey":"A" ]

            $submittedLetterKey = $submittedOptions[$numberKey]['rightKey'];
            $correctLetterKey = $allCorrectOptions[$numberKey]['rightKey'];

            if (key_exists($numberKey, $allCorrectOptions) and $this->match($submittedLetterKey, $correctLetterKey)) {
                $answer->points += $partialPointsPerQuestion;
            }
        }
    }

    private function fetchCorrectAnswer($questionId)
    {
        return Answer::where('question_id', $questionId)->where('authorable_type', 'App\Models\User')->first();
    }

    private function match($selected, $correct)
    {
        return $selected == $correct;
    }
}

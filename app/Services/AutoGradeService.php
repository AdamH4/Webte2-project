<?php


namespace App\Services;


use App\Models\Answer;

class AutoGradeService
{
    public function autoGradeAnswerForQuestionTypeSelect($answer, $questionId)
    {
        $correctAnswer = $this->fetchCorrectAnswer($questionId);

        if (is_null($correctAnswer)) {
            return;
        }

        $correctOptions = json_decode($correctAnswer->answer, true);
        $submittedOptions = json_decode($answer->answer, true);

        $maxPoints = $correctAnswer->points;

        // in case none of answers is correct && none was selected, assign full points
        if (count($correctOptions) == 0 and count($submittedOptions) == 0) {
            $answer->points += $maxPoints;
            return;
        }

        $partialPointsPerQuestion = $maxPoints / count($correctOptions);

        foreach ($submittedOptions as $answerKey => $option) {
            // different count od selected options indicates incorrect answer
            if (count($submittedOptions) != count($correctOptions)) {
                $answer->points = 0;
                return;
            }

            // if key does not exist in correct options, continue
            if (! key_exists($answerKey, $correctOptions)) {
                $answer->points = 0;
                continue;
            }

            // get correct option value, compare with submitted option value
            $correctOptionValue = $correctOptions[$answerKey];

            if ($this->match($option, $correctOptionValue)) {
                $answer->points += $partialPointsPerQuestion;
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

        // different count od selected options indicates incorrect answer
        if (count($submittedOptions) != count($allCorrectOptions)) {
            $answer->points = 0;
            return;
        }

        $countOfCorrectlyChosenOptions = 0;

        // iterate [
        //    "2" => [ "left" => "dva","right" => "acko","rightKey" => "A" ],
        //    "3" => [ "left" => "tri","right" => "becko","rightKey" => "B" ],
        //    "1" => [ "left" => "jedna","right" => "cecko","rightKey" => "C" ]
        // ]
        foreach ($submittedOptions as $numberKey => $optionData) {
            // find letter key by given number key
            $submittedLetterKey = $submittedOptions[$numberKey]['rightKey'];
            $correctLetterKey = $allCorrectOptions[$numberKey]['rightKey'];

            // if submitted letter key matches correct letter key, add points
            if (key_exists($numberKey, $allCorrectOptions) and $this->match($submittedLetterKey, $correctLetterKey)) {
                $countOfCorrectlyChosenOptions++;
            }
        }

        if ($countOfCorrectlyChosenOptions == count($allCorrectOptions)) {
            $answer->points = $maxPoints;
        } else {
            $answer->points = 0;
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

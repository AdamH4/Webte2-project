<?php

namespace Database\Factories;

use App\Models\Exam;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class QuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Question::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $types = [
            ['id' => Question::SELECT_ANSWER, 'question' => '{"question":"sup","options":["1": "ay", "2": "eh"]}'],
            ['id' => Question::MATH_ANSWER, 'question' => '{"question":"napis teoriu mnozin"}'],
            ['id' => Question::SHORT_ANSWER, 'question' => '{"question":"napis teoriu mnozin"}'],
            ['id' => Question::PAIR_ANSWER, 'question' => '{"question":"tretia moznost pairu","options":{"left":{"1":"iba jedna"},"right":{"A":"acko","B":"becko","C":"cecko","D":"decko"}}}'],
            ['id' => Question::DRAW_ANSWER, 'question' => '{"question":"napis teoriu mnozin"}']
        ];
        $random = Arr::random($types);
        return [
            'type' => $random['id'],
            'exam_id' => Exam::inRandomOrder()->first()->id,
            'question' => $random['question'],
            'points' => $this->faker->numberBetween(1, 10),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Exam;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Exam::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $datetime = $this->faker->dateTimeThisYear('now');
        return [
            'code' => $this->faker->ean13,
            'title' => $this->faker->domainWord,
            'creator_id' => User::inRandomOrder()->first()->id,
            'start' => $datetime,
            'end' => $datetime,
        ];
    }
}

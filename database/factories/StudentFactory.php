<?php

namespace Database\Factories;

use App\Models\Exam;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName,
            'surname' => $this->faker->lastName,
            'ais_id' => $this->faker->ean8,
            'is_active' => Arr::random(Student::STATUSES),
            'exam_code' => Exam::inRandomOrder()->first()->code
        ];
    }
}

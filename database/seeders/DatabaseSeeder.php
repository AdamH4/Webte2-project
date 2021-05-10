<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //TODO: Uncomment in production
        $this->seedProductionData();

        // //TODO:Comment in production
        // \App\Models\User::factory(5)->create();
        // \App\Models\Exam::factory(5)->create();
        // \App\Models\Question::factory(40)->create();
        // \App\Models\Student::factory(40)->create();
    }

    public function seedProductionData()
    {
        $this->call(ProductionSeeder::class);
    }
}

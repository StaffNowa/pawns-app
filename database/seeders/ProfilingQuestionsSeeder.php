<?php

namespace Database\Seeders;

use App\Models\ProfilingQuestion;
use Illuminate\Database\Seeder;

class ProfilingQuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProfilingQuestion::insert([
            [
                'question_text' => 'Gender',
                'type' => 'single_choice',
                'options' => json_encode(['Male', 'Female']),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'question_text' => 'Date of Birth',
                'type' => 'date',
                'options' => null,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // goals
        DB::table('classes')->insert([
            'name' => 'Data Structures',
            'target_grade' => 90,
            'actual_grade' => 92.95
        ]);
        DB::table('classes')->insert([
            'name' => 'Critical Thinking',
            'target_grade' => 75,
            'actual_grade' => 88.82
        ]);
        DB::table('classes')->insert([
            'name' => 'Calculus',
            'target_grade' => 85,
            'actual_grade' => 74.66
        ]);

        // sections
        DB::table('sections')->insert([
            'name' => 'Tests',
            'section_weight' => 60,
            'current_progress' => 54.34,
            'classes_id' => 1
        ]);
        DB::table('sections')->insert([
            'name' => 'Labs',
            'section_weight' => 40,
            'current_progress' => 38.61,
            'classes_id' => 1
        ]);
        DB::table('sections')->insert([
            'name' => 'Essays',
            'section_weight' => 45,
            'current_progress' => 40.59,
            'classes_id' => 2
        ]);
        DB::table('sections')->insert([
            'name' => 'Discussion Boards',
            'section_weight' => 15,
            'current_progress' => 14.63,
            'classes_id' => 2
        ]);
        DB::table('sections')->insert([
            'name' => 'Tests',
            'section_weight' => 40,
            'current_progress' => 33.60,
            'classes_id' => 2
        ]);
        DB::table('sections')->insert([
            'name' => 'Tests',
            'section_weight' => 85,
            'current_progress' => 62.91,
            'classes_id' => 3
        ]);
        DB::table('sections')->insert([
            'name' => 'Quiz',
            'section_weight' => 15,
            'current_progress' => 11.75,
            'classes_id' => 3
        ]);

        // scores
        DB::table('assignments')->insert([
            'name' => 'Test 1',
            'max_score' => 60,
            'achieved_score' => 58,
            'assignment_weight' => 30,
            'grade' => 96.67,
            'weighted_grade' => 29.01,
            'section_id' => 1
        ]);
        DB::table('assignments')->insert([
            'name' => 'Test 2',
            'max_score' => 45,
            'achieved_score' => 38,
            'assignment_weight' => 30,
            'grade' => 84.44,
            'weighted_grade' => 25.33,
            'section_id' => 1
        ]);
        DB::table('assignments')->insert([
            'name' => 'Lab 1',
            'max_score' => 70,
            'achieved_score' => 70,
            'assignment_weight' => 10,
            'grade' => 100,
            'weighted_grade' => 10,
            'section_id' => 2
        ]);
        DB::table('assignments')->insert([
            'name' => 'Lab 2',
            'max_score' => 45,
            'achieved_score' => 44,
            'assignment_weight' => 10,
            'grade' => 97.78,
            'weighted_grade' => 9.78,
            'section_id' => 2
        ]);
        DB::table('assignments')->insert([
            'name' => 'Lab 3',
            'max_score' => 65,
            'achieved_score' => 60,
            'assignment_weight' => 10,
            'grade' => 92.31,
            'weighted_grade' => 9.23,
            'section_id' => 2
        ]);
        DB::table('assignments')->insert([
            'name' => 'Lab 4',
            'max_score' => 50,
            'achieved_score' => 48,
            'assignment_weight' => 10,
            'grade' => 96,
            'weighted_grade' => 9.60,
            'section_id' => 2
        ]);
        DB::table('assignments')->insert([
            'name' => 'Essay 1',
            'max_score' => 100,
            'achieved_score' => 96,
            'assignment_weight' => 9,
            'grade' => 96,
            'weighted_grade' => 8.64,
            'section_id' => 3
        ]);
        DB::table('assignments')->insert([
            'name' => 'Essay 2',
            'max_score' => 100,
            'achieved_score' => 65,
            'assignment_weight' => 9,
            'grade' => 65,
            'weighted_grade' => 5.85,
            'section_id' => 3
        ]);
        DB::table('assignments')->insert([
            'name' => 'Essay 3',
            'max_score' => 100,
            'achieved_score' => 100,
            'assignment_weight' => 9,
            'grade' => 100,
            'weighted_grade' => 9,
            'section_id' => 3
        ]);
        DB::table('assignments')->insert([
            'name' => 'Essay 4',
            'max_score' => 100,
            'achieved_score' => 90,
            'assignment_weight' => 9,
            'grade' => 90,
            'weighted_grade' => 8.1,
            'section_id' => 3
        ]);
        DB::table('assignments')->insert([
            'name' => 'Essay 5',
            'max_score' => 100,
            'achieved_score' => 100,
            'assignment_weight' => 9,
            'grade' => 100,
            'weighted_grade' => 9,
            'section_id' => 3
        ]);
        DB::table('assignments')->insert([
            'name' => 'Discussion Board 1',
            'max_score' => 20,
            'achieved_score' => 20,
            'assignment_weight' => 7.5,
            'grade' => 100,
            'weighted_grade' => 7.5,
            'section_id' => 4
        ]);
        DB::table('assignments')->insert([
            'name' => 'Discussion Board 2',
            'max_score' => 20,
            'achieved_score' => 19,
            'assignment_weight' => 7.5,
            'grade' => 95,
            'weighted_grade' => 7.13,
            'section_id' => 4
        ]);
        DB::table('assignments')->insert([
            'name' => 'Test 1',
            'max_score' => 50,
            'achieved_score' => 49,
            'assignment_weight' => 20,
            'grade' => 98,
            'weighted_grade' => 19.60,
            'section_id' => 5
        ]);
        DB::table('assignments')->insert([
            'name' => 'Test 2',
            'max_score' => 50,
            'achieved_score' => 35,
            'assignment_weight' => 20,
            'grade' => 70,
            'weighted_grade' => 14,
            'section_id' => 5
        ]);
        DB::table('assignments')->insert([
            'name' => 'Test 1',
            'max_score' => 50,
            'achieved_score' => 19,
            'assignment_weight' => 21.25,
            'grade' => 38,
            'weighted_grade' => 8.08,
            'section_id' => 6
        ]);
        DB::table('assignments')->insert([
            'name' => 'Test 2',
            'max_score' => 50,
            'achieved_score' => 35,
            'assignment_weight' => 21.25,
            'grade' => 70,
            'weighted_grade' => 14.88,
            'section_id' => 6
        ]);
        DB::table('assignments')->insert([
            'name' => 'Test 3',
            'max_score' => 50,
            'achieved_score' => 44,
            'assignment_weight' => 21.25,
            'grade' => 88,
            'weighted_grade' => 18.7,
            'section_id' => 6
        ]);
        DB::table('assignments')->insert([
            'name' => 'Test 4',
            'max_score' => 45,
            'achieved_score' => 45,
            'assignment_weight' => 21.25,
            'grade' => 100,
            'weighted_grade' => 21.25,
            'section_id' => 6
        ]);
        DB::table('assignments')->insert([
            'name' => 'Quiz 1',
            'max_score' => 30,
            'achieved_score' => 17,
            'assignment_weight' => 7.5,
            'grade' => 56.67,
            'weighted_grade' => 4.25,
            'section_id' => 7
        ]);
        DB::table('assignments')->insert([
            'name' => 'Quiz 2',
            'max_score' => 30,
            'achieved_score' => 30,
            'assignment_weight' => 7.5,
            'grade' => 100,
            'weighted_grade' => 7.5,
            'section_id' => 7
        ]);
    }
}

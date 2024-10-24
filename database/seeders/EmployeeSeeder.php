<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //DB::table('employees')->truncate();

        // Assign each employee to a random project from the projects table
        Project::all()->each(function ($project) {
            // Create 5 dummy employees per project
            Employee::factory()->count(5)->create([
                'project_id' => $project->id,
            ]);
        });
    }
}

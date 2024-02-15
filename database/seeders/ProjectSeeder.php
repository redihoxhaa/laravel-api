<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        // Temporarily disable foreign key checks
        Schema::disableForeignKeyConstraints();

        // Truncate the projects table
        Project::truncate();

        // Truncate the pivot table project_technology
        DB::table('project_technology')->truncate();

        // Re-enable foreign key checks
        Schema::enableForeignKeyConstraints();


        $projects = include base_path('data/projects.php');

        foreach ($projects as $index => $projectData) {
            $project = new Project();
            $project->id = $index + 1;
            $project->title = $projectData['title'];
            $project->type_id = $projectData['type_id'];
            $project->status_id = $projectData['status_id'];
            $project->start_date = $projectData['start_date'];
            if ($project->status_id === '2') {
                $project->end_date = $projectData['end_date'];
            }
            $project->slug = Str::slug($projectData['title']);
            $project->save();
            if (isset($projectData['technologies'])) {
                $project->technologies()->sync($projectData['technologies']);
            } else {
                $project->technologies()->sync([]);
            }
        }
    }
}

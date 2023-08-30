<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $projects = [
            'Progetto 1',
            'Progetto 2',
            'Progetto 3',
            'Progetto 4',
        ];

        foreach ($projects as $project) {
            $new_project = new Project();
            $new_project->title = $project;
            $new_project->description = $faker->sentence(10);
            $new_project->duration =  $faker->randomDigit();
            $new_project->image = 'placeholders/'. $faker->word();
            $new_project->status = 'In progress';
            $new_project->start_date = $faker->date();
            $new_project->end_date = $faker->date();
            $new_project->repositoryUrl = $faker->url();
            $new_project->slug = Str::slug($new_project->title, '-');
            $new_project->save();
        }
    }
}

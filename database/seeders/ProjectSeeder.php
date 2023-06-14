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
        $projects = ['Progetto 1', 'Progetto 3', 'Progetto home', 'Progetto XYZ'];

        foreach ($projects as $project) {
            $project = new Project();
            $project->title = $faker->word();
            $project->description = $faker->sentence(10);
            $project->slug = Str::slug($project->title, '-');
            $project->duration =  $faker->randomDigit();
            $project->status = 'inprogress';
            $project->start_date = $faker->date();
            $project->end_date = $faker->date();
            $project->save();
        }
    }
}

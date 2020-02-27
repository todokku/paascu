<?php

use Illuminate\Database\Seeder;
use App\AccreditedGraduateProgram;
class AccreditedGraduateProgramsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccreditedGraduateProgram::create([
        'program'=> 'Arts',
        ]);
        AccreditedGraduateProgram::create([
        'program'=> 'Sciences',
        ]);
        AccreditedGraduateProgram::create([
        'program'=> 'Education',
        ]);
        AccreditedGraduateProgram::create([
        'program'=> 'Business Administration',
        ]);
        AccreditedGraduateProgram::create([
        'program'=> 'Public Health',
        ]);
        AccreditedGraduateProgram::create([
        'program'=> 'Nursing',
        ]);
    }
}

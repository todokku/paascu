<?php

use Illuminate\Database\Seeder;
use App\Variable;
class VariableTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Variable::create([
        'code'=> 'total_enrollment',
        'title'=> 'Total Enrollment',
        ]);
        Variable::create([
        'code'=> 'annual_tuition_fee',
        'title'=> 'Annual Tuition Fee',
        ]);
        Variable::create([
        'code'=> 'gs_total_enrollment',
        'title'=> 'Grade School Total Enrollment',
        ]);
        Variable::create([
        'code'=> 'hs_total_enrollment',
        'title'=> 'High School Total Enrollment',
        ]);
    }
}

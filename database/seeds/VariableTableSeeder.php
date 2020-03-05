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
        'code'=> 'gs_total_enrollment',
        'title'=> 'Total Enrollment',
        'ed_type'=> 'Grade School',

        ]);
        Variable::create([
        'code'=> 'gs_annual_tuition_fee',
        'title'=> 'Annual Tuition Fee',
        'ed_type'=> 'Grade School',
        ]);
        Variable::create([
        'code'=> 'hs_total_enrollment',
        'title'=> 'Total Enrollment',
        'ed_type'=> 'High School',

        ]);
        Variable::create([
        'code'=> 'hs_annual_tuition_fee',
        'title'=> 'Annual Tuition Fee',
        'ed_type'=> 'High School',
        ]);
        Variable::create([
        'code'=> 'bed_gs_total_enrollment',
        'title'=> 'Grade School Total Enrollment',
        'ed_type'=> 'Basic Education',

        ]);
        Variable::create([
        'code'=> 'bed_hs_total_enrollment',
        'title'=> 'High School Total Enrollment',
        'ed_type'=> 'Basic Education',
        ]);
        Variable::create([
        'code'=> 'bed_annual_tuition_fee',
        'title'=> 'Annual Tuition Fee',
        'ed_type'=> 'Basic Education',
        ]);
        Variable::create([
        'code'=> 'col_sem_total_enrollment',
        'title'=> 'Total Enrollment',
        'ed_type'=> 'College Semester',
        ]);
        Variable::create([
        'code'=> 'col_sem_tuition_fee_per_unit',
        'title'=> 'Tuition Fee Per Unit',
        'ed_type'=> 'College Semester',
        ]);
        Variable::create([
        'code'=> 'col_sem_21_units',
        'title'=> '21 Units',
        'ed_type'=> 'College Semester',
        ]);
        Variable::create([
        'code'=> 'col_tri_total_enrollment',
        'title'=> 'Total Enrollment',
        'ed_type'=> 'College Trimester',
        ]);
        Variable::create([
        'code'=> 'col_tri_tuition_fee_per_unit',
        'title'=> 'Tuition Fee Per Unit',
        'ed_type'=> 'College Trimester',
        ]);
        Variable::create([
        'code'=> 'col_tri_21_units',
        'title'=> '21 Units',
        'ed_type'=> 'College Trimester',
        ]);
        Variable::create([
        'code'=> 'ged_sem_total_enrollment',
        'title'=> 'Total Enrollment',
        'ed_type'=> 'Graduate Education Semester',
        ]);
        Variable::create([
        'code'=> 'ged_sem_tuition_fee_per_unit',
        'title'=> 'Tuition Fee Per Unit',
        'ed_type'=> 'Graduate Education Semester',
        ]);
        Variable::create([
        'code'=> 'ged_sem_12_units',
        'title'=> '12 Units',
        'ed_type'=> 'Graduate Education Semester',
        ]);
        Variable::create([
        'code'=> 'ged_tri_total_enrollment',
        'title'=> 'Total Enrollment',
        'ed_type'=> 'Graduate Education Trimester',
        ]);
        Variable::create([
        'code'=> 'ged_tri_tuition_fee_per_unit',
        'title'=> 'Tuition Fee Per Unit',
        'ed_type'=> 'Graduate Education Trimester',
        ]);
        Variable::create([
        'code'=> 'ged_tri_21_units',
        'title'=> '21 Units',
        'ed_type'=> 'Graduate Education Trimester',
        ]);
    }
}

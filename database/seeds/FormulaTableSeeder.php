<?php

use Illuminate\Database\Seeder;
use App\Formula;
class FormulaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Formula::create([
        'formula_id'=> 'Grade School',
        'formula'=> 'gs_total_enrollment * gs_annual_tuition_fee',
        ]);

         Formula::create([
        'formula_id'=> 'High School',
        'formula'=> 'hs_total_enrollment * hs_annual_tuition_fee',
        ]);

         Formula::create([
        'formula_id'=> 'Basic Education',
        'formula'=> 'bed_gs_total_enrollment + bed_hs_total_enrollment * bed_annual_tuition_fee',
        ]);

        Formula::create([
        'formula_id'=> 'College Semester',
        'formula'=> 'col_sem_total_enrollment * col_sem_tuition_fee_per_unit * col_sem_21_units',
        ]);

        Formula::create([
        'formula_id'=> 'College Trimester',
        'formula'=> 'col_tri_total_enrollment * col_tri_tuition_fee_per_unit * col_tri_21_units',
        ]);

        Formula::create([
        'formula_id'=> 'Graduate Education Semester',
        'formula'=> 'ged_sem_total_enrollment * ged_sem_tuition_fee_per_unit * ged_sem_12_units',
        ]);

        Formula::create([
        'formula_id'=> 'Graduate Education Trimester',
        'formula'=> 'ged_tri_total_enrollment * ged_tri_tuition_fee_per_unit * ged_tri_21_units',
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;
use App\MembershipFormula;
class MembershipFormulaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         MembershipFormula::create([
        'variable'=> 'total_enrollment * annual_tuition_fee',
        'ed_type'=> 'Grade School',
        ]);
        MembershipFormula::create([
        'variable'=> 'total_enrollment * annual_tuition_fee',
        'ed_type'=> 'High School',
        ]);
        MembershipFormula::create([
        'variable'=> 'total_bed_enrollment * annual_tuition_fee',
        'ed_type'=> 'BED',
        ]);
        MembershipFormula::create([
        'variable'=> 'total_enrollment * tuition_fee_per_unit * 21_units',
        'ed_type'=> 'College',
        ]);
        MembershipFormula::create([
        'variable'=> 'total_enrollment * tuition_fee_per_unit',
        'ed_type'=> 'GED',
        ]);
    }
}

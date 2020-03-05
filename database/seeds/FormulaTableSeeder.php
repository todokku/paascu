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
        'formula_id'=> 'gs',
        'formula'=> 'total_enrollment*annual_tuition_fee',
        ]);

         Formula::create([
        'formula_id'=> 'hs',
        'formula'=> 'total_enrollment*annual_tuition_fee',
        ]);

         Formula::create([
        'formula_id'=> 'bed',
        'formula'=> '(gs_total_enrollment+hs_total_enrollment)*annual_tuition_fee',
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;
use App\ScheduleMembership;
class ScheduleMembershipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		 ScheduleMembership::create(['gtrs'=>0,       'gtre'=>999999,  'amf' =>1232.00]);
         ScheduleMembership::create(['gtrs'=>1000000,  'gtre'=>2000000,  'amf' =>1870.00]);
         ScheduleMembership::create(['gtrs'=>2000001,  'gtre'=>3000000,  'amf' =>3080.00]);
         ScheduleMembership::create(['gtrs'=>3000001,  'gtre'=>4000000,  'amf' =>4400.00]);
         ScheduleMembership::create(['gtrs'=>4000001,  'gtre'=>5000000,  'amf' =>5610.00]);
         ScheduleMembership::create(['gtrs'=>5000001,  'gtre'=>6000000,  'amf' =>6820.00]);
         ScheduleMembership::create(['gtrs'=>6000001,  'gtre'=>7000000,  'amf' =>8030.00]);
         ScheduleMembership::create(['gtrs'=>7000001,  'gtre'=>8000000,  'amf' =>9350.00]);
         ScheduleMembership::create(['gtrs'=>8000001,  'gtre'=>9000000,  'amf' =>10560.00]);
         ScheduleMembership::create(['gtrs'=>9000001,  'gtre'=>10000000, 'amf' =>11770.00]);
         ScheduleMembership::create(['gtrs'=>10000001, 'gtre'=>15000000, 'amf' =>14300.00]);
         ScheduleMembership::create(['gtrs'=>15000001, 'gtre'=>20000000, 'amf' =>15400.00]);
         ScheduleMembership::create(['gtrs'=>20000001, 'gtre'=>25000000, 'amf' =>16720.00]);
         ScheduleMembership::create(['gtrs'=>25000001, 'gtre'=>30000000, 'amf' =>17930.00]);
         ScheduleMembership::create(['gtrs'=>30000001, 'gtre'=>35000000, 'amf' =>19250.00]);
         ScheduleMembership::create(['gtrs'=>35000001, 'gtre'=>40000000, 'amf' =>20350.00]);
         ScheduleMembership::create(['gtrs'=>40000001, 'gtre'=>45000000, 'amf' =>21560.00]);
         ScheduleMembership::create(['gtrs'=>45000001, 'gtre'=>50000000, 'amf' =>22880.00]);
         ScheduleMembership::create(['gtrs'=>50000001, 'gtre'=>55000000, 'amf' =>24200.00]);
         ScheduleMembership::create(['gtrs'=>55000001, 'gtre'=>60000000, 'amf' =>25300.00]);
         ScheduleMembership::create(['gtrs'=>60000001, 'gtre'=>65000000, 'amf' =>26620.00]);
         ScheduleMembership::create(['gtrs'=>65000001, 'gtre'=>70000000, 'amf' =>27720.00]);
         ScheduleMembership::create(['gtrs'=>70000001, 'gtre'=>75000000, 'amf' =>29040.00]);
         ScheduleMembership::create(['gtrs'=>75000001, 'gtre'=>80000000, 'amf' =>30250.00]);
         ScheduleMembership::create(['gtrs'=>80000001, 'gtre'=>85000000, 'amf' =>31460.00]);
         ScheduleMembership::create(['gtrs'=>85000001, 'gtre'=>90000000, 'amf' =>33000.00]);
         ScheduleMembership::create(['gtrs'=>90000001, 'gtre'=>95000000, 'amf' =>34100.00]);
         ScheduleMembership::create(['gtrs'=>95000001, 'gtre'=>100000000,'amf' =>35200.00]);
         ScheduleMembership::create(['gtrs'=>100000001,'gtre'=>110000000,'amf' =>38830.00]);
         ScheduleMembership::create(['gtrs'=>110000001,'gtre'=>120000000,'amf' =>42570.00]);
         ScheduleMembership::create(['gtrs'=>120000001,'gtre'=>150000000,'amf' =>44550.00]);
         ScheduleMembership::create(['gtrs'=>150000001,'gtre'=>200000000,'amf' =>47300.00]);
         ScheduleMembership::create(['gtrs'=>200000001,'gtre'=>250000000,'amf' =>50600.00]);
         ScheduleMembership::create(['gtrs'=>250000001,'gtre'=>320000000,'amf' =>55000.00]);
         ScheduleMembership::create(['gtrs'=>320000001,'gtre'=>400000000,'amf' =>59950.00]);
         ScheduleMembership::create(['gtrs'=>400000001,'gtre'=>null,'amf' =>66000.00]);
    }
}



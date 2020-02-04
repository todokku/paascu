<?php

use Illuminate\Database\Seeder;
use App\Member;
class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Member::create([
        'institution'=> 'Far Eastern University Institute of Technology',
        'address'=> '839 P. Paredes, Sampaloc, Manila, 1015 Metro Manila',
        'program'=> 'Information Technology Specialization in Web, Mobile Applications',
        'level'=> 'III',
        'valid' => 'April 2020',
        ]);

        Member::create([
        'institution'=> 'San Beda University',
        'address'=> '638 Mendiola St, San Miguel, Manila, 1005 Metro Manila',
        'program'=> 'Business Administration',
        'level'=> 'III',
        'valid' => 'March 2020',
        ]);
    }
}

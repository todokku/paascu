<?php

use Illuminate\Database\Seeder;
use App\Members;
class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Members::create([
        'school'=> 'Far Eastern University Institute of Technology',
        'address'=> '839 P. Paredes, Sampaloc, Manila, 1015 Metro Manila',
        'status' => 'active'
        ]);

        Members::create([
        'school'=> 'San Beda University',
        'address'=> '638 Mendiola St, San Miguel, Manila, 1005 Metro Manila',
        'status' => 'active'
        ]);
    }
}

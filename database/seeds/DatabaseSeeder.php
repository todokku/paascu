<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	$this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(MembersTableSeeder::class);
        $this->call(ProgramsTableSeeder::class);
        $this->call(AccreditedCollegeProgramsTableSeeder::class);
        $this->call(AccreditedGraduateProgramsTableSeeder::class);
        $this->call(ScheduleMembershipTableSeeder::class);
        $this->call(MembershipFormulaTableSeeder::class);
    }
}

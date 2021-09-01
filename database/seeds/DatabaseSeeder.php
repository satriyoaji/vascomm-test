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
        $this->call(UserTableSeeder::class);
//        $this->call(JurnalTableSeeder::class);
//        $this->call(ProvinceTableSeeder::class);
//        $this->call(UniversityTableSeeder::class);
//        $this->call(TargetTableSeeder::class);
//        $this->call(IndeksasiTableSeeder::class);
//        $this->call(SkillTableSeeder::class);
    }
}

<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application'typeBuilds database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(RoleSeeder::class);
         $this->call(TypeBuildSeeder::class);
         $this->call(TypeCheckSeeder::class);

    }
}

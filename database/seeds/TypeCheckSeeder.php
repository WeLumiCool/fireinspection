<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeCheckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_checks')->truncate();
        DB::table('type_checks')->insert([
            ['name' => 'Плановая'],
            ['name' => 'Контрольная'],
            ['name' => 'Внеплановая'],
            ['name' => 'Оперативная'],
        ]);
    }
}

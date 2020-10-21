<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeBuildSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_builds')->truncate();
        DB::table('type_builds')->insert([
            ['name' => 'АЗС'],
            ['name' => 'Базар'],
            ['name' => 'ТЦ'],
            ['name' => 'Кафе'],
        ]);
    }
}

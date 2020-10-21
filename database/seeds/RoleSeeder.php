<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->truncate();
        DB::table('roles')->insert([
            ['name' => 'Администратор', 'is_admin'=>true],
            ['name' => 'Начальник', 'is_admin'=>true],
            ['name' => 'Заместитель', 'is_admin'=>false],
            ['name' => 'Инспектор', 'is_admin'=>false]
        ]);
    }
}

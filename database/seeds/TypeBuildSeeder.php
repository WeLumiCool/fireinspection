<?php

use Carbon\Carbon;
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
            [
                'name' => 'АЗС',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Базар',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'ТЦ',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Кафе',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')
            ],
        ]);
    }
}

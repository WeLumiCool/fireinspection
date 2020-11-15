<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropPointColumnsToChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('checks', function (Blueprint $table) {
            $table->dropColumn('has_aups');
            $table->dropColumn('has_aupt');
            $table->dropColumn('has_hydrant');
            $table->dropColumn('has_reservoir');
            $table->dropColumn('has_cranes');
            $table->dropColumn('has_evacuation');
            $table->dropColumn('has_foam');
            $table->dropColumn('has_shild');
            $table->dropColumn('legality');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('checks', function (Blueprint $table) {
            $table->boolean('has_aups');
            $table->boolean('has_aupt');
            $table->boolean('has_hydrant');
            $table->boolean('has_reservoir');
            $table->boolean('has_cranes');
            $table->boolean('has_evacuation');
            $table->boolean('has_foam');
            $table->boolean('has_shild');
            $table->boolean('legality');
        });
    }
}

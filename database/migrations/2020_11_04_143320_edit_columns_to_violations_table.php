<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditColumnsToViolationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('violations', function (Blueprint $table) {
            $table->dropColumn('note');
            $table->dropColumn('type_id');
            $table->dropColumn('check_id');
            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('violations', function (Blueprint $table) {
            $table->text('note');
            $table->unsignedInteger('type_id');
            $table->unsignedInteger('check_id');
            $table->dropColumn('name');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checks', function (Blueprint $table) {
            $table->id();
            $table->boolean('has_aups')->default(false);
            $table->boolean('has_aupt')->default(false);
            $table->text('psp_count');
            $table->boolean('has_hydrant')->default(false);
            $table->boolean('has_reservoir')->default(false);
            $table->boolean('has_cranes')->default(false);
            $table->boolean('has_evacuation')->default(false);
            $table->boolean('has_foam')->default(false);
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('build_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checks');
    }
}

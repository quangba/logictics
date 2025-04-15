<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarriersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carriers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('carrier');
            $table->string('pic');
            $table->string('pol');
            $table->string('pod');
            $table->date('effective_date');
            $table->date('expired_date');
            $table->string('freight');
            $table->string('freight_note');
            $table->string('frequency');
            $table->string('transit_time');
            $table->string('remarks');
            $table->string('input_user');
            $table->string('editor');
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
        Schema::dropIfExists('carriers');
    }
}

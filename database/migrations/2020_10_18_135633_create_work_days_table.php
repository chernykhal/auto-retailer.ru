<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_days', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->boolean('1')->nullable()->default(0);
            $table->boolean('2')->nullable()->default(0);
            $table->boolean('3')->nullable()->default(0);
            $table->boolean('4')->nullable()->default(0);
            $table->boolean('5')->nullable()->default(0);
            $table->boolean('6')->nullable()->default(0);
            $table->boolean('7')->nullable()->default(0);
            $table->boolean('8')->nullable()->default(0);
            $table->boolean('9')->nullable()->default(0);
            $table->boolean('10')->nullable()->default(0);
            $table->boolean('11')->nullable()->default(0);
            $table->boolean('12')->nullable()->default(0);
            $table->boolean('13')->nullable()->default(0);
            $table->boolean('14')->nullable()->default(0);
            $table->boolean('15')->nullable()->default(0);
            $table->boolean('16')->nullable()->default(0);
            $table->boolean('17')->nullable()->default(0);
            $table->boolean('18')->nullable()->default(0);
            $table->boolean('19')->nullable()->default(0);
            $table->boolean('20')->nullable()->default(0);
            $table->boolean('21')->nullable()->default(0);
            $table->boolean('22')->nullable()->default(0);
            $table->boolean('23')->nullable()->default(0);
            $table->boolean('24')->nullable()->default(0);
            $table->boolean('25')->nullable()->default(0);
            $table->boolean('26')->nullable()->default(0);
            $table->boolean('27')->nullable()->default(0);
            $table->boolean('28')->nullable()->default(0);
            $table->boolean('29')->nullable()->default(0);
            $table->boolean('30')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work_days');
    }
}

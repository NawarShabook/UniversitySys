<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dorm_student_reqs', function (Blueprint $table) {
            $table->id();
            $table->string('city');
            $table->integer('status')->default(0); //0 value mean not response yest, 1 value mean agree, 2 value mean reject 
            $table->string('note')->nullable();
            $table->foreignId('student_id')->references('id')->on('students')->onDelete('cascade');
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
        Schema::dropIfExists('dorm_student_reqs');
    }
};

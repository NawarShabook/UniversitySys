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
        Schema::create('dorm_students', function (Blueprint $table) {
            $table->id();
            $table->string('unit_name')->default(0);
            $table->integer('room_number')->default(0);
            $table->string('city');
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
        Schema::dropIfExists('dorm_students');
    }
};

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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('note')->nullable();
            $table->foreignId('college_id')->references('id')->on('colleges')->onDelete('cascade');
            $table->foreignId('classroom_id')->references('id')->on('classrooms')->onDelete('cascade');
            $table->foreignId('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->foreignId('teacher_id')->references('id')->on('teachers')->onDelete('cascade');

            $table->unique(['name','college_id', 'classroom_id', 'section_id']);
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
        Schema::dropIfExists('subjects');
    }
};

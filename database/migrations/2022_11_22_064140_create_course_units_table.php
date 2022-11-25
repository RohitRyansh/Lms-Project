<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('course_units', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignId('course_id')->constrained();
            $table->foreignId('unit_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('course_units');
    }
};

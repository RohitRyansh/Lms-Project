<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignId('role_id')->constrained();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('slug');
            $table->string('email')->unique();
            $table->integer('created_by');
            $table->bigInteger('phone_no');
            $table->string('password')->nullable();
            $table->string('image')->nullable();
            $table->boolean('email_status')->default(0);
            $table->boolean('status')->default(0);
            $table->softDeletes();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('users');
    }
};

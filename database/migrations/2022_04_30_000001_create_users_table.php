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
        Schema::create('users', function (Blueprint $table) {
            //$table->charset = 'utf8mb4';
            //$table->collation = 'utf8mb4_unicode_ci';
            $table->id();
            $table->string('name')->unique('name');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('middleName')->nullable();
            $table->string('password');
            $table->integer('leader')->default('1');
            $table->string('email');
            $table->rememberToken();
            $table->timestamps();            
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('users');
    }
};

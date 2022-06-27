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
        Schema::create('status', function (Blueprint $table) {
            //$table->charset = 'utf8mb4';
            //$table->collation = 'utf8mb4_unicode_ci';
            $table->id();
            $table->string('status', 100);
            $table->rememberToken(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('status');
    }
};

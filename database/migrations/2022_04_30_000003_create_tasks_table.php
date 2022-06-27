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
        Schema::create('tasks', function (Blueprint $table) {
            //$table->charset = 'utf8mb4';
            //$table->collation = 'utf8mb4_unicode_ci';
            $table->id();
            $table->string('title', 100);
            $table->string('discription', 9000);
            $table->timestamps();
            $table->timestamp('close_at')->nullable();
            $table->integer('priority');
            $table->integer('status');
            $table->foreignId('creator')->constrained('users')->onUpdate('cascade');
            $table->foreignId('responsible')->constrained('users')->onUpdate('cascade');
            $table->foreignId('projectId')->constrained('projects')->onUpdate('cascade');
            $table->integer('duration');
            $table->integer('log');
            $table->rememberToken(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};

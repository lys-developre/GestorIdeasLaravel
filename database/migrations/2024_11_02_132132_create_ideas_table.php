<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ideas', function (Blueprint $table) {
            // campos que coloca por defecto laravel para un id incremental y un stamp de fecha
            $table->id();
            // clave foranea que hace referencia a el usuario que creo la idea
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('titulo');
            $table->string('description');
            $table->unsignedInteger('likes');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ideas');
    }
};

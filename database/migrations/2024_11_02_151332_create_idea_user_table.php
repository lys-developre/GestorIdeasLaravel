<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta las migraciones para crear la tabla pivote 'idea_user'.
     * Esta tabla relaciona a los usuarios con las ideas que han "gustado".
     */
    public function up(): void
    {
        Schema::create('idea_user', function (Blueprint $table) {
            $table->id(); // Crea una columna 'id' como clave primaria de la tabla pivote
            $table->foreignId('idea_id') // Crea una columna 'idea_id' que referencia a la tabla 'ideas'
                ->constrained() // Establece la relación de clave foránea con la tabla 'ideas'
                ->cascadeOnDelete(); // Elimina las entradas en esta tabla si la idea asociada es eliminada

            $table->foreignId('user_id') // Crea una columna 'user_id' que referencia a la tabla 'users'
                ->constrained() // Establece la relación de clave foránea con la tabla 'users'
                ->cascadeOnDelete(); // Elimina las entradas en esta tabla si el usuario asociado es eliminado

            $table->timestamps(); // Crea columnas 'created_at' y 'updated_at' para el seguimiento de tiempos
        });
    }

    /**
     * Revierte las migraciones eliminando la tabla pivote 'idea_user'.
     */
    public function down(): void
    {
        Schema::dropIfExists('idea_user'); // Elimina la tabla si existe
    }
};

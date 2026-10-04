<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crea la tabla "iphones", que guarda el catálogo de la tienda.
     */
    public function up(): void
    {
        Schema::create('iphones', function (Blueprint $table) {
            $table->id();
            $table->string('modelo');                       // Ej: iPhone 18 Pro
            $table->string('almacenamiento');               // Ej: 256GB
            $table->string('color');                        // Ej: Borgoña
            $table->string('color_hex', 7)->default('#d2d2d7'); // Color en hexadecimal para la interfaz
            $table->string('descripcion')->nullable();      // Frase corta que se muestra bajo el nombre
            $table->boolean('nuevo')->default(false);       // Muestra la etiqueta "Nuevo"
            $table->decimal('precio', 10, 2);
            $table->integer('stock');
            $table->string('imagen')->nullable();           // Archivo dentro de public/img/iphones
            $table->timestamps();
        });
    }

    /**
     * Revierte la migración.
     */
    public function down(): void
    {
        Schema::dropIfExists('iphones');
    }
};

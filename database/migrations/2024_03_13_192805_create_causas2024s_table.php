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
        Schema::create('causas2024s', function (Blueprint $table) {
            $table->id();
            $table->string('numero_expediente');
            $table->string('caratula');
            $table->date('fecha_condena')->nullable();
            $table->date('fecha_remision')->nullable();
            $table->string('estado_administrativo');
            $table->string('partes')->nullable();
            $table->string('tipo');
            $table->string('obs');
            $table->date('vencimiento_condena')->nullable();
            $table->date('vencimiento_vista')->nullable();
            $table->date('fecha_ingreso');
            $table->enum('state', ['en tramite', 'archivado'])->default('en tramite')->nullable();
            $table->string('secretario');
        
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('causas2024s');
    }
};
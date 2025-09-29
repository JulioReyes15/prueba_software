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
        Schema::create('servicios', function (Blueprint $table) {
            
            $table->unsignedBigInteger('id_equipo');
            $table->foreign('id_equipo')
                ->references('id_equipo')
                ->on('equipos')
                ->onDelete('cascade');

            $table->unsignedBigInteger('id_tecnico');
            $table->foreign('id_tecnico')
                ->references('id_tecnico')
                ->on('tecnicos')
                ->onDelete('cascade');

            $table->date('fecha_recepcion');
            $table->text('problema_reportado');
            $table->enum('estado',
   ['recibido', 
            'reparando', 
            'finalizado', 
            'entregado'])
            ->default('recibido');
            $table->text('diagnostico')->nullable();
            $table->text('solucion')->nullable();
            $table->date('fecha_entrega')->nullable();           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicios');
    }
};

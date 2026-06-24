<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('parametros_empresa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained()->cascadeOnDelete();
            $table->decimal('salario_minimo', 12, 2);
            $table->decimal('porcentaje_ivss', 5, 2);
            $table->decimal('porcentaje_faov', 5, 2);
            $table->decimal('porcentaje_rpe', 5, 2);
            $table->decimal('valor_ut', 12, 2);
            $table->date('vigencia_desde');
            $table->date('vigencia_hasta')->nullable();
            $table->timestamps();

            $table->unique(['empresa_id', 'vigencia_desde']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parametros_empresa');
    }
};

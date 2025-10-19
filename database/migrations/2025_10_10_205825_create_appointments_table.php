<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() : void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();

            // Relaciones
            $table->foreignId('clinic_id')->constrained()->cascadeOnDelete();
            $table->foreignId('patient_id')->constrained()->cascadeOnDelete();
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            $table->foreignId('specialist_id')->constrained()->nullOnDelete();

            // Datos de la cita
            $table->dateTime('start_at');
            $table->integer('duration'); // minutos
            $table->dateTime('end_at')->nullable(); // opcional si calculas con duración

            // Estado de la cita
            $table->enum('status', ['scheduled', 'completed', 'cancelled'])
                ->default('scheduled');

            // Notas internas y visibilidad
            $table->text('notes')->nullable();
            $table->boolean('notified')->default(false); // si se envió recordatorio al paciente

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        Schema::dropIfExists('appointments');
    }
};

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
        // Supprime la table si elle existe déjà
        Schema::dropIfExists('reservation_siege');

        Schema::create('reservation_siege', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->constrained()->onDelete('cascade');
            $table->foreignId('siege_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            // Ensure each seat can only be reserved once per reservation
            $table->unique(['reservation_id', 'siege_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_siege');
    }
};

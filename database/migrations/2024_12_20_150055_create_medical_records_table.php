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
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('pet_id')->constrained('pets')->onDelete('cascade'); // References pets table
            $table->foreignId('vet_id')->nullable()->constrained('vets')->onDelete('set null'); // References vets table
            $table->foreignId('appointment_id')->nullable()->constrained('appointments')->onDelete('set null'); // References appointments table
            $table->string('condition'); // Medical condition or diagnosis
            $table->text('treatment')->nullable(); // Description of the treatment
            $table->date(column: 'recorded_at'); // Date of the medical record
            $table->timestamps(); // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};

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
        Schema::table('medical_records', function (Blueprint $table) {
            $table->foreignId('pet_id')->constrained('pets')->onDelete('cascade')->default(1); // References pets table
            $table->foreignId('vet_id')->nullable()->constrained('vets')->onDelete('set null')->default(1); // References vets table
            $table->foreignId('appointment_id')->nullable()->constrained('appointments')->onDelete('set null'); // References appointments table
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medical_records', function (Blueprint $table) {
            //
        });
    }
};

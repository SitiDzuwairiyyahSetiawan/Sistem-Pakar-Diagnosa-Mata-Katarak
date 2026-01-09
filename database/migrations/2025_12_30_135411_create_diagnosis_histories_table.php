<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('diagnosis_histories', function (Blueprint $table) {
            $table->id();
            $table->string('patient_name')->nullable();
            $table->integer('age')->nullable();
            $table->string('disease_code', 10);
            $table->string('disease_name');
            $table->decimal('confidence_level', 5, 2)->default(0);
            $table->text('symptoms_selected')->nullable();
            $table->json('answers')->nullable();
            $table->text('recommendation')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('diagnosis_histories');
    }
};
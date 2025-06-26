<?php
// database/migrations/xxxx_xx_xx_create_medical_information_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void

    {
        Schema::create('medical_information', function (Blueprint $table) {
            $table->id();

            $table->string('primary_disability')->nullable();
            $table->string('secondary_disability')->nullable();

            $table->boolean('requires_high_intensity_support')->default(false);

            // High-intensity support flags
            $table->boolean('complex_bowel_care')->default(false);
            $table->boolean('enteral_feeding')->default(false);
            $table->boolean('tracheostomy_care')->default(false);
            $table->boolean('urinary_catheters')->default(false);
            $table->boolean('ventilation')->default(false);
            $table->boolean('subcutaneous_injection')->default(false);

            // Communication
            $table->string('communication_method')->nullable(); // e.g., Verbal, Sign
            $table->enum('communication_assessment', ['Completed and Attached', 'Not Available'])->nullable();

            // Occupational therapy
            $table->enum('occupational_therapy_assessment', ['Completed and Attached', 'Not Available'])->nullable();

            // Mobility aids
            $table->boolean('hoisting')->default(false);
            $table->boolean('assisted_devices')->default(false);
            $table->string('mobility_other')->nullable();

            // Equipment
            $table->boolean('hospital_bed')->default(false);
            $table->boolean('pressure_mattresses')->default(false);
            $table->string('equipment_other')->nullable();

            // Challenging behaviours
            $table->text('challenging_behaviours')->nullable();

            // Behaviour Support Plan
            $table->enum('pbsp_attached', ['Yes', 'No'])->nullable();
            $table->enum('pbsp_required', ['Yes', 'No'])->nullable();
            $table->enum('pbsp_review_requested', ['Yes', 'No'])->nullable();
            $table->string('behaviour_support_practitioner_contact')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medical_information');
    }
};

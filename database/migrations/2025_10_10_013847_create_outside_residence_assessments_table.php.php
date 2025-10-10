<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('outside_assessments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('home_safety_checklist_assessment_id')
                  ->constrained('home_safety_checklist_assessments')
                  ->onDelete('cascade');

            // Prefixed field names
            $table->enum('outside_paths_veranda_steps', ['Yes', 'No', 'N/A', 'Unsure'])->nullable();
            $table->text('outside_paths_veranda_steps_strategy')->nullable();

            $table->enum('outside_pets_restrained', ['Yes', 'No', 'N/A', 'Unsure'])->nullable();
            $table->text('outside_pets_restrained_strategy')->nullable();

            $table->enum('outside_lighting_adequate', ['Yes', 'No', 'N/A', 'Unsure'])->nullable();
            $table->text('outside_lighting_adequate_strategy')->nullable();

            $table->enum('outside_door_easy_open', ['Yes', 'No', 'N/A', 'Unsure'])->nullable();
            $table->text('outside_door_easy_open_strategy')->nullable();

            $table->enum('outside_lawn_mower_condition', ['Yes', 'No', 'N/A', 'Unsure'])->nullable();
            $table->text('outside_lawn_mower_condition_strategy')->nullable();

            $table->enum('outside_electrical_condition', ['Yes', 'No', 'N/A', 'Unsure'])->nullable();
            $table->text('outside_electrical_condition_strategy')->nullable();

            $table->enum('outside_fire_hazards', ['Yes', 'No', 'N/A', 'Unsure'])->nullable();
            $table->text('outside_fire_hazards_strategy')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('outside_residence_assessments');
    }
};

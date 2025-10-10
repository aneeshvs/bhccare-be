<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('hallways_checks', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('home_safety_checklist_assessment_id')->index();
            $table->foreign('home_safety_checklist_assessment_id')
                ->references('id')
                ->on('home_safety_checklist_assessments')
                ->cascadeOnDelete();

            // ✅ Hallways / lounge / dining / bedroom
            $table->enum('hallways_lounge_dining_bedroom', ['Yes', 'No', 'N/A', 'Unsure'])->nullable();
            $table->string('hallways_lounge_dining_bedroom_strategy')->nullable();

            // ✅ Evidence of pests
            $table->enum('pests_evidence', ['Yes', 'No', 'N/A', 'Unsure'])->nullable();
            $table->string('pests_evidence_strategy')->nullable();

            // ✅ Adequate lighting/workspace
            $table->enum('lighting_workspace', ['Yes', 'No', 'N/A', 'Unsure'])->nullable();
            $table->string('lighting_workspace_strategy')->nullable();

            // ✅ Furniture stable
            $table->enum('furniture_stable', ['Yes', 'No', 'N/A', 'Unsure'])->nullable();
            $table->string('furniture_stable_strategy')->nullable();

            // ✅ Bed adjustable
            $table->enum('bed_adjustable', ['Yes', 'No', 'N/A', 'Unsure'])->nullable();
            $table->string('bed_adjustable_strategy')->nullable();

            // ✅ Electrical switches/power points
            $table->enum('electrical_switches', ['Yes', 'No', 'N/A', 'Unsure'])->nullable();
            $table->string('electrical_switches_strategy')->nullable();

            // ✅ Private sleeping space
            $table->enum('private_sleep_space', ['Yes', 'No', 'N/A', 'Unsure'])->nullable();
            $table->string('private_sleep_space_strategy')->nullable();

            // ✅ Fire hazards
            $table->enum('hallways_fire_hazards', ['Yes', 'No', 'N/A', 'Unsure'])->nullable();
            $table->string('hallways_fire_hazards_strategy')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hallways_safety_checks');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('outside_entries', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('home_safety_checklist_assessment_id')->index();
            $table->foreign('home_safety_checklist_assessment_id')
                ->references('id')
                ->on('home_safety_checklist_assessments')
                ->cascadeOnDelete();


            // ✅ Outside Residence Questions
            $table->enum('parking_adequate', ['Yes','No','N/A','Unsure'])->nullable();
            $table->text('parking_adequate_strategy')->nullable();

            $table->enum('pathway_surface', ['Yes','No','N/A','Unsure'])->nullable();
            $table->text('pathway_surface_strategy')->nullable();

            $table->enum('gates_entry_easy', ['Yes','No','N/A','Unsure'])->nullable();
            $table->text('gates_entry_easy_strategy')->nullable();

            $table->enum('lighting_adequate', ['Yes','No','N/A','Unsure'])->nullable();
            $table->text('lighting_adequate_strategy')->nullable();

            $table->enum('outdoor_fire_hazards', ['Yes','No','N/A','Unsure'])->nullable();
            $table->text('outdoor_fire_hazards_strategy')->nullable();


            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_safety_outside_entries');
    }
};

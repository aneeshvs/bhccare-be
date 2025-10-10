<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('home_miscellaneous', function (Blueprint $table) {
            $table->id();

            $table->foreignId('home_safety_checklist_assessment_id')
                ->constrained('home_safety_checklist_assessments')
                ->onDelete('cascade');

            // Prefixed fields
            $table->enum('misc_children_living_at_home', ['Yes', 'No', 'N/A', 'Unsure'])->nullable();
            $table->text('misc_children_living_at_home_strategy')->nullable();

            $table->enum('misc_weapons_stored_appropriately', ['Yes', 'No', 'N/A', 'Unsure'])->nullable();
            $table->text('misc_weapons_stored_appropriately_strategy')->nullable();

            $table->enum('misc_smoking_outside_only', ['Yes', 'No', 'N/A', 'Unsure'])->nullable();
            $table->text('misc_smoking_outside_only_strategy')->nullable();

            $table->enum('misc_mobility_issues', ['Yes', 'No', 'N/A', 'Unsure'])->nullable();
            $table->text('misc_mobility_issues_strategy')->nullable();

            $table->enum('misc_equipment_good_condition', ['Yes', 'No', 'N/A', 'Unsure'])->nullable();
            $table->text('misc_equipment_good_condition_strategy')->nullable();

            $table->enum('misc_ppe_requirements', ['Yes', 'No', 'N/A', 'Unsure'])->nullable();
            $table->text('misc_ppe_requirements_strategy')->nullable();

            $table->enum('misc_personal_threats', ['Yes', 'No', 'N/A', 'Unsure'])->nullable();
            $table->text('misc_personal_threats_strategy')->nullable();

            $table->enum('misc_safe_neighbourhood', ['Yes', 'No', 'N/A', 'Unsure'])->nullable();
            $table->text('misc_safe_neighbourhood_strategy')->nullable();

            $table->enum('misc_aggression_in_home', ['Yes', 'No', 'N/A', 'Unsure'])->nullable();
            $table->text('misc_aggression_in_home_strategy')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_safety_miscellaneous');
    }
};

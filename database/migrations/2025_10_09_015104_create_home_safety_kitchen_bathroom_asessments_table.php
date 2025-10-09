<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kitchen_asessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('home_safety_checklist_assessment_id')
                  ->constrained('home_safety_checklist_assessments')
                  ->onDelete('cascade');

            $table->enum('floor_condition', ['Yes', 'No', 'N/A', 'Unsure'])->nullable();
            $table->text('floor_condition_strategy')->nullable();

            $table->enum('electrical_condition', ['Yes', 'No', 'N/A', 'Unsure'])->nullable();
            $table->text('electrical_condition_strategy')->nullable();

            $table->enum('ventilation_condition', ['Yes', 'No', 'N/A', 'Unsure'])->nullable();
            $table->text('ventilation_condition_strategy')->nullable();

            $table->enum('bench_condition', ['Yes', 'No', 'N/A', 'Unsure'])->nullable();
            $table->text('bench_condition_strategy')->nullable();

            $table->enum('stove_condition', ['Yes', 'No', 'N/A', 'Unsure'])->nullable();
            $table->text('stove_condition_strategy')->nullable();

            $table->enum('fridge_condition', ['Yes', 'No', 'N/A', 'Unsure'])->nullable();
            $table->text('fridge_condition_strategy')->nullable();

            $table->enum('bath_access', ['Yes', 'No', 'N/A', 'Unsure'])->nullable();
            $table->text('bath_access_strategy')->nullable();

            $table->enum('toilet_access', ['Yes', 'No', 'N/A', 'Unsure'])->nullable();
            $table->text('toilet_access_strategy')->nullable();

            $table->enum('privacy_condition', ['Yes', 'No', 'N/A', 'Unsure'])->nullable();
            $table->text('privacy_condition_strategy')->nullable();

            $table->enum('laundry_condition', ['Yes', 'No', 'N/A', 'Unsure'])->nullable();
            $table->text('laundry_condition_strategy')->nullable();

            $table->enum('ironing_condition', ['Yes', 'No', 'N/A', 'Unsure'])->nullable();
            $table->text('ironing_condition_strategy')->nullable();

            $table->enum('manual_handling_risks', ['Yes', 'No', 'N/A', 'Unsure'])->nullable();
            $table->text('manual_handling_strategy')->nullable();

            $table->enum('kitchen_fire_hazards', ['Yes', 'No', 'N/A', 'Unsure'])->nullable();
            $table->text('kitchen_fire_hazards_strategy')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_safety_kitchen_bathroom_assessments');
    }
};

<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('inside_residences', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('home_safety_checklist_assessment_id')->index();
            $table->foreign('home_safety_checklist_assessment_id')
                ->references('id')
                ->on('home_safety_checklist_assessments')
                ->cascadeOnDelete();

            $table->enum('exit_doors_unobstructed', ['Yes','No','N/A','Unsure'])->nullable();
            $table->string('exit_doors_unobstructed_strategy')->nullable();

            $table->enum('heaters_suitable', ['Yes','No','N/A','Unsure'])->nullable();
            $table->string('heaters_suitable_strategy')->nullable();

            $table->enum('aids_equipment_condition', ['Yes','No','N/A','Unsure'])->nullable();
            $table->string('aids_equipment_condition_strategy')->nullable();

            $table->enum('evidence_of_pests', ['Yes','No','N/A','Unsure'])->nullable();
            $table->string('evidence_of_pests_strategy')->nullable();

            $table->enum('participant_open_door', ['Yes','No','N/A','Unsure'])->nullable();
            $table->string('participant_open_door_strategy')->nullable();

            $table->enum('fire_hazards', ['Yes','No','N/A','Unsure'])->nullable();
            $table->string('fire_hazards_strategy')->nullable();

            $table->enum('vacuum_cleaner_ok', ['Yes','No','N/A','Unsure'])->nullable();
            $table->string('vacuum_cleaner_ok_strategy')->nullable();

            $table->enum('mop_bucket_ok', ['Yes','No','N/A','Unsure'])->nullable();
            $table->string('mop_bucket_ok_strategy')->nullable();

            $table->enum('step_ladder_ok', ['Yes','No','N/A','Unsure'])->nullable();
            $table->string('step_ladder_ok_strategy')->nullable();

            $table->enum('cleaning_substances_ok', ['Yes','No','N/A','Unsure'])->nullable();
            $table->string('cleaning_substances_ok_strategy')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_safety_inside_residences');
    }
};

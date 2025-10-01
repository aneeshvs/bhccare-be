<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('plan_manual_handlings', function (Blueprint $table) {
            $table->id();

           $table->unsignedBigInteger('individual_risk_assessment_id')->nullable();


            $table->string('goal_key')->nullable();

            // Fields
            $table->boolean('training_provided')->nullable(); // Yes/No
            $table->text('training_hazards')->nullable();
            $table->text('training_management_plan')->nullable();

            $table->boolean('tasks_safe')->nullable(); // Yes/No
            $table->text('tasks_hazards')->nullable();
            $table->text('tasks_management_plan')->nullable();

            $table->foreign('individual_risk_assessment_id')
                  ->references('id')->on('individual_risk_assessments')
                  ->onDelete('cascade');



            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plan_manual_handlings');
    }
};

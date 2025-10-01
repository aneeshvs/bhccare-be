<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('assessment_personal_care', function (Blueprint $table) {
            $table->id();

            // Foreign key
            $table->unsignedBigInteger('individual_risk_assessment_id')->nullable();
            $table->foreign('individual_risk_assessment_id')
                  ->references('id')->on('individual_risk_assessments')
                  ->onDelete('cascade');

            // Personal care fields
            $table->boolean('showering')->default(false);
            $table->text('showering_hazards')->nullable();
            $table->text('showering_management_plan')->nullable();

            $table->boolean('meal')->default(false);
            $table->text('meal_hazards')->nullable();
            $table->text('meal_management_plan')->nullable();

            $table->boolean('toileting')->default(false);
            $table->text('toileting_hazards')->nullable();
            $table->text('toileting_management_plan')->nullable();

            $table->boolean('grooming')->default(false);
            $table->text('grooming_hazards')->nullable();
            $table->text('grooming_management_plan')->nullable();

            $table->boolean('repositioning_bed')->default(false);
            $table->text('repositioning_bed_hazards')->nullable();
            $table->text('repositioning_bed_management_plan')->nullable();

            $table->boolean('repositioning_chair')->default(false);
            $table->text('repositioning_chair_hazards')->nullable();
            $table->text('repositioning_chair_management_plan')->nullable();

            $table->boolean('mouthcare')->default(false);
            $table->text('mouthcare_hazards')->nullable();
            $table->text('mouthcare_management_plan')->nullable();

            $table->boolean('skin_care')->default(false);
            $table->text('skin_care_hazards')->nullable();
            $table->text('skin_care_management_plan')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assessment_personal_care_supports');
    }
};

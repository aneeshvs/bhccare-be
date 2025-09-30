<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('assessment_communications', function (Blueprint $table) {
            $table->id();

            // Foreign key to parent risk assessment
            $table->unsignedBigInteger('individual_risk_assessment_id')->nullable();
            $table->foreign('individual_risk_assessment_id')
                  ->references('id')->on('individual_risk_assessments')
                  ->onDelete('cascade');

            // Communication fields
            $table->boolean('hearing_impairment')->default(false);
            $table->text('hearing_hazards')->nullable();
            $table->text('hearing_management_plan')->nullable();

            $table->boolean('speech_impairment')->default(false);
            $table->text('speech_hazards')->nullable();
            $table->text('speech_management_plan')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assessment_communications');
    }
};

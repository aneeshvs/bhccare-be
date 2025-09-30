<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('assessment_cognitions', function (Blueprint $table) {
            $table->id();

            // Foreign key
            $table->unsignedBigInteger('individual_risk_assessment_id')->nullable();
            $table->foreign('individual_risk_assessment_id')
                  ->references('id')->on('individual_risk_assessments')
                  ->onDelete('cascade');

            // Cognition fields
            $table->boolean('oriented_in_time_place')->default(false);
            $table->text('oriented_hazards')->nullable();
            $table->text('oriented_management_plan')->nullable();

            $table->boolean('accepts_direction')->default(false);
            $table->text('direction_hazards')->nullable();
            $table->text('direction_management_plan')->nullable();

            $table->boolean('short_term_memory_issues')->default(false);
            $table->text('memory_hazards')->nullable();
            $table->text('memory_management_plan')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assessment_cognitions');
    }
};

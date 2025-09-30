<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('assessment_details', function (Blueprint $table) {
            $table->id();

            // Foreign key to parent assessment
            $table->unsignedBigInteger('individual_risk_assessment_id')->nullable();
            $table->foreign('individual_risk_assessment_id')
                  ->references('id')->on('individual_risk_assessments')
                  ->onDelete('cascade');

            // Risk detail fields
            $table->enum('vulnerability', ['high', 'medium', 'low'])->nullable();
            $table->enum('review_frequency', ['3_months', '6_months', '12_months'])->nullable();
            $table->boolean('dependent_on_homecare')->default(false);


            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assessment_details');
    }
};

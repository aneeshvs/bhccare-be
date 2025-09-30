<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('individual_risk_assessments', function (Blueprint $table) {
            $table->id();

            // Foreign keys
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('staff_id')->nullable();
            $table->unsignedTinyInteger('client_type')->nullable(); // 1 = participant, 2 = representative

            // Risk Assessment fields
            $table->string('client_name')->nullable();
            $table->string('site_address')->nullable();
            $table->date('assessment_date')->nullable();
            $table->date('planned_review_date')->nullable();

            // Tracking
            $table->enum('form_status', ['in_progress', 'completed', 'draft'])->default('in_progress');
            $table->unsignedTinyInteger('completion_percentage')->default(0);

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('individual_risk_assessments');
    }
};

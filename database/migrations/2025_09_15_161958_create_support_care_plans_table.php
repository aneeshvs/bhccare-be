<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('support_care_plans', function (Blueprint $table) {
            $table->id();

            // Foreign keys
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('staff_id')->nullable();
            $table->unsignedTinyInteger('client_type')->nullable(); // 1 = participant, 2 = representative

            // Participant details
            $table->string('consents_participant_first_name')->nullable();
            $table->string('consents_participant_surname')->nullable();
            $table->date('consents_participant_dob')->nullable();
            $table->date('consents_goal_plan_start_date')->nullable();
            $table->date('consents_goal_plan_review_date')->nullable();

            // Form tracking
            $table->enum('form_status', ['in_progress', 'completed', 'draft'])->default('in_progress');
            $table->unsignedTinyInteger('completion_percentage')->default(0);

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_care_plans');
    }
};

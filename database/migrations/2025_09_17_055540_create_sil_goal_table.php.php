<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sil_goals', function (Blueprint $table) {
            $table->id();

            // FK to support_care_plans
            $table->foreignId('support_care_plan_id')
                  ->constrained('support_care_plans')
                  ->onDelete('cascade');

            // Unique key for tracking goals
            $table->string('goal_key')->nullable();

            $table->enum('category', ['sil', 'support_coordination', 'homecare'])
                  ->default('sil')
                  ->index();
            // Goal fields
            $table->string('goal_title')->nullable();
            $table->text('goals_of_support')->nullable();
            $table->text('steps')->nullable();
            $table->text('organisation_steps')->nullable();
            $table->text('risk')->nullable();
            $table->text('risk_management_strategies')->nullable();

            // Default system columns (instead of timestamps)
            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sil_goals');
    }
};

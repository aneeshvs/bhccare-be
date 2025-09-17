<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('support_coordination_goals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('support_care_plan_id')
                ->constrained('support_care_plans')
                ->onDelete('cascade');

            $table->string('goal_key')->nullable(); // unique identifier
            $table->string('goal_title')->nullable(); // Example: "Goal #1"

            $table->text('goals_of_support')->nullable();
            $table->text('steps')->nullable();
            $table->text('organisation_steps')->nullable();
            $table->text('risk')->nullable();
            $table->text('risk_management_strategies')->nullable();

            // Use MigrationHelper to keep consistent with your project
            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_coordination_goals');
    }
};

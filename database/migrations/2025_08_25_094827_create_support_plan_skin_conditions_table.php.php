<?php

use Illuminate\Database\Migrations\Migration;
use App\Classes\MigrationHelper;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('support_plan_skin_conditions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('support_plan_id')->constrained('support_plans')->onDelete('cascade');

            $table->boolean('has_skin_condition')->nullable();
            $table->string('skin_condition_type')->nullable(); // e.g. Pressure Ulcer, Eczema
            $table->boolean('impacts_daily_activities')->nullable();
            $table->date('impact_date')->nullable();

            $table->string('pain_discomfort_level')->nullable(); // e.g. Mild / Moderate / Significant
            $table->integer('pain_level_score')->nullable(); // e.g. 1-10
            $table->text('management_strategies')->nullable();

            $table->boolean('skin_condition_worry')->nullable();
            $table->date('worry_date')->nullable();

            $table->boolean('referral_nursing_required')->nullable();
            $table->date('referral_nursing_date')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_plan_skin_conditions');
    }
};

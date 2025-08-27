<?php

use Illuminate\Database\Migrations\Migration;
use App\Classes\MigrationHelper;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('support_plan_power_outages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('support_plan_id')->constrained('support_plans')->onDelete('cascade');

            $table->boolean('has_medical_equipment')->nullable();

            $table->boolean('has_backup_power')->nullable();
            $table->text('backup_power_details')->nullable();

            $table->boolean('registered_life_support')->nullable();
            $table->string('life_support_hours_supply')->nullable();
            $table->string('life_support_provider')->nullable();

            $table->boolean('power_independent_leave_home')->nullable();
            $table->text('power_independent_leave_home_details')->nullable();

            $table->boolean('power_has_support_checkin')->nullable();
            $table->text('power_has_support_checkin_details')->nullable();

            $table->boolean('power_welfare_check_required')->nullable();
            $table->text('power_welfare_check_required_details')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_plan_power_outages');
    }
};

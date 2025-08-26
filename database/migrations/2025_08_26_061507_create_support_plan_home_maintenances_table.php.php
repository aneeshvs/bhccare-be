<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('support_plan_home_maintenances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('support_plan_id')->constrained('support_plans')->onDelete('cascade');

            $table->boolean('needs_domestic_assistance')->nullable();
            $table->string('domestic_assistance_type')->nullable(); // Independent / Supported
            $table->text('domestic_assistance_details')->nullable();

            $table->boolean('needs_help_with_cleaning_products')->nullable();
            $table->text('cleaning_products_details')->nullable();

            $table->boolean('needs_garden_support')->nullable();
            $table->text('garden_support_details')->nullable();

            $table->boolean('trouble_navigating_at_night')->nullable();
            $table->text('navigating_at_night_details')->nullable();

            $table->boolean('home_maintenance_worries')->nullable();
            $table->text('home_maintenance_worries_details')->nullable();

            $table->date('last_home_safety_assessment')->nullable();
            $table->text('home_safety_focus_areas')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_plan_home_maintenances');
    }
};

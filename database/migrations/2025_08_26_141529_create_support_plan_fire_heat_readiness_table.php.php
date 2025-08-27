<?php

use Illuminate\Database\Migrations\Migration;
use App\Classes\MigrationHelper;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('support_plan_fire_heat_readiness', function (Blueprint $table) {
            $table->id();
            $table->foreignId('support_plan_id')->constrained('support_plans')->onDelete('cascade');

            $table->boolean('home_preparation_support')->nullable();
            $table->text('home_preparation_details')->nullable();

            $table->boolean('hydration_access')->nullable();
            $table->text('hydration_details')->nullable();

            $table->boolean('home_cooling')->nullable();
            $table->text('home_cooling_details')->nullable();

            $table->boolean('multiple_exit_points')->nullable();
            $table->text('exit_points_details')->nullable();

            $table->boolean('identify_fire_risk')->nullable();
            $table->text('fire_risk_details')->nullable();

            $table->boolean('can_evacuate_independently')->nullable();
            $table->text('evacuate_independently_details')->nullable();

            $table->boolean('support_from_family_or_neighbour')->nullable();
            $table->text('support_from_family_or_neighbour_details')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_plan_fire_heat_readiness');
    }
};

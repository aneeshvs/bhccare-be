<?php

use Illuminate\Database\Migrations\Migration;
use App\Classes\MigrationHelper;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('support_plan_storm_floodings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('support_plan_id')
                  ->constrained('support_plans')
                  ->onDelete('cascade');

            $table->boolean('storm_home_preparation_support')->nullable();
            $table->text('storm_home_preparation_details')->nullable();

            $table->boolean('multiple_exit_points')->nullable();
            $table->text('multiple_exit_points_details')->nullable();

            $table->boolean('identify_flood_risk')->nullable();
            $table->text('identify_flood_risk_details')->nullable();

            $table->boolean('storm_can_evacuate_independently')->nullable();
            $table->text('storm_evacuate_independently_details')->nullable();

            $table->boolean('storm_support_from_family_or_neighbour')->nullable();
            $table->text('storm_support_from_family_or_neighbour_details')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_plan_storm_floodings');
    }
};

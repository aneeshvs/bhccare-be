<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('plan_emergency_scenarios', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('support_care_plan_id');

            $table->boolean('admitted_to_hospital')->nullable();
            $table->text('admitted_to_hospital_action')->nullable();

            $table->boolean('medical_emergencies')->nullable();
            $table->text('medical_emergencies_action')->nullable();

            $table->boolean('other_likely_medical_emergency')->nullable();
            $table->text('other_likely_medical_emergency_action')->nullable();

            $table->boolean('natural_disaster')->nullable();
            $table->text('natural_disaster_action')->nullable();

            $table->foreign('support_care_plan_id')
                ->references('id')->on('support_care_plans')
                ->onDelete('cascade');

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plan_emergency_scenarios');
    }
};

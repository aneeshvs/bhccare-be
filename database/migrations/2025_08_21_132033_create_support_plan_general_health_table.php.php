<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('support_plan_general_health', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('support_plan_id')->index();
            $table->foreign('support_plan_id')->references('id')->on('support_plans')->onDelete('cascade');

            $table->string('gp_visit_frequency')->nullable();
            $table->boolean('admitted_hospital_last12months')->nullable();
            $table->text('admitted_hospital_details')->nullable();

            $table->boolean('preferred_hospital')->nullable();
            $table->text('preferred_hospital_details')->nullable();

            $table->text('diagnosis_medication_conditions')->nullable();
            $table->text('previous_surgeries')->nullable();

            $table->boolean('has_allergies')->nullable();
            $table->text('allergy_details')->nullable();

            $table->integer('health_impact_scale')->nullable();
            $table->boolean('painful_day_to_day')->nullable();
            $table->text('painful_day_to_day_details')->nullable();

            $table->boolean('weight_loss_last3months')->nullable();
            $table->text('weight_loss_details')->nullable();

            $table->boolean('nutritional_concerns')->nullable();
            $table->text('nutritional_concerns_details')->nullable();

            $table->string('current_weight')->nullable();

            $table->boolean('annual_vaccinations')->nullable();
            $table->text('annual_vaccination_details')->nullable();

            $table->date('last_influenza_vaccine')->nullable();
            $table->date('last_covid19_vaccine')->nullable();
            $table->date('last_pneumonia_vaccine')->nullable();

            $table->boolean('sleep_difficulties')->nullable();
            $table->text('sleep_difficulties_details')->nullable();

            $table->text('sleep_routine')->nullable();

            $table->boolean('sleep_routine_worries')->nullable();
            $table->text('sleep_routine_worries_details')->nullable();

            $table->boolean('alcohol_smoke_drug_use')->nullable();
            $table->text('alcohol_smoke_drug_details')->nullable();

            $table->boolean('alcohol_smoke_drug_worries')->nullable();
            $table->text('alcohol_smoke_drug_worries_details')->nullable();

            $table->boolean('referral_required')->nullable();
            $table->text('referral_required_details')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_plan_general_health');
    }
};

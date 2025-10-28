<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('onboarding_packing_signoffs', function (Blueprint $table) {
            $table->id();

            // 🔗 Related staff and user
            $table->unsignedBigInteger('staff_id')->nullable()->index();
            $table->foreign('staff_id')->references('id')->on('staff')->nullOnDelete();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->tinyInteger('client_type')->default(1);

            // ✅ Checklist fields
            $table->boolean('service_agreement_provided')->default(false);
            $table->date('service_agreement_date')->nullable();

            $table->boolean('participant_handbook_provided')->default(false);
            $table->date('participant_handbook_date')->nullable();

            $table->boolean('support_care_plan_offered')->default(false);
            $table->date('support_care_plan_date')->nullable();

            $table->boolean('consent_form_signed')->default(false);
            $table->date('consent_form_date')->nullable();

            $table->boolean('feedback_form_provided')->default(false);
            $table->date('feedback_form_date')->nullable();

            $table->boolean('home_safety_check_conducted')->default(false);
            $table->date('home_safety_check_date')->nullable();

            $table->boolean('medication_consent_form')->default(false);
            $table->date('medication_consent_date')->nullable();

            $table->boolean('onboarding_form_completed')->default(false);
            $table->date('onboarding_form_date')->nullable();

            $table->boolean('risk_assessment_completed')->default(false);
            $table->date('risk_assessment_date')->nullable();

            $table->boolean('behaviour_support_plan_obtained')->default(false);
            $table->date('behaviour_support_plan_date')->nullable();

            $table->boolean('high_intensity_support_plan_obtained')->default(false);
            $table->date('high_intensity_support_plan_date')->nullable();

            $table->boolean('mealtime_plan_obtained')->default(false);
            $table->date('mealtime_plan_date')->nullable();

            $table->boolean('sil_occupancy_agreement_provided')->default(false);
            $table->date('sil_occupancy_agreement_date')->nullable();

            $table->boolean('external_provider_agreement_completed')->default(false);
            $table->date('external_provider_agreement_date')->nullable();

            $table->boolean('sda_residency_agreement_provided')->default(false);
            $table->date('sda_residency_agreement_date')->nullable();

            $table->boolean('sda_welcome_pack_provided')->default(false);
            $table->date('sda_welcome_pack_date')->nullable();

            $table->boolean('sda_residency_statement_provided')->default(false);
            $table->date('sda_residency_statement_date')->nullable();


            // ✅ Status fields
            $table->string('form_status')->default('in_progress');
            $table->integer('completion_percentage')->default(0);

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('onboarding_packing_signoffs');
    }
};

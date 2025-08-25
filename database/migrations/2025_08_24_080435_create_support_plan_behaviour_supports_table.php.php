<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('support_plan_behaviour_supports', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('support_plan_id')->index();
            $table->foreign('support_plan_id')
                ->references('id')
                ->on('support_plans')
                ->onDelete('cascade');

            $table->boolean('feeling_agitation')->nullable();
            $table->text('feeling_agitation_details')->nullable();

            $table->boolean('delusions_hallucinations')->nullable();
            $table->text('delusions_hallucinations_details')->nullable();

            $table->boolean('personality_changes')->nullable();
            $table->text('personality_changes_details')->nullable();

            $table->boolean('wandering_purpose')->nullable();
            $table->text('wandering_purpose_details')->nullable();

            $table->boolean('absconding_concerns')->nullable();
            $table->text('absconding_concerns_details')->nullable();

            $table->boolean('verbal_threats')->nullable();
            $table->text('verbal_threats_details')->nullable();

            $table->boolean('physical_assault')->nullable();
            $table->text('physical_assault_details')->nullable();

            $table->boolean('restrictive_interventions')->nullable();
            $table->text('restrictive_interventions_details')->nullable();

            $table->boolean('restrictive_physical')->nullable();
            $table->boolean('restrictive_approved_by_practitioner')->nullable();
            $table->text('restrictive_practitioner_details')->nullable();

            $table->text('current_strategies')->nullable();

            $table->boolean('referral_positive_behaviour_practitioner')->nullable();
            $table->text('referral_positive_behaviour_practitioner_details')->nullable();

            $table->boolean('behaviour_support_plan_required')->nullable();
            $table->date('behaviour_support_plan_expiry')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_plan_behaviour_supports');
    }
};

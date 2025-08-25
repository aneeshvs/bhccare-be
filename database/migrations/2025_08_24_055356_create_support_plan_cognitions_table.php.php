<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('support_plan_cognitions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('support_plan_id')->index();
            $table->foreign('support_plan_id')->references('id')->on('support_plans')->onDelete('cascade');

            $table->boolean('cognitive_concerns')->nullable();
            $table->text('cognitive_concerns_details')->nullable();

            $table->boolean('diagnosis_dementia')->nullable();
            $table->text('diagnosis_dementia_details')->nullable();

            $table->boolean('capable_of_decisions')->nullable();
            $table->text('capable_of_decisions_details')->nullable();

            $table->boolean('has_power_of_attorney')->nullable();
            $table->text('power_of_attorney_details')->nullable();

            $table->boolean('becomes_confused')->nullable();
            $table->text('becomes_confused_details')->nullable();

            $table->boolean('experienced_delirium')->nullable();
            $table->text('experienced_delirium_details')->nullable();

            $table->boolean('anxious_or_worry')->nullable();
            $table->text('anxious_or_worry_details')->nullable();

            $table->boolean('short_term_memory_loss')->nullable();
            $table->text('short_term_memory_loss_details')->nullable();

            $table->boolean('long_term_memory_loss')->nullable();
            $table->text('long_term_memory_loss_details')->nullable();

            $table->boolean('atsi_kica_cog_required')->nullable();
            $table->string('atsi_kica_cog_file')->nullable();

            $table->boolean('atsi_kica_carer_required')->nullable();
            $table->string('atsi_kica_carer_file')->nullable();

            $table->boolean('gpcog_required')->nullable();
            $table->string('gpcog_file')->nullable();

            $table->boolean('health_literacy_support')->nullable();
            $table->text('health_literacy_support_details')->nullable();

            $table->boolean('gds_required')->nullable();
            $table->string('gds_file')->nullable();

            $table->boolean('referral_geriatrician')->nullable();
            $table->text('referral_geriatrician_details')->nullable();

            $table->boolean('referral_psychologist')->nullable();
            $table->text('referral_psychologist_details')->nullable();

            $table->boolean('referral_psychiatrist')->nullable();
            $table->text('referral_psychiatrist_details')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_plan_cognitions');
    }
};

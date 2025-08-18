<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('support_plan_fundings', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('support_plan_id')->index();
            $table->foreign('support_plan_id')->references('id')->on('support_plans')->onDelete('cascade');

            $table->string('aged_care_id')->nullable();
            $table->string('pension_status')->nullable();
            $table->string('pension_card_details')->nullable();
            $table->string('card_number')->nullable();
            $table->date('card_expiry')->nullable();
            $table->string('approved_funding_level')->nullable();
            $table->boolean('awaiting_package_upgrade')->nullable();
            $table->text('upgrade_details')->nullable();
            $table->boolean('has_chsp_referral_codes')->nullable();
            $table->text('chsp_referral_details')->nullable();
            $table->boolean('war_veteran_or_widow')->nullable();
            $table->string('dva_number')->nullable();
            $table->string('medicare_number')->nullable();
            $table->string('private_health_insurance')->nullable();
            $table->string('hcp_funding_level')->nullable();
            $table->boolean('has_companion_card')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_plan_fundings');
    }
};

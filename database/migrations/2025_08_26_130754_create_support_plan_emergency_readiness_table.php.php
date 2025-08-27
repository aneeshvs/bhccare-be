<?php

use Illuminate\Database\Migrations\Migration;
use App\Classes\MigrationHelper;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('support_plan_emergency_readiness', function (Blueprint $table) {
            $table->id();
            $table->foreignId('support_plan_id')->constrained('support_plans')->onDelete('cascade');

            $table->boolean('at_risk_of_abuse')->nullable();
            $table->text('abuse_details')->nullable();

            $table->boolean('opan_referral_required')->nullable();
            $table->text('opan_referral_details')->nullable();

            $table->boolean('risk_of_declining_services')->nullable();
            $table->text('declining_services_details')->nullable();

            $table->boolean('neglect_indicators')->nullable();
            $table->text('neglect_indicators_details')->nullable();

            $table->boolean('emergency_accessible')->nullable();
            $table->text('emergency_accessible_details')->nullable();

            $table->boolean('emergency_support_available')->nullable();
            $table->text('emergency_support_details')->nullable();

            $table->boolean('vpr_required')->nullable();
            $table->text('vpr_details')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_plan_emergency_readiness');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use App\Classes\MigrationHelper;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('support_plan_financial_supports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('support_plan_id')->constrained('support_plans')->onDelete('cascade');

            $table->boolean('has_power_of_attorney')->nullable();
            $table->text('power_of_attorney_details')->nullable();

            $table->boolean('has_access_to_money')->nullable();
            $table->text('access_to_money_details')->nullable();

            $table->boolean('at_risk_of_abuse')->nullable();
            $table->text('risk_of_abuse_details')->nullable();

            $table->boolean('needs_support_for_bills')->nullable();
            $table->text('support_for_bills_details')->nullable();

            $table->boolean('not_enough_money')->nullable();
            $table->text('not_enough_money_details')->nullable();

            $table->boolean('support_financial_counsellor')->nullable();
            $table->text('financial_counsellor_details')->nullable();

            $table->boolean('support_government_initiatives')->nullable();
            $table->text('government_initiatives_details')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_plan_financial_supports');
    }
};

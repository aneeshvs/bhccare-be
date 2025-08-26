<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('support_plan_informal_supports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('support_plan_id')->constrained('support_plans')->onDelete('cascade');

            $table->boolean('is_primary_caregiver')->nullable();
            $table->text('primary_caregiver_details')->nullable();

            $table->boolean('receiving_help')->nullable();
            $table->text('receiving_help_details')->nullable();

            $table->boolean('carer_lives_with_you')->nullable();
            $table->text('carer_lives_with_you_details')->nullable();

            $table->boolean('carer_receives_pension')->nullable();
            $table->string('carer_pension_details')->nullable(); // Carers allowance etc.

            $table->boolean('factors_affecting_care')->nullable();
            $table->text('factors_affecting_care_details')->nullable();

            $table->boolean('caregiver_strain_index_required')->nullable();

            $table->boolean('carer_gateway_referral')->nullable();
            $table->text('carer_gateway_referral_details')->nullable();

            $table->boolean('primary_caregiver_receives_allowance')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_plan_informal_supports');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('support_plan_medication_managements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('support_plan_id')->index();
            $table->foreign('support_plan_id')->references('id')->on('support_plans')->onDelete('cascade');

            $table->boolean('takes_regular_medications')->nullable();
            $table->text('medication_details')->nullable();

            $table->string('medication_form')->nullable();
            $table->string('medication_packaging')->nullable();

            $table->boolean('medications_locked')->nullable();
            $table->text('medications_locked_details')->nullable();

            $table->text('specific_storage_requirements')->nullable();

            $table->boolean('scheduled_4_or_8_medications')->nullable();
            $table->text('scheduled_medications_details')->nullable();

            $table->boolean('chemical_restraint_medications')->nullable();

            $table->boolean('takes_more_than_prescribed')->nullable();
            $table->text('takes_more_than_prescribed_details')->nullable();

            $table->boolean('at_risk_of_missing_medication')->nullable();
            $table->text('missing_medication_details')->nullable();

            $table->boolean('able_to_explain_purpose')->nullable();

            $table->date('last_medication_review_date')->nullable();

            $table->text('medication_collection_delivery_details')->nullable();

            $table->boolean('needs_support_with_medication')->nullable();
            $table->text('support_with_medication_details')->nullable();

            $table->boolean('medication_management_worries')->nullable();
            $table->text('medication_management_worries_details')->nullable();

            $table->boolean('medication_service_required')->nullable();
            $table->boolean('support_worker_prompt')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_plan_medication_managements');
    }
};

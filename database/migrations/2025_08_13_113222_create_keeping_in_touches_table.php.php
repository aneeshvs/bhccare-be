<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;
//supportpaln table

return new class extends Migration {
    public function up(): void
    {
        Schema::create('keeping_in_touches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('support_plan_id')->constrained()->onDelete('cascade');

            $table->boolean('need_help_to_communicate')->nullable();
            $table->string('type_of_difficulty')->nullable();
            $table->boolean('contact_first_instance')->nullable();
            $table->text('details')->nullable();
            $table->string('language_spoken')->nullable();
            $table->boolean('use_nrs')->nullable();
            $table->boolean('require_interpreter')->nullable();
            $table->string('written')->nullable();
            $table->string('verbal')->nullable();
            $table->string('schedule_change_notification')->nullable();
            $table->string('interpreter_arrangement')->nullable();
            $table->string('financial_statement_method')->nullable();
            $table->string('feedback_survey_method')->nullable();
            $table->string('marketing_material_method')->nullable();
            $table->string('preferred_communication_method')->nullable();
            $table->boolean('join_cab')->nullable();

           MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('keeping_in_touches');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('support_plan_end_of_life_advanced_care_plannings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('support_plan_id');

             $table->foreign('support_plan_id', 'fk_eol_supportplan')
      ->references('id')->on('support_plans')
      ->onDelete('cascade');

            $table->boolean('receiving_palliative_care')->nullable();
            $table->text('receiving_palliative_care_details')->nullable();

            $table->boolean('support_to_initiate_palliative_care')->nullable();
            $table->text('support_to_initiate_palliative_care_details')->nullable();

            $table->boolean('has_advanced_care_plan')->nullable();
            $table->text('advanced_care_plan_details')->nullable();

            $table->boolean('support_to_complete_advanced_care_plan')->nullable();
            $table->text('support_to_complete_advanced_care_plan_details')->nullable();

            $table->boolean('has_dnr')->nullable();
            $table->text('dnr_details')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_plan_end_of_life_advanced_care_plannings');
    }
};

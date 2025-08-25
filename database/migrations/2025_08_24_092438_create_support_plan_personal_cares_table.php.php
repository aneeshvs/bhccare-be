<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('support_plan_personal_cares', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('support_plan_id')->index();
            $table->foreign('support_plan_id')->references('id')->on('support_plans')->onDelete('cascade');

            $table->boolean('support_daily_personal_care')->nullable();
            $table->text('daily_personal_care_details')->nullable();

            $table->boolean('support_showering')->nullable();
            $table->string('showering_type')->nullable(); // e.g. Supervision, Full Assistance
            $table->text('showering_details')->nullable();

            $table->text('personal_care_routine')->nullable();

            $table->boolean('support_dressing')->nullable();
            $table->text('dressing_details')->nullable();
            $table->text('dressing_routine')->nullable();

            $table->boolean('equipment_in_bathroom')->nullable();
            $table->text('equipment_details')->nullable();

            $table->boolean('support_shaving')->nullable();
            $table->text('shaving_details')->nullable();

            $table->boolean('support_haircuts')->nullable();
            $table->text('haircuts_details')->nullable();

            $table->boolean('task_at_home')->nullable();

            $table->boolean('wears_dentures')->nullable();
            $table->text('dentures_details')->nullable();

            $table->boolean('support_teeth_brushing')->nullable();
            $table->text('teeth_brushing_details')->nullable();

            $table->boolean('ot_bathroom_assessment')->nullable();
            $table->string('ot_assessment_type')->nullable(); // e.g. Supervision
            $table->text('ot_assessment_details')->nullable();

            $table->boolean('referral_ot_required')->nullable();
            $table->text('plancare_referral_ot_details')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_plan_personal_cares');
    }
};

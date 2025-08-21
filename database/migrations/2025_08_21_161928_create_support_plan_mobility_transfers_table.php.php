<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('support_plan_mobility_transfers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('support_plan_id')->index();
            $table->foreign('support_plan_id')->references('id')->on('support_plans')->onDelete('cascade');

            $table->boolean('can_walk_independently')->nullable();
            $table->text('walk_independently_details')->nullable();

            $table->boolean('needs_transfer_support')->nullable();
            $table->string('primary_equipment_used')->nullable();

            $table->boolean('can_climb_stairs')->nullable();
            $table->text('climb_stairs_details')->nullable();

            $table->boolean('has_stairs_at_home')->nullable();
            $table->text('stairs_at_home_details')->nullable();

            $table->boolean('can_transfer_self')->nullable();
            $table->boolean('can_transfer_in_other_envs')->nullable();

            $table->boolean('uses_bed_pole_or_rails')->nullable();
            $table->boolean('bed_pole_prescribed_by_ot')->nullable();

            $table->boolean('can_access_places_outside_walking_distance')->nullable();
            $table->text('access_places_details')->nullable();

            $table->boolean('safe_to_mobilise_in_yard')->nullable();
            $table->text('mobilise_yard_details')->nullable();

            $table->text('community_access')->nullable();
            $table->boolean('drives')->nullable();
            $table->boolean('medications_or_conditions_risk')->nullable();
            $table->text('driving_risk_details')->nullable();

            $table->text('mobility_equipment')->nullable();
            $table->string('equipment_purchase_type')->nullable(); // self-purchase or OT recommended

            $table->boolean('uses_four_wheel_walker')->nullable();
            $table->text('four_wheel_walker_details')->nullable();

            $table->string('wheelchair_type')->nullable(); // manual/electric
            $table->text('wheelchair_operation')->nullable();
            $table->boolean('wheelchair_ot_recommended')->nullable();
            $table->boolean('can_charge_wheelchair')->nullable();
            $table->date('last_wheelchair_service_date')->nullable();

            $table->boolean('can_carry_5kg')->nullable();
            $table->text('carry_5kg_details')->nullable();

            $table->boolean('foot_problems')->nullable();
            $table->text('foot_problems_details')->nullable();

            $table->boolean('mobility_worries')->nullable();
            $table->text('mobility_worries_details')->nullable();

            $table->date('last_ot_assessment_date')->nullable();
            $table->boolean('new_ot_referral_required')->nullable();

            $table->boolean('demmi_assessment_required')->nullable();
            $table->string('demmi_assessment_result')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_plan_mobility_transfers');
    }
};

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

            // ----------------------------------------
            // MOBILITY & TRANSFERS SECTION
            // ----------------------------------------

            // 1. Walk independently
            $table->boolean('can_walk_independently')->nullable();
            $table->text('walk_independently_details')->nullable();

            // 2. Transfer support
            $table->boolean('needs_transfer_support')->nullable();
            $table->string('primary_equipment_used')->nullable();

            // 3. Climb stairs safely
            $table->boolean('can_climb_stairs')->nullable();
            $table->text('climb_stairs_details')->nullable();

            // 4. Stairs at home
            $table->boolean('has_stairs_at_home')->nullable();
            $table->text('stairs_at_home_details')->nullable();

            // 5. Transfer self
            $table->boolean('can_transfer_self')->nullable();
            $table->text('transfer_self_details')->nullable(); // MISSING IN YOUR MIGRATION

            // 6. Transfer in different environments
            $table->boolean('can_transfer_in_other_envs')->nullable();
            $table->text('transfer_other_env_details')->nullable(); // MISSING FIELD

            // 7. Bed Pole / Bed Rails
            $table->boolean('uses_bed_pole_or_rails')->nullable();
            $table->boolean('bed_pole_prescribed_by_ot')->nullable();

            // 8. Access places out of walking distance
            $table->boolean('can_access_places_outside_walking_distance')->nullable();
            $table->text('access_places_details')->nullable();

            // 9. Mobilise in yard
            $table->boolean('safe_to_mobilise_in_yard')->nullable();
            $table->text('mobilise_yard_details')->nullable();

            // 10. Community access
            $table->text('community_access')->nullable();

            // 11. Driving
            $table->boolean('drives')->nullable();

            // 12. Risk due to medications/conditions
            $table->boolean('medications_or_conditions_risk')->nullable();
            $table->text('driving_risk_details')->nullable();

            // 13. Mobility equipment
            $table->text('mobility_equipment')->nullable();
            $table->string('equipment_purchase_type')->nullable(); // self-purchase / OT recommended

            // 14. 4-wheel walker
            $table->boolean('uses_four_wheel_walker')->nullable();
            $table->text('four_wheel_walker_details')->nullable();

            // 15. Wheelchair use
            $table->boolean('wheelchair_type')->nullable(); // manual / electric / none
            $table->text('wheelchair_use_details')->nullable(); // EXTRA missing field
            $table->text('wheelchair_operation')->nullable();
            $table->boolean('wheelchair_ot_recommended')->nullable();
            $table->text('wheelchair_ot')->nullable();
            
            $table->boolean('can_charge_wheelchair')->nullable();
            $table->text('can_charge_details')->nullable();//add new table 
            $table->date('last_wheelchair_service_date')->nullable();

            // 16. Carry items while mobilising
            $table->boolean('can_carry_5kg')->nullable();
            $table->text('carry_5kg_details')->nullable();

            // 17. Foot problems
            $table->boolean('foot_problems')->nullable();
            $table->text('foot_problems_details')->nullable();

            // 18. Mobility worries
            $table->boolean('mobility_worries')->nullable();
            $table->text('mobility_worries_details')->nullable();

            // 19. Last OT assessment
            $table->date('last_ot_assessment_date')->nullable();

            // 20. New OT referral required
            $table->boolean('new_ot_referral_required')->nullable();
            $table->text('new_ot_referral_details')->nullable(); // MISSING FIELD

            // 21. DEMMI Assessment
            $table->boolean('demmi_assessment_required')->nullable();
            $table->string('demmi_assessment_result')->nullable();

            // Default columns
            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_plan_mobility_transfers');
    }
};

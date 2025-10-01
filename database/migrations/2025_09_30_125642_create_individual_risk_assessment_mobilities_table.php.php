<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('assessment_mobilities', function (Blueprint $table) {
            $table->id();

            // Foreign key
            $table->unsignedBigInteger('individual_risk_assessment_id')->nullable();
            $table->foreign('individual_risk_assessment_id')
                  ->references('id')->on('individual_risk_assessments')
                  ->onDelete('cascade');

            // Mobility fields
            $table->boolean('walk_unaided')->default(false);
            $table->boolean('accessibility_required')->default(false);
            $table->text('walk_hazards')->nullable();
            $table->text('walk_management_plan')->nullable();

            $table->boolean('manages_stairs')->default(false);
            $table->text('stairs_hazards')->nullable();
            $table->text('stairs_management_plan')->nullable();

            $table->boolean('uses_walking_aid')->default(false);
            $table->text('walking_aid_hazards')->nullable();
            $table->text('walking_aid_management_plan')->nullable();

            $table->boolean('uses_wheelchair')->default(false);
            $table->text('wheelchair_hazards')->nullable();
            $table->text('wheelchair_management_plan')->nullable();

            // Transfers
            $table->boolean('bed_transfer')->default(false);
            $table->text('bed_transfer_hazards')->nullable();
            $table->text('bed_transfer_management_plan')->nullable();

            $table->boolean('vehicle_transfer')->default(false);
            $table->text('vehicle_transfer_hazards')->nullable();
            $table->text('vehicle_transfer_management_plan')->nullable();

            $table->boolean('toilet_transfer')->default(false);
            $table->text('toilet_transfer_hazards')->nullable();
            $table->text('toilet_transfer_management_plan')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assessment_mobilities');
    }
};

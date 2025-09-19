<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('plan_important_contacts', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('support_care_plan_id');

            $table->string('advocate')->nullable();
            $table->string('childcare_school_contact')->nullable();
            $table->string('power_of_attorney_guardian')->nullable();
            $table->string('workplace_volunteer_contact')->nullable();
            $table->string('landlord_sda_provider')->nullable();
            $table->string('doctor')->nullable();
            $table->string('specialist_practitioner')->nullable();
            $table->string('solicitor')->nullable();
            $table->string('insurer_home_contents')->nullable();
            $table->string('private_health_cover')->nullable();
            $table->string('insurer_vehicle')->nullable();

            $table->foreign('support_care_plan_id')
                ->references('id')->on('support_care_plans')
                ->onDelete('cascade');

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plan_important_contacts');
    }
};

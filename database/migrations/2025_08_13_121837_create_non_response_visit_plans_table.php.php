<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;
//supportpaln table

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('non_response_visit_plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('support_plan_id');

            // Step 1: Telephone
            $table->boolean('telephone_home_or_mobile')->nullable();
            $table->text('telephone_details')->nullable();

            // Step 2: Contact emergency contact
            $table->boolean('contact_emergency_contact')->nullable();
            $table->text('emergency_contact_details')->nullable();

            // Step 3: Access spare key
            $table->boolean('access_spare_key')->nullable();
            $table->boolean('enter_home_with_spare_key')->nullable();
            $table->text('spare_key_details')->nullable();

            // Step 4: Contact other persons
            $table->boolean('contact_other_persons')->nullable();
            $table->text('other_persons_details')->nullable();

            // Step 5: Contact police if no spare key
            $table->boolean('contact_police_if_no_key')->nullable();
            $table->text('police_contact_details')->nullable();

            // Step 6: Access key lock
            $table->boolean('access_key_lock')->nullable();
            $table->string('key_lock_code')->nullable();
            $table->text('key_lock_details')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());

            $table->foreign('support_plan_id')->references('id')->on('support_plans')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('non_response_visit_plans');
    }
};

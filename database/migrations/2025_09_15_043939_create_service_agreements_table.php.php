<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('service_agreements', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('staff_id')->nullable()->index();
            $table->foreign('staff_id')->references('id')->on('staff')->nullOnDelete();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->tinyInteger('client_type')->default(1);

            // ✅ Participant fields
            $table->string('participant_name')->nullable();
            $table->string('ndis_number')->nullable();
            $table->string('address')->nullable();
            $table->string('contact')->nullable();
            $table->string('email')->nullable();
            $table->date('dob')->nullable();
            $table->date('ndis_plan_start_date')->nullable();
            $table->date('ndis_plan_end_date')->nullable();
            $table->date('term_start_date')->nullable();
            $table->date('term_end_date')->nullable();
            $table->string('area_of_support')->nullable();

            // ✅ Representative fields
            $table->string('representative_name')->nullable();
            $table->string('representative_relationship')->nullable();
            $table->string('representative_contact')->nullable();
            $table->string('representative_email')->nullable();

            // ✅ Form status
            $table->string('form_status')->default('in_progress');
            $table->integer('completion_percentage')->default(0);

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_agreements');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('confidential_information_forms', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('staff_id')->nullable()->index();
            $table->foreign('staff_id')->references('id')->on('staff')->nullOnDelete();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->tinyInteger('client_type')->default(1);

            // ✅ Participant details
            $table->string('participant_name')->nullable();
            $table->string('address')->nullable();
            $table->string('post_code', 10)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile_no')->nullable();

            // ✅ Form progress tracking
            $table->string('form_status')->default('in_progress');
            $table->integer('completion_percentage')->default(0);

            // ✅ UUID and timestamps
            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('confidential_information_forms');
    }
};

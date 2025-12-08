<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('schedule_of_supports', function (Blueprint $table) {
            $table->id();

            // Foreign keys
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('staff_id')->nullable();
            $table->unsignedTinyInteger('client_type')->nullable(); // 1 = participant, 2 = representative

            // Schedule of Support fields
            $table->string('participant_name')->nullable();
            $table->date('creation_date')->nullable();
            $table->date('funding_review_date')->nullable();

            $table->boolean('support_on_public_holiday')->default(false);

            $table->boolean('sil_section_flag')->default(0);

            // Tracking
            $table->enum('form_status', ['in_progress', 'completed', 'draft'])->default('in_progress');
            $table->unsignedTinyInteger('completion_percentage')->default(0);

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedule_of_supports');
    }
};

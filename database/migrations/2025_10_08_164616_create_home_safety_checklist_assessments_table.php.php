<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('home_safety_checklist_assessments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('staff_id')->nullable()->index();
            $table->foreign('staff_id')->references('id')->on('staff')->nullOnDelete();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->tinyInteger('client_type')->default(1);

            // ✅ Participant details
            $table->string('participant_name')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();

            // ✅ Yes/No questions
            $table->boolean('is_new_participant')->nullable();
            $table->boolean('is_review_existing')->nullable();
            $table->boolean('does_participant_agree')->nullable();

            // ✅ Entry door options
            $table->enum('entry_door', ['front', 'side', 'rear', 'other'])->nullable();
            $table->string('entry_door_other')->nullable();

            // ✅ Form progress tracking
            $table->string('form_status')->default('in_progress');
            $table->integer('completion_percentage')->default(0);

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_safety_checklist_assessments');
    }
};

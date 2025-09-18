<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('emergency_disaster_plans', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('support_care_plan_id');

            $table->string('participant_name')->nullable();
            $table->date('date')->nullable();
            $table->date('review_date')->nullable();

            $table->foreign('support_care_plan_id')
                ->references('id')->on('support_care_plans')
                ->onDelete('cascade');

            // default metadata (uuid, created_at, updated_at, deleted_at, created_by etc.)
            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('emergency_disaster_plans');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('support_plan_falls_risks', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('support_plan_id')->index();
            $table->foreign('support_plan_id')
                ->references('id')
                ->on('support_plans')
                ->onDelete('cascade');

            $table->boolean('recent_falls')->nullable();
            $table->text('recent_falls_details')->nullable();

            $table->boolean('strategies_to_reduce_risk')->nullable();
            $table->text('strategies_details')->nullable();

            $table->boolean('has_safety_pendant')->nullable();
            $table->text('safety_pendant_details')->nullable();

            $table->boolean('worried_about_falling')->nullable();
            $table->text('worried_details')->nullable();

            $table->boolean('referral_falls_clinic')->nullable();
            $table->text('referral_falls_clinic_details')->nullable();

            $table->boolean('referral_ot')->nullable();
            $table->text('referral_ot_details')->nullable();

            $table->boolean('referral_physio')->nullable();
            $table->text('referral_physio_details')->nullable();

            // 🔥 Add standard helper-based columns (uuid, created_at, updated_at, deleted_at, staff_id, etc.)
            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_plan_falls_risks');
    }
};

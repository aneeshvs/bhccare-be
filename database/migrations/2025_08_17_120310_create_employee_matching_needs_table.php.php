<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('employee_matching_needs', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('support_plan_id')->index();
            $table->foreign('support_plan_id')
                ->references('id')->on('support_plans')
                ->onDelete('cascade');

            $table->text('cultural_considerations')->nullable();
            $table->text('specific_training_required')->nullable();
            $table->text('common_interests')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_matching_needs');
    }
};

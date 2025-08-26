<?php

use Illuminate\Database\Migrations\Migration;
use App\Classes\MigrationHelper;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('support_plan_pain_managements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('support_plan_id')->constrained('support_plans')->onDelete('cascade');

            $table->boolean('ongoing_pain')->nullable();
            $table->text('pain_details')->nullable();

            $table->string('pain_location')->nullable();
            $table->string('pain_frequency')->nullable();
            $table->unsignedTinyInteger('pain_scale')->nullable(); // 1 to 10

            $table->boolean('supported_for_pain')->nullable();
            $table->text('supported_pain_details')->nullable();

            $table->text('pain_management_strategies')->nullable();

            $table->boolean('abbey_pain_scale_required')->nullable();

            $table->boolean('pain_worry')->nullable();
            $table->text('pain_worry_details')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_plan_pain_managements');
    }
};

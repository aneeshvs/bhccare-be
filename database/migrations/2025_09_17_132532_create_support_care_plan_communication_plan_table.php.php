<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('communication_plans', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('support_care_plan_id');

            // Sections
            $table->json('helps_me_talk')->nullable();           // Interpreter, symbols, etc.
            $table->json('helps_me_understand')->nullable();     // short sentences, examples, etc.
            $table->json('please_communicate_by')->nullable();   // speaking directly, notes, etc.
            $table->text('emergency_communication')->nullable();

            $table->foreign('support_care_plan_id')
                ->references('id')->on('support_care_plans')
                ->onDelete('cascade');

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_care_plan_communication_plans');
    }
};

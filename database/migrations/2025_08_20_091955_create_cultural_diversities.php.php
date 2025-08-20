<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cultural_diversities', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('support_plan_id')->index();
            $table->foreign('support_plan_id')
                  ->references('id')
                  ->on('support_plans')
                  ->onDelete('cascade');

            $table->boolean('is_lgbti')->nullable(); // Lesbian, gay, bisexual, transgender, intersex
            $table->text('lgbti_details')->nullable();

            $table->boolean('is_separated_family')->nullable(); // Forced adoption / removal
            $table->text('separated_family_details')->nullable();

            $table->boolean('has_cultural_events')->nullable();
            $table->text('cultural_events_details')->nullable();

            $table->boolean('has_past_events')->nullable();
            $table->text('past_events_details')->nullable();

            $table->boolean('has_non_disclosure_items')->nullable();
            $table->text('non_disclosure_details')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cultural_diversities');
    }
};

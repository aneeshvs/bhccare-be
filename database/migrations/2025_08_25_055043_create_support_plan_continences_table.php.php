<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('support_plan_continences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('support_plan_id')->constrained('support_plans')->onDelete('cascade');

            $table->boolean('identified_needs')->nullable();
            $table->text('identified_needs_details')->nullable();

            $table->boolean('identify_toilet_needs')->nullable();
            $table->text('identify_toilet_needs_details')->nullable();

            $table->boolean('require_prompting')->nullable();
            $table->text('require_prompting_details')->nullable();

            $table->boolean('wears_continence_aids')->nullable();
            $table->text('continence_aids_details')->nullable();

            $table->boolean('ruis_required')->nullable();
            $table->text('ruis_details')->nullable();

            $table->boolean('rfis_required')->nullable();
            $table->text('rfis_details')->nullable();

            $table->boolean('funding_for_products')->nullable();
            $table->text('funding_for_products_details')->nullable();

            $table->boolean('nurse_assessment')->nullable();
            $table->text('nurse_assessment_details')->nullable();

            $table->boolean('worry_about_continence')->nullable();
            $table->text('worry_about_continence_details')->nullable();

             MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_plan_continences');
    }
};

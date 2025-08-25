<?php

use Illuminate\Database\Migrations\Migration;
use App\Classes\MigrationHelper;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('support_plan_dietaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('support_plan_id')->constrained('support_plans')->onDelete('cascade');

            $table->boolean('intolerances')->nullable();
            $table->text('intolerances_details')->nullable();

            $table->boolean('dysphagia_concerns')->nullable();
            $table->text('dysphagia_details')->nullable();

            $table->boolean('speech_pathologist_recommendations')->nullable();

            $table->string('iddsi_food_category')->nullable();   // IDDSI food categories
            $table->string('iddsi_liquid_category')->nullable(); // IDDSI liquid categories

            $table->boolean('prepares_meals')->nullable();
            $table->text('prepares_meals_details')->nullable();

            $table->boolean('needs_meal_support')->nullable();
            $table->text('meal_support_details')->nullable();

            $table->boolean('diet_meets_needs')->nullable();
            $table->text('diet_meets_needs_details')->nullable();

            $table->boolean('needs_cutting_support')->nullable();
            $table->text('cutting_support_details')->nullable();

            $table->boolean('needs_feeding_support')->nullable();
            $table->text('feeding_support_details')->nullable();

            $table->boolean('dietician_referral_required')->nullable();
            $table->text('dietician_referral_details')->nullable();

            $table->boolean('needs_shopping_support')->nullable();
            $table->text('shopping_support_details')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_plan_dietaries');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use App\Classes\MigrationHelper;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('support_plan_social_connections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('support_plan_id')->constrained('support_plans')->onDelete('cascade');

            $table->boolean('feels_lonely')->nullable();
            $table->text('feels_lonely_details')->nullable();

            $table->boolean('has_informal_supports')->nullable();
            $table->text('informal_supports_details')->nullable();

            $table->boolean('wants_more_community_engagement')->nullable();
            $table->text('community_engagement_details')->nullable();

            $table->boolean('wants_support_for_community_engagement')->nullable();
            $table->text('support_for_community_engagement_details')->nullable();

            $table->boolean('needs_community_access_support')->nullable();
            $table->text('community_access_support_details')->nullable();

            $table->boolean('has_taxi_card')->nullable();
            $table->text('taxi_card_details')->nullable();

            $table->boolean('interested_in_visitors_program')->nullable();
            $table->text('visitors_program_details')->nullable();

            $table->boolean('has_hobbies_activities')->nullable();
            $table->text('hobbies_activities_details')->nullable();

            $table->boolean('needs_duke_index')->nullable();
            $table->text('duke_index_details')->nullable();

            $table->boolean('needs_feeding_support')->nullable();
            $table->text('feeding_support_details')->nullable();

            $table->boolean('wants_dietician_referral')->nullable();
            $table->text('dietician_referral_details')->nullable();

            $table->boolean('needs_shopping_support')->nullable();
            $table->text('shopping_support_details')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_plan_social_connections');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('support_plan_living_arrangements', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('support_plan_id')->index();
            $table->foreign('support_plan_id')->references('id')->on('support_plans')->onDelete('cascade');

            $table->string('reside_in')->nullable(); // I reside in
            $table->string('reside_with')->nullable(); // I reside with
            $table->date('home_safety_assessment_date')->nullable();
            $table->boolean('is_home_suitable')->nullable(); // Yes/No
            $table->text('home_suitable_details')->nullable();
            $table->boolean('at_risk_of_homelessness')->nullable();
            $table->text('homelessness_details')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_plan_living_arrangements');
    }
};

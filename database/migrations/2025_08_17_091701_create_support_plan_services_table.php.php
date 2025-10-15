<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('support_plan_services', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('support_plan_id')->index();
            $table->foreign('support_plan_id')->references('id')->on('support_plans')->onDelete('cascade');

             $table->string('goal_key')->nullable();

            $table->string('name')->nullable();
            $table->string('service_provided')->nullable();
            $table->string('funded_by')->nullable();
            $table->string('duration_frequency')->nullable();
            $table->boolean('support_to_implement_by_us')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_plan_services');
    }
};

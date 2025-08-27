<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('support_plan_telecommunication_outages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('support_plan_id')
                ->constrained('support_plans')
                ->onDelete('cascade');

            $table->boolean('independent_leave_home')->nullable();
            $table->text('independent_leave_home_details')->nullable();

            $table->boolean('has_support_checkin')->nullable();
            $table->text('has_support_checkin_details')->nullable();

            $table->boolean('welfare_check_required')->nullable();
            $table->text('welfare_check_required_details')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_plan_telecommunication_outages');
    }
};

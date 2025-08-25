<?php

use Illuminate\Database\Migrations\Migration;
use App\Classes\MigrationHelper;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('support_plan_hearings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('support_plan_id')->constrained('support_plans')->onDelete('cascade');

            $table->boolean('wears_hearing_devices')->nullable();
            $table->text('hearing_devices_details')->nullable();
            $table->string('when_worn')->nullable();
            $table->date('last_audiologist_appointment')->nullable();

            $table->boolean('hearing_worry')->nullable();
            $table->text('hearing_worry_details')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_plan_hearings');
    }
};

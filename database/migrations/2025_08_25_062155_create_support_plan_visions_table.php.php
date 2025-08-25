<?php

use Illuminate\Database\Migrations\Migration;
use App\Classes\MigrationHelper;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('support_plan_visions', function (Blueprint $table) {

            $table->id();
            $table->foreignId('support_plan_id')->constrained('support_plans')->onDelete('cascade');

            $table->boolean('wears_glasses_or_contacts')->nullable();
            $table->string('glasses_or_contacts_type')->nullable(); // Glasses / Contact lenses
            $table->string('when_worn')->nullable();
            $table->date('last_optometrist_appointment')->nullable();

            $table->boolean('vision_worry')->nullable();
            $table->text('vision_worry_details')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_plan_visions');
    }
};

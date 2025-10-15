<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('support_plan_my_goals', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('support_plan_id')->index();
            $table->foreign('support_plan_id')
                ->references('id')
                ->on('support_plans')
                ->onDelete('cascade');

            $table->string('goal_key')->nullable(); // ✅ NEW
            $table->text('goal')->nullable();
            $table->text('measure_progress')->nullable();
            $table->text('success_look_like')->nullable();
            $table->text('who_will_support')->nullable();
            $table->text('participant_support')->nullable();
            $table->text('target_date')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_plan_my_goals');
    }
};

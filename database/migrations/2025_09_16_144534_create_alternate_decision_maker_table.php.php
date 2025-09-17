<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('alternate_decision_makers', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('support_care_plan_id');
            $table->enum('type', [
                'not_applicable', 'partner', 'carer', 'guardian', 'parent', 'advocacy', 'other'
            ])->default('not_applicable');

            $table->string('first_name')->nullable();
            $table->string('surname')->nullable();
            $table->text('notes')->nullable();

            $table->foreign('support_care_plan_id')
                ->references('id')->on('support_care_plans')
                ->onDelete('cascade');

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alternate_decision_makers');
    }
};

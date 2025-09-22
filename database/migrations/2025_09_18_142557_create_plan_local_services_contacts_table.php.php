<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('plan_local_services_contacts', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('support_care_plan_id');

            $table->string('council')->nullable();
            $table->string('hospital')->nullable();
            $table->string('electricity')->nullable();
            $table->string('water')->nullable();

            $table->foreign('support_care_plan_id')
                ->references('id')->on('support_care_plans')
                ->onDelete('cascade');

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plan_local_services_contacts');
    }
};

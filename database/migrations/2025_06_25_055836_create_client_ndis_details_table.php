<?php
// database/migrations/xxxx_xx_xx_create_client_ndis_details_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up()
    {
        Schema::create('client_ndis_details', function (Blueprint $table) {
            $table->id();

            $table->enum('ndis_plan_approved', ['Yes', 'No', 'Pending'])->nullable();
            $table->string('ndis_number')->nullable();
            $table->date('ndis_plan_start_date')->nullable();
            $table->date('ndis_plan_end_date')->nullable();

            $table->string('plan_manager_name')->nullable();
            $table->string('plan_manager_contact')->nullable();

            $table->enum('plan_type', ['Plan Managed', 'Agency Managed', 'Self-Managed'])->nullable();
            $table->enum('copy_of_plan_provided', ['Yes', 'No'])->nullable();
            $table->text('reason_plan_not_provided')->nullable();

            $table->enum('engagement_concerns', ['Yes', 'No', 'Not Sure'])->nullable();
            $table->text('engagement_concerns_description')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down()
    {
        Schema::dropIfExists('client_ndis_details');
    }
};

<?php
// database/migrations/xxxx_xx_xx_create_previous_service_providers_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up()
    {
        Schema::create('previous_service_providers', function (Blueprint $table) {
            $table->id();

            $table->string('provider')->nullable();
            $table->string('contact_details')->nullable();
            $table->string('length_of_support')->nullable();
            $table->text('reason_for_leaving')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down()
    {
        Schema::dropIfExists('previous_service_providers');
    }
};

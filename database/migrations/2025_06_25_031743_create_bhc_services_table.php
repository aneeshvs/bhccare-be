<?php
// database/migrations/xxxx_xx_xx_create_bhc_services_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up()
    {
        Schema::create('bhc_services', function (Blueprint $table) {
            $table->id();
            $table->string('service_name')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down()
    {
        Schema::dropIfExists('bhc_services');
    }
};

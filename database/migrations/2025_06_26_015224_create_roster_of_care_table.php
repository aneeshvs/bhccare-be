<?php
// database/migrations/xxxx_xx_xx_create_roster_of_care_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('roster_of_care', function (Blueprint $table) {
            $table->id();

            $table->enum('need_bhc_community_support', ['Yes', 'No'])->nullable();
            $table->text('comments')->nullable();
            $table->decimal('transport_funding', 10, 2)->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('roster_of_care');
    }
};

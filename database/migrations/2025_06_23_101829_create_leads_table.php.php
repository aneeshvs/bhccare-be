<?php
//database/migrations/xxxx_xx_xx_create_leads_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();

            $table->string('full_name');
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->enum('form_status', ['in_progress', 'completed'])->default('in_progress');
            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags()); // likely adds uuid, timestamps, soft deletes
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};

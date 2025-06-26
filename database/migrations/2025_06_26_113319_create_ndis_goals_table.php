<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ndis_goals', function (Blueprint $table) {
            $table->id();

            $table->foreignId('client_id')->constrained()->onDelete('cascade');

            $table->string('goal')->nullable();
            $table->text('barriers')->nullable();
            $table->text('solutions')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ndis_goals');
    }
};

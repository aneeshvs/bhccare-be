<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('unfunded_supports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('schedule_of_support_id');

            // Unfunded Support fields
            $table->string('support_name')->nullable();
            $table->text('description')->nullable();
            $table->string('price_information')->nullable();
            $table->text('delivery_details')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('grand_total', 10, 2)->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());

            // Relation
            $table->foreign('schedule_of_support_id')
                ->references('id')
                ->on('schedule_of_supports')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('unfunded_supports');
    }
};

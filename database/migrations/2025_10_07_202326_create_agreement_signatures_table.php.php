<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('agreement_signatures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('schedule_of_support_id');

            // Binary signatures
            $table->binary('participant_signature')->nullable();
            $table->string('agreement_participant_name')->nullable();
            $table->date('participant_date')->nullable();

            $table->binary('representative_signature')->nullable();
            $table->string('representative_name')->nullable();
            $table->date('representative_date')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());


            $table->foreign('schedule_of_support_id')
                  ->references('id')
                  ->on('schedule_of_supports')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agreement_signatures');
    }
};

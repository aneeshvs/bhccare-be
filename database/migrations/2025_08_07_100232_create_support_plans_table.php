<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

// this is the primary table for supportplan form
return new class extends Migration {
    public function up(): void
    {
        Schema::create('support_plans', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('staff_id')->nullable()->index(); // New field
            $table->foreign('staff_id')->references('id')->on('staff')->nullOnDelete();


           $table->unsignedBigInteger('user_id')->nullable();
           $table->tinyInteger('client_type')->default(1);

            $table->date('effective_date')->nullable();
            $table->date('review_date')->nullable();
            $table->date('confirmation_date')->nullable();
            $table->text('developed_by')->nullable();
            $table->text('invited_but_not_participated')->nullable();
            $table->string('form_status')->default('in_progress');
            $table->integer('completion_percentage')->default(0)->after('uuid');

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_plans');
    }
};

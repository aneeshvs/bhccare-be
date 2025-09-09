<?php
// database/migrations/xxxx_xx_xx_create_clients_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;
class CreateClientsTable extends Migration
{
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();

             $table->string('prospect_uuid', 36)->nullable();

            // Client Info
            $table->string('full_name');
            $table->date('date_of_birth');
            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->text('residential_address');
            // $table->enum('contact_type',['Home_phone','Work_phone'])->nullable();
            $table->string('home_phone')->nullable();
            $table->string('work_phone')->nullable();
            $table->string('mobile');
            $table->string('email')->nullable();
            $table->string('password');
            $table->enum('atsi_status', ['Aboriginal', 'Torres Strait Islander', 'Neither', 'Both']);
            $table->string('cultural_background')->nullable();
            $table->string('language_spoken')->nullable();
            $table->boolean('interpreter_required')->default(false);
            $table->enum('form_status', ['in_progress', 'completed', 'failed'])->default('in_progress');


            // Guardian Info
            $table->string('guardian_name')->nullable();
            $table->enum('is_public_guardian', ['Public Guardian', 'Temporary Guardian','No'])->nullable();
            $table->string('guardian_relationship')->nullable();
            $table->string('guardian_mobile')->nullable();
            $table->string('guardian_email')->nullable();
            $table->text('guardian_address')->nullable();
            $table->string('guardian_contact_method')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());

        });
    }

    public function down()
    {
        Schema::dropIfExists('clients');
    }
}

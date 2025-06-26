<?php
// database/migrations/xxxx_xx_xx_create_referrals_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;
class CreateReferralsTable extends Migration
{
    public function up()
    {
        Schema::create('referrals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->string('agency')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('job_title')->nullable();
            $table->string('work_contact')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->boolean('has_consent')->nullable(); // true = Yes, false = No
            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());

        });
    }

    public function down()
    {
        Schema::dropIfExists('referrals');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
        public function up(): void
        {
        Schema::create('initial_enquiries', function (Blueprint $table) {
        $table->id();
        $table->string('full_name')->nullable();
        $table->string('preferred_name')->nullable();
        $table->enum('gender', ['male', 'female', 'other'])->nullable();
        $table->date('date_of_birth')->nullable();
        $table->string('address')->nullable();
        $table->string('postcode')->nullable();
        $table->string('phone_number')->nullable();
        $table->string('mobile_number')->nullable();
        $table->string('email')->nullable();
        $table->boolean('need_support_person')->default(false);
        $table->text('support_person_details')->nullable();
        MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('initial_enquiries');
    }
};

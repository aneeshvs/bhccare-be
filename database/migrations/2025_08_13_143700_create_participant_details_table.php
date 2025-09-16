<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;
//supportpaln table

return new class extends Migration {
    public function up(): void
    {
        Schema::create('participant_details', function (Blueprint $table) {
            $table->id();

             $table->unsignedBigInteger('support_plan_id')->index();
            $table->foreign('support_plan_id')->references('id')->on('support_plans')->onDelete('cascade');

            $table->string('first_name')->nullable();
            $table->string('surname')->nullable();
            $table->string('preferred_name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('country_of_birth')->nullable();
            $table->boolean('identify_as_aboriginal_or_torres_strait')->default(false);
            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable();
            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('participant_details');
    }
};

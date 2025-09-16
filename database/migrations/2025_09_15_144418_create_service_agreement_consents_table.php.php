<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('service_agreement_consents', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('service_agreement_id');
            $table->foreign('service_agreement_id')
                  ->references('id')->on('service_agreements')
                  ->cascadeOnDelete();

            // Agreement accepted (on behalf of Best of Homecare)
            $table->string('accepted_name')->nullable();
            $table->string('accepted_position')->nullable();
            $table->string('accepted_signature')->nullable();
            $table->date('accepted_date')->nullable();

            // Written participant consent
            $table->string('consents_participant_name')->nullable();
            $table->enum('participant_role', ['participant', 'representative'])->nullable();
            $table->string('participant_signature')->nullable();
            $table->date('participant_date')->nullable();

            // Witness
            $table->string('witness_name')->nullable();
            $table->string('witness_signature')->nullable();
            $table->date('witness_date')->nullable();

            // Verbal participant consent
            $table->string('verbal_staff_name')->nullable();
            $table->string('verbal_staff_signature')->nullable();
            $table->string('verbal_staff_position')->nullable();
            $table->date('verbal_date')->nullable();
            $table->text('other_notes')->nullable();

            // Office use only
            $table->enum('received_signed_copy', ['yes', 'no'])->nullable();
            $table->enum('agreed_verbally', ['yes', 'no'])->nullable();
            $table->enum('cms_comments_entered', ['yes', 'no'])->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_agreement_consents');
    }
};

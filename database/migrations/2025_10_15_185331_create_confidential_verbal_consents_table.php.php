<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('verbal_consents', function (Blueprint $table) {
            $table->id();

            $table->foreignId('confidential_information_form_id')
                  ->constrained()
                  ->onDelete('cascade');

            // 🖋️ Verbal Consent fields
            $table->binary('verbal_signature')->nullable(); // for signature (image or base64)
            $table->date('verbal_signed_date')->nullable(); // date field
            $table->string('verbal_name')->nullable(); // name of person providing consent
            $table->string('position')->nullable(); // position of staff obtaining consent

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('confidential_verbal_consents');
    }
};

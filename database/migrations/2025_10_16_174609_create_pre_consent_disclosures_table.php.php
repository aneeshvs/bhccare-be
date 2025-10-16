<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pre_consent_disclosures', function (Blueprint $table) {
            $table->id();

            $table->foreignId('confidential_information_form_id')
                  ->constrained()
                  ->onDelete('cascade');

            // ✅ Checklist fields (tick = true/false)
            $table->boolean('discuss_referral_services')->nullable(); // Discuss referral to other services
            $table->boolean('explain_release_agreement')->nullable(); // Explain release with consent
            $table->boolean('explain_share_without_consent')->nullable(); // Explain share without consent
            $table->boolean('provide_privacy_information')->nullable(); // Provide privacy info if requested

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pre_consent_disclosures');
    }
};

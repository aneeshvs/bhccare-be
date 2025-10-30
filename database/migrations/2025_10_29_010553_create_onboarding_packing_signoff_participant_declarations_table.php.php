<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('participant_declarations', function (Blueprint $table) {
            $table->id();

            // 🔗 Relationship to parent
            $table->unsignedBigInteger('onboarding_packing_signoff_id')->nullable()->index();
            $table->foreign('onboarding_packing_signoff_id')
                ->references('id')
                ->on('onboarding_packing_signoffs')
                ->cascadeOnDelete();

            // ✅ Participant details
            $table->string('participant_name')->nullable();
            $table->string('relationship_to_participant')->nullable();

            // 🖊 Signature as binary (for image blobs or base64 storage)
            $table->binary('participant_signature')->nullable();

            // 📅 Date of signing
            $table->date('signed_date')->nullable();

            // ✅ Audit columns
            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('onboarding_packing_signoff_participant_declarations');
    }
};

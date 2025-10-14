<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('confidential_consents', function (Blueprint $table) {
            $table->id();

            $table->foreignId('confidential_information_form_id')
                  ->constrained()
                  ->onDelete('cascade');

            // 🔐 Binary column to store raw signature data (e.g., image or base64-encoded)
            $table->binary('signature')->nullable();

            $table->date('signed_date')->nullable();
            $table->enum('signed_by', ['participant', 'authorized_rep'])->nullable();
            $table->string('name')->nullable();
            $table->string('witnessed_by')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('confidential_information_consents');
    }
};

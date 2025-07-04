<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('final_declarations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');

            // Emails
            $table->string('primary_email')->nullable();
            $table->string('secondary_email')->nullable();

            // Referrer declaration
            $table->date('referrer_date')->nullable();
            $table->string('referrer_name')->nullable();
            $table->binary('referrer_signature')->nullable();
            $table->string('referrer_organisation')->nullable();

            // Client declaration
            $table->date('client_date')->nullable();
            $table->string('client_name')->nullable();
            $table->binary('client_signature')->nullable();

            // Guardian declaration
            $table->date('guardian_date')->nullable();
            $table->string('guardian_name')->nullable();
            $table->binary('guardian_signature')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('final_declarations');
    }
};

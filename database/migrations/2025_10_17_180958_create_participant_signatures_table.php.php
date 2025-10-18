<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('participant_signatures', function (Blueprint $table) {
            $table->id();

            // 🔗 Related user/staff info
            $table->unsignedBigInteger('staff_id')->nullable()->index();
            $table->foreign('staff_id')->references('id')->on('staff')->nullOnDelete();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->tinyInteger('client_type')->default(1);

            // ✍️ Signature + date
            $table->binary('participant_signature')->nullable(); // stored as binary (BLOB)
            $table->date('date_signed')->nullable();

            // 🧩 Common fields
            $table->string('form_status')->default('in_progress');
            $table->integer('completion_percentage')->default(0);
            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('participant_signatures');
    }
};

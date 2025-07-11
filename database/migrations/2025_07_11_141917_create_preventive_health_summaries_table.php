<?php

// database/migrations/xxxx_xx_xx_create_preventive_health_summaries_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void {
        Schema::create('preventive_health_summaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('initial_enquiry_id');

            $table->foreign('initial_enquiry_id')
                ->references('id')
                ->on('initial_enquiries')
                ->onDelete('cascade');

            $table->text('medical_checkup_status')->nullable();
            $table->date('last_dental_check')->nullable();
            $table->date('last_hearing_check')->nullable();
            $table->date('last_vision_check')->nullable();
            $table->boolean('requires_vaccination_assistance')->default(false);

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void {
        Schema::dropIfExists('preventive_health_summaries');
    }
};

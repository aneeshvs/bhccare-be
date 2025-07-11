<?php

// database/migrations/xxxx_xx_xx_create_healthcare_support_details_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void {
        Schema::create('healthcare_support_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('initial_enquiry_id');

            $table->foreign('initial_enquiry_id')
                ->references('id')
                ->on('initial_enquiries')
                ->onDelete('cascade');

            $table->string('medicare')->nullable();
            $table->string('health_fund')->nullable();
            $table->string('pension_card_number')->nullable();
            $table->string('health_care_card')->nullable();
            $table->string('dva_type')->nullable();
            $table->string('dva_number')->nullable();
            $table->string('companion_card')->nullable();
            $table->string('preferred_hospital')->nullable();
            $table->string('ambulance_number')->nullable();
            $table->string('disabled_parking')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void {
        Schema::dropIfExists('healthcare_support_details');
    }
};

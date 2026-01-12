<?php

// database/migrations/xxxx_xx_xx_create_health_information_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void {
        Schema::create('health_information', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('initial_enquiry_id');
            $table->json('health_conditions')->nullable(); 
            $table->string('health_other_description', 500)->nullable();
// stores selected values as JSON

            $table->foreign('initial_enquiry_id')
                ->references('id')
                ->on('initial_enquiries')
                ->onDelete('cascade');

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void {
        Schema::dropIfExists('health_information');
    }
};

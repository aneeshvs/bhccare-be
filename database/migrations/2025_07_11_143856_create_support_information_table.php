<?php

// database/migrations/xxxx_xx_xx_create_support_information_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void {
        Schema::create('support_information', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('initial_enquiry_id');

            $table->foreign('initial_enquiry_id')
                ->references('id')
                ->on('initial_enquiries')
                ->onDelete('cascade');

            $table->boolean('communication_assistance_required')->default(false);
            $table->text('mealtime_plan')->nullable();
            $table->text('likes')->nullable();
            $table->text('dislikes')->nullable();
            $table->text('interests')->nullable();
            $table->enum('preferred_worker_gender', ['Male', 'Female', 'No Preference'])->nullable();
            $table->text('special_request')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void {
        Schema::dropIfExists('support_information');
    }
};

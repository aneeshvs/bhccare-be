<?php

// database/migrations/xxxx_xx_xx_create_behaviour_supports_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void {
        Schema::create('behaviour_supports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('initial_enquiry_id');

            $table->foreign('initial_enquiry_id')
                ->references('id')
                ->on('initial_enquiries')
                ->onDelete('cascade');

            $table->boolean('has_support_plan')->default(false);
            $table->boolean('plan_copy_received')->default(false);

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void {
        Schema::dropIfExists('behaviour_supports');
    }
};

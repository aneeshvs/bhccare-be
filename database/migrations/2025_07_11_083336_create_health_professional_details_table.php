// database/migrations/xxxx_xx_xx_create_health_professional_details_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void {
        Schema::create('health_professional_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('initial_enquiry_id');

            $table->foreign('initial_enquiry_id')
                ->references('id')
                ->on('initial_enquiries')
                ->onDelete('cascade');

            $table->string('role')->nullable(); // e.g., Physiotherapist, Speech Therapist
            $table->string('name')->nullable();
            $table->string('contact_number')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void {
        Schema::dropIfExists('health_professional_details');
    }
};

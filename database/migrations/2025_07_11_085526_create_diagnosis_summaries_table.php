// database/migrations/xxxx_xx_xx_create_diagnosis_summaries_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void {
        Schema::create('diagnosis_summaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('initial_enquiry_id');

            $table->foreign('initial_enquiry_id')
                ->references('id')
                ->on('initial_enquiries')
                ->onDelete('cascade');

            $table->string('primary_diagnosis')->nullable();
            $table->string('secondary_diagnosis')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void {
        Schema::dropIfExists('diagnosis_summaries');
    }
};

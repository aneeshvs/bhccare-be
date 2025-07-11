<?php

// database/migrations/xxxx_xx_xx_create_medical_alerts_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void {
        Schema::create('medical_alerts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('initial_enquiry_id');

            $table->foreign('initial_enquiry_id')
                ->references('id')
                ->on('initial_enquiries')
                ->onDelete('cascade');

            $table->boolean('has_epilepsy')->default(false);
            $table->boolean('has_asthma')->default(false);
            $table->boolean('has_diabetes')->default(false);

            $table->string('allergies')->nullable();
            $table->text('medical_info')->nullable();
            $table->text('diagnosis')->nullable();
            $table->text('other_description')->nullable();

            $table->text('medication_taken')->nullable();
            $table->text('medication_purpose')->nullable();

            $table->boolean('staff_administer_medication')->default(false);
            $table->enum('medication_administered_by', ['Self-Administered', 'Guardian', 'Support Worker'])->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void {
        Schema::dropIfExists('medical_alerts');
    }
};

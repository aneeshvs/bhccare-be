<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void {
        Schema::create('funding_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('initial_enquiry_id');

            $table->foreign('initial_enquiry_id')
                ->references('id')
                ->on('initial_enquiries')
                ->onDelete('cascade');
            $table->enum('type_of_funding', ['Self-Managed', 'NDIA', 'Plan Managed'])->nullable();
            $table->string('funding_contact_person')->nullable();
            $table->boolean('ndis_plan_attached')->default(false);
            $table->date('ndis_plan_start_date')->nullable();
            $table->date('ndis_plan_end_date')->nullable();
            $table->string('plan_manager_name')->nullable();
            $table->string('plan_manager_email')->nullable();
            $table->string('plan_manager_phone')->nullable();
            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void {
        Schema::dropIfExists('funding_details');
    }
};

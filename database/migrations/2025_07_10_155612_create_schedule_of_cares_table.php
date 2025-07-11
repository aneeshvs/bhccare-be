<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void {
        Schema::create('schedule_of_cares', function (Blueprint $table) {
            $table->id();
            $table->foreignId('initial_enquiry_id')->constrained('initial_enquiries')->onDelete('cascade');

            $table->string('type_of_service')->nullable();
            $table->text('primary_task_list')->nullable();
            $table->text('secondary_task_list')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void {
        Schema::dropIfExists('schedule_of_cares');
    }
};

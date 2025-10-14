<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('confidential_agencies', function (Blueprint $table) {
            $table->id();

            $table->foreignId('confidential_information_form_id')
                  ->constrained('confidential_information_forms')
                  ->onDelete('cascade');

            $table->string('goal_key')->nullable()->unique();

            $table->string('name')->nullable();
            $table->string('role')->nullable();
            $table->string('contact')->nullable();
            $table->string('agency_name')->nullable();
            $table->string('service_type')->nullable();
            $table->text('information_shared')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('confidential_information_agencies');
    }
};

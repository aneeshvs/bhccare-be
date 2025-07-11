<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void {
        Schema::create('cultural_backgrounds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('initial_enquiry_id')->constrained('initial_enquiries')->onDelete('cascade');

            $table->boolean('has_children_under_18')->default(false);

            $table->string('country_of_birth')->nullable();
            $table->string('preferred_language')->nullable();
            $table->string('religion')->nullable();
            $table->string('other_languages')->nullable();
            $table->text('cultural_needs')->nullable();
            $table->boolean('interpreter_required')->default(false);
            $table->boolean('auslan_required')->default(false);

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void {
        Schema::dropIfExists('cultural_backgrounds');
    }
};

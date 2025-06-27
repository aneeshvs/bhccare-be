<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('independent_living_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');

            $table->decimal('rent_per_week', 8, 2)->nullable();
            $table->decimal('utilities_per_week', 8, 2)->nullable();
            $table->boolean('needs_furnished')->default(false);
            $table->boolean('owns_furniture')->default(false);
            $table->string('lease_duration')->nullable();
            $table->boolean('can_pay_bond_upfront')->default(false);
            $table->string('preferred_location')->nullable();
            $table->enum('living_preference', ['On Your Own', 'Share'])->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('independent_living_options');
    }
};

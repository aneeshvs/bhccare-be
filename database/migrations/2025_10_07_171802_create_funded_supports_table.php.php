<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('funded_supports', function (Blueprint $table) {
            $table->id();

            // Foreign key to ScheduleOfSupport
            $table->unsignedBigInteger('schedule_of_support_id');
            $table->foreign('schedule_of_support_id')
                  ->references('id')->on('schedule_of_supports')
                  ->onDelete('cascade');

            // Funded support fields
            $table->string('support_name')->nullable(); // Name of support/item number
            $table->text('description')->nullable(); // Scope and volume
            $table->decimal('price', 10, 2)->nullable(); // Price
            $table->string('payment_information')->nullable(); // NDIA, self-managed, plan managed
            $table->text('invoicing_details')->nullable(); // Org name, email, address
            $table->text('delivery_details')->nullable();
            $table->decimal('grand_total', 10, 2)->nullable();// How, when, where, who provides

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('funded_supports');
    }
};

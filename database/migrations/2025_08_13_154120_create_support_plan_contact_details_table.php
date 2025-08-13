<?php
// database/migrations/xxxx_xx_xx_create_contact_details_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;
return new class extends Migration {
    public function up(): void
    {
        Schema::create('support_plan_contact_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('support_plan_id')->index();
            $table->foreign('support_plan_id')
                ->references('id')
                ->on('support_plans')
                ->onDelete('cascade');

            $table->string('phone', 20)->nullable();
            $table->string('address')->nullable();
            $table->boolean('is_rural_area')->nullable(); // 1 = Yes, 0 = No
            $table->string('mailing_address')->nullable();
            $table->string('email')->nullable();

           MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_plan_contact_details');
    }
};


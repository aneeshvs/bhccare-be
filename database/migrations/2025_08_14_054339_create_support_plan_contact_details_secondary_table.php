<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('support_plan_contact_details_secondary', function (Blueprint $table) {
            $table->id();

            // Foreign key to support plans
            $table->unsignedBigInteger('support_plan_id')->index();
            $table->foreign('support_plan_id')
                ->references('id')
                ->on('support_plans')
                ->onDelete('cascade');

            // All fields with secondary_ prefix
            $table->string('secondary_role')->nullable();
            $table->string('secondary_phone')->nullable();
            $table->string('secondary_email')->nullable();
            $table->string('secondary_address')->nullable();
            $table->string('secondary_best_time_to_contact')->nullable();

            $table->boolean('secondary_is_mac_registered')->default(0); // MAC Support Representative
            $table->text('secondary_list_documents')->nullable();
            $table->boolean('secondary_legal_documentation_stored')->default(0);
            $table->date('secondary_date_legal_orders_end')->nullable();

            $table->boolean('secondary_participants_agreed_contact')->default(0);
            $table->date('secondary_participants_agreed_contact_date')->nullable();

            $table->text('secondary_decision_making_approval_for')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_plan_contact_details_secondary');
    }
};

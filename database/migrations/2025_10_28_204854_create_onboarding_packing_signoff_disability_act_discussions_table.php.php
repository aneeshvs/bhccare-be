<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('disability_act_discussions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('onboarding_packing_signoff_id')
                ->constrained('onboarding_packing_signoffs')
                ->onDelete('cascade');

            $table->boolean('clarify_services_provided')->nullable()->comment('Clarify the type of services provided by the organisation');
            $table->boolean('verbal_information_intake_process')->nullable()->comment('Provide verbal information about intake process: steps and expected timeline');
            $table->boolean('cost_of_services')->nullable()->comment('Cost of services of all scheduled services');
            $table->boolean('participant_rights_handbook')->nullable()->comment('Participant right (Handbook) including complaint, feedback, safety, incident');

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('onboarding_packing_signoff_disability_act_discussions');
    }
};

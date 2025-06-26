<?php
// database/migrations/xxxx_xx_xx_create_housing_histories_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('housing_histories', function (Blueprint $table) {
            $table->id();

            // Housing history (2 years)
            $table->text('most_recent_housing')->nullable();
            $table->text('prior_housing')->nullable();

            // Other services involved (checklist)
            $table->boolean('mental_health_service')->default(false);
            $table->boolean('aboriginal_service')->default(false);
            $table->boolean('communities_and_justice')->default(false);
            $table->boolean('family_violence')->default(false);
            $table->boolean('correctional_service')->default(false);
            $table->boolean('child_protection')->default(false);
            $table->boolean('drug_alcohol_rehabilitation')->default(false);
            $table->boolean('other_services_involved')->default(false);
            $table->text('other_services_description')->nullable();

            // Related details
            $table->text('services_background_info')->nullable();
            $table->text('services_contact_details')->nullable();

            // Known issues
            $table->boolean('issue_mental_health')->default(false);
            $table->boolean('issue_drug_alcohol')->default(false);
            $table->boolean('issue_family_violence')->default(false);
            $table->boolean('issue_police_involvement')->default(false);
            $table->boolean('issue_child_protection')->default(false);
            $table->boolean('issue_child_custody')->default(false);
            $table->text('issue_other_description')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('housing_histories');
    }
};

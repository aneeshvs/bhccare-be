<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('home_residence_types', function (Blueprint $table) {
            $table->id();

            $table->foreignId('home_safety_checklist_assessment_id')
                ->constrained('home_safety_checklist_assessments')
                ->onDelete('cascade');

            // ✅ House enum
            $table->enum('residence_house_type', ['Single / Double Storey', 'Private Rental', 'Care Facility'])->nullable();

            // ✅ Other enum
            $table->enum('residence_other_type', ['Unit', 'Caravan Park', 'Office Housing'])->nullable();
            
            // ✅ Assessment completed with enum
            $table->enum('assessment_completed_with', ['Participant', 'Support Worker', 'Guardian / Next Of Kin'])->nullable();

            // ✅ Additional fields
            $table->string('name')->nullable();
            $table->string('position')->nullable();
            $table->date('review_date')->nullable();
            $table->string('care_facility')->nullable();

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_safety_residence_types');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('assessment_violence_risks', function (Blueprint $table) {
            $table->id();

            // Parent FK
            $table->unsignedBigInteger('individual_risk_assessment_id')->nullable();
            $table->foreign('individual_risk_assessment_id')
                ->references('id')->on('individual_risk_assessments')
                ->onDelete('cascade');

            // Violence Risk fields
            $table->boolean('physical_aggression')->default(false);
            $table->text('physical_hazards')->nullable();
            $table->text('physical_management_plan')->nullable();
            $table->boolean('physical_bsp_plan')->default(false);

           $table->enum('verbal_aggression', ['Yes', 'No', 'N/A'])->nullable();
             $table->text('verbal_aggression_notes')->nullable();
            $table->text('verbal_hazards')->nullable();
            $table->text('verbal_management_plan')->nullable();
            $table->boolean('verbal_bsp_plan')->default(false);

            $table->boolean('client_aggression')->default(false);
            $table->text('client_hazards')->nullable();
            $table->text('client_management_plan')->nullable();
            $table->boolean('client_bsp_plan')->default(false);

           


            $table->boolean('self_harm')->default(false);
            $table->text('self_harm_hazards')->nullable();
            $table->text('self_harm_management_plan')->nullable();
            $table->boolean('self_harm_bsp_plan')->default(false);

            $table->boolean('drug_alcohol_use')->default(false);
            $table->text('drug_alcohol_hazards')->nullable();
            $table->text('drug_alcohol_management_plan')->nullable();
            $table->boolean('drug_alcohol_bsp_plan')->default(false);

            $table->boolean('sexual_abuse_history')->default(false);
            $table->text('sexual_abuse_hazards')->nullable();
            $table->text('sexual_abuse_management_plan')->nullable();
            $table->boolean('sexual_abuse_bsp_plan')->default(false);

            $table->boolean('emotional_manipulation')->default(false);
            $table->text('emotional_hazards')->nullable();
            $table->text('emotional_management_plan')->nullable();
            $table->boolean('emotional_bsp_plan')->default(false);

            $table->boolean('other_known_risks')->default(false);
            $table->text('other_risks_hazards')->nullable();
            $table->text('other_risks_management_plan')->nullable();
            $table->boolean('other_risks_bsp_plan')->default(false);

           $table->enum('finance_management', ['Yes', 'No', 'N/A'])->nullable();
             $table->text('finance_management_notes')->nullable();
            $table->text('finance_hazards')->nullable();
            $table->text('finance_management_plan')->nullable();
            $table->boolean('finance_bsp_plan')->default(false);

          

            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assessment_violence_risks');
    }
};

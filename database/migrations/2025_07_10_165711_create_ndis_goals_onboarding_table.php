<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;

return new class extends Migration {
    public function up(): void {
        Schema::create('ndis_goals_onboarding', function (Blueprint $table) {
            $table->id();
            $table->foreignId('initial_enquiry_id')->constrained('initial_enquiries')->onDelete('cascade');
            $table->text('goal_description')->nullable();
            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void {
        Schema::dropIfExists('ndis_goals_onboarding');
    }
};


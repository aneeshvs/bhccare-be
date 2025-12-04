<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('chargeband', function (Blueprint $table) {
            $table->id();
            $table->string('chargeband_name', 100);
            $table->unsignedInteger('categoryid');
            $table->unsignedInteger('fundtypeid');
            $table->string('serviceid', 50);
            $table->string('color', 10)->default('#66bb6a');
            $table->unsignedTinyInteger('status')->default(1);
            $table->dateTime('created_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->unsignedInteger('companyid');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chargeband');
    }
};

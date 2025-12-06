<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration {
    public function up(): void
    {
        Schema::create('chargeband', function (Blueprint $table) {
            $table->id();
            $table->string('chargeband_name', 100);
            $table->unsignedInteger('categoryid')->nullable();
            $table->unsignedInteger('fundtypeid')->nullable();
            $table->string('serviceid', 50)->nullable();
            $table->string('color', 10)->default('#66bb6a')->nullable();
            $table->unsignedTinyInteger('status')->default(1)->nullable();
            $table->dateTime('created_date')->default(DB::raw('CURRENT_TIMESTAMP'))->nullable();
            $table->unsignedInteger('companyid')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chargeband');
    }
};

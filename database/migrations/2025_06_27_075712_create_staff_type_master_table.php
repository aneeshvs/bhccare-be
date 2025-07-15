<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;


return new class extends Migration {
    public function up(): void
    {
        Schema::create('staff_type_master', function (Blueprint $table) {
            $table->id(); // This will match the option values like 11, 12, etc.
            $table->string('name'); // eg: Support Worker, HR, etc.
             MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('staff_type_master');
    }
};

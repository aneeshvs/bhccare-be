<?php // database/migrations/xxxx_xx_xx_create_accommodations_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\MigrationHelper;
class CreateAccommodationsTable extends Migration
{
    public function up()
    {
        Schema::create('accommodations', function (Blueprint $table) {
            $table->id();
            $table->string('type_of_accommodation')->nullable();
            $table->string('requested_support')->nullable();
            $table->enum('worker_preference', ['Male', 'Female', 'No Preference'])->nullable();
            $table->date('date_of_referral')->nullable()->nullable();
            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());


        });
    }

    public function down()
    {
        Schema::dropIfExists('accommodations');
    }
}

<?php
use App\Classes\MigrationHelper;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTypesTable extends Migration
{
    public function up()
    {
        Schema::create('user_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            MigrationHelper::addColumns($table, MigrationHelper::defaultColumnFlags());

        });
    }

    public function down()
    {
        Schema::dropIfExists('user_types');
    }
}

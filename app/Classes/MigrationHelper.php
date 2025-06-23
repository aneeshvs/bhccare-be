<?php

namespace App\Classes;

use App\Models\Status;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\IndexDefinition;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Fluent;
use Illuminate\Support\Str;

class MigrationHelper
{
    const ADMINISTRATOR = 1;
    const COLUMN_CLIENT = 2;
    const COLUMN_CREATED = 4;
    const COLUMN_DELETED = 8;
    const COLUMN_PARTNER_ADMIN = 16;
    const COLUMN_STATUS = 32;
    const COLUMN_UPDATED = 64;
    const COLUMN_OWNER = 128;
    const COLUMN_UUID = 256;

    const FOREIGN_ID_NULLABLE = 1;
    const FOREIGN_ID_PRIMARY = 2;
    const FOREIGN_ID_UNIQUE = 4;

    const PREDICT_KEY_TYPE_FOREIGN = 'foreign';
    const PREDICT_KEY_TYPE_PRIMARY = 'primary' ;
    const PREDICT_KEY_TYPE_UNIQUE = 'unique';

    public static function addColumns(Blueprint &$table,int $column_flags): void
    {
        if ((static ::COLUMN_STATUS & $column_flags) === static::COLUMN_STATUS)
        {
           // $table->foreignIdFor(Status::class);
            $table->unsignedSmallInteger('status_id')
                ->references('id')
                ->on(Status::tableWithDatabase())
                ->default(1);
        }

        if ((static ::COLUMN_OWNER & $column_flags) === static::COLUMN_OWNER)
        {
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->string('owner_type')->nullable();
        }

        // if ((static ::COLUMN_CLIENT & $column_flags) === static::COLUMN_CLIENT)
        // {
        //     $table->foreignId('Client_id')
        //         ->nullable()
        //         ->references('id')
        //         ->on(Client::tableWithDatabase());
        // }

        if((static::COLUMN_CREATED & $column_flags) === static::COLUMN_CREATED)
        {
            $table->dateTime('created_at')
            ->useCurrent();
        }

        if((static::COLUMN_DELETED & $column_flags) === static::COLUMN_DELETED)
        {
            $table->softDeletes();
        }

        if((static::COLUMN_UPDATED & $column_flags) === static::COLUMN_UPDATED)
        {
            $table->dateTime('updated_at')
            ->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        }

        if((static::COLUMN_UUID & $column_flags) === static::COLUMN_UUID)
        {
            $table->string('uuid',64)
                ->unique();
        }

    }

    public static function dropColumns(Blueprint &$table,int $column_flags): void
    {
        if ((static ::COLUMN_STATUS & $column_flags) === static::COLUMN_STATUS)
        {
            $table->dropConstrainedforeignId('state_id');

        }

        if ((static ::COLUMN_OWNER & $column_flags) === static::COLUMN_OWNER)
        {
            $table->dropColumn('owner_id');
            $table->dropColumn('owner_type');
        }

        if ((static ::COLUMN_CLIENT & $column_flags) === static::COLUMN_CLIENT)
        {
            $table->dropConstrainedforeignId('Client_id');

        }

        if((static::COLUMN_CREATED & $column_flags) === static::COLUMN_CREATED)
        {
            $table->dropColumn('created_at');
        }

        if((static::COLUMN_DELETED & $column_flags) === static::COLUMN_DELETED)
        {
            $table->dropsoftDeletes();
        }

        if((static::COLUMN_UPDATED & $column_flags) === static::COLUMN_UPDATED)
        {
            $table->dropcolumn('updated_at');
        }

        if((static::COLUMN_UUID & $column_flags) === static::COLUMN_UUID)
        {
            $table->dropColumn('uuid');

        }
    }

    public static function defaultColumnFlags(int $extra_flags = 0): int
    {
        return
        self::COLUMN_CREATED|
        self::COLUMN_DELETED|
        self::COLUMN_UPDATED|
        self::COLUMN_OWNER|
        self::COLUMN_STATUS|
        self::COLUMN_UUID| $extra_flags;

    }

    public static function defaultColumnFlagsForTranslations(int $extra_flags = 0): int
    {
        return self::COLUMN_CREATED|
        self::COLUMN_DELETED|
        self::COLUMN_UPDATED|
        self::COLUMN_OWNER|
        self::COLUMN_UUID| $extra_flags;

    }

    public static function dateColumnFlags(int $extra_flags = 0): int
    {
        return self::COLUMN_CREATED|
        self::COLUMN_DELETED|
        self::COLUMN_UPDATED| $extra_flags;

    }

    public static function dateAndOwnerColumnFlags(int $extra_flags = 0): int
    {
        return self::COLUMN_CREATED|
        self::COLUMN_DELETED|
        $extra_flags;
    }

    public static function predictKey(Blueprint $table, string|array $column_or_columns, string $append = NULL): ?string
    {
        $tableName = $table->getTable();
        $databaseName = NULL;
        if(str_contains($tableName,'.')){
            [$databaseName,$tableName] = explode('.',$tableName);
            $databaseName = trim($databaseName,'`');
            $tableName = trim($tableName,'`');
        }

        $columnOrJointColumns = $column_or_columns;
        if(is_array($column_or_columns)){
            $columnOrJointColumns = implode('-',$column_or_columns);
        }

        $predictKey = ($databaseName === NULL ? NULL :$databaseName.'_').$tableName.'_' .$columnOrJointColumns.'_'.$append;
        if(strlen($predictKey) >= 64){
            $words = explode( '_', $columnOrJointColumns );
            $acronymOfColumnOrJointColumns = '';
            foreach($words as $w) {
                $acronymOfColumnOrJointColumns .=$w[0];
            }
            return str::uuid() . '-' . $append;
        }
        return NULL;

    }


    public static function predictUniqueKey(Blueprint $table, string|array $column_or_columns) : ?string
    {
        return static::predictKey($table,$column_or_columns, static::PREDICT_KEY_TYPE_UNIQUE);
    }

    public static function uniqueColumns(Blueprint &$table, array $columns) : IndexDefinition|Fluent
    {
        $tableName = $table->getTable();
        $databaseName = NULL;
        if(str_contains($tableName, '.')) {
            [$databaseName, $tableName] = explode('.', $tableName);
            $databaseName = trim($databaseName,'`' );
            $tableName = trim($tableName,'`');
        }
        return $table->unique($columns,static::predictUniqueKey($table,$columns));
    }
}



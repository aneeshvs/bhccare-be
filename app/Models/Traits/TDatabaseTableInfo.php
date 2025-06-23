<?php
namespace App\Models\Traits;

trait TDatabaseTableInfo
{
    public static function table(): string
    {
        return (new static())
            ->getTable();
    }

    public static function tableWithDatabase(): string
    {
        $static = new static();

        return $static->getConnection()
                ->getDatabaseName() . "." . 
                $static->getTable();
    }

    public static function tableWithConnection(): string
    {
        $static = new static();

        return $static ->getConnection()
                ->getName() . 
            "." . 
            $static->getConnection()
                ->GetDatabaseName() . "." . 
                $static->getTable();

    }
}
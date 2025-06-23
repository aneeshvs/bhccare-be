<?php

namespace App\Models\Traits;

use App\Models\Classes\BaseDBModel;
use App\Models\Classes\DefaultDBModel;
use App\Models\Classes\SiteDBModel;

trait TBaseModel
{

    abstract protected static function init(): string;

    public static function connectionName() : ?string
    {
        return ( new static())
        ->getConnection()
        ->getName();
    }

    public static function databaseName():?string
    {
        return ( new static())
        ->getConnection()
        ->getDatabaseName();
    }

    public static function make(string $table_name,bool $with_connection_name = TRUE): string
    {
        return ($with_connection_name ? static::connectionName() . '.' : NULL) .
        static::databaseName() . '.' .
        $table_name;
    }

    public static function siblingTable (string$table_name): string
    {
        return ( new static())
        ->getConnection()
        ->getDatabaseName() . "." .
        $table_name;
    }

    public static function makeJunctionTable(BaseDBModel|DefaultDBModel|SiteDBModel $with_model,
                                            string                                  $prefix = NULL,
                                            string                                  $suffix = Null): string
    {
        return( new static())
              ->getConnection()
              ->getDatabaseName() .
              "." .
              (new static())
              ->table() .
              "_" .
              $prefix .
              $with_model->table() .
              $suffix;
    }

    public static function makeJunctionTableWithConnection(BaseDBModel|DefaultDBModel|siteDBModel $with_model,
                                                           string                                 $prefix= NULL,
                                                           string                                 $suffix= NULL):string
    {
        return( new static())->getConnection()
        ->getName() .
         '.' .
         static::makeJunctionTable($with_model,$prefix,$suffix);
    }

    public  function __construct(array $attributes =[])
    {
        parent::__construct($attributes);
        //$this->connection = 'mysql_' . $this::init();
    }

    public static function getName():string
    {
        $classParts = explode('\\',get_class(new static()));
        return ltrim(preg_replace("([A-Z])","-$0", end($classParts)),'-');
    }

    public static function model()
    {
        return app(static::class);
    }

}


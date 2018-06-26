<?php
namespace Metz\app\metz\constants;
use Metz\app\metz\db\drivers;

class Driver
{
    const MYSQL = 'mysql';
    const REDIS = 'redis';
    const POSTGRES = 'postgres';

    private static $_supporting = [
        Driver::MYSQL => drivers\Mysql::class,
        Driver::REDIS => null,
        Driver::POSTGRES => null,
    ];

    public static function dirver_class($driver)
    {
        if (isset(self::$_supporting[$driver])) {
            return self::$_supporting[$driver];
        }
        return null;
    }

    public static function supporting_list()
    {
        return array_keys(
            array_filter(
                self::$_supporting,
                function ($val) {
                    return $val;
                }
            )
        );
    }
}
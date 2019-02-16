<?php
/**
 * Created by AlicFeng in 2017/11/9 14:22
 */

namespace App\Common\Factory;

use Redis;

class  SamegoRedis
{
    private static $_instance = null; //静态实例

    private $host     = null;
    private $port     = null;
    private $password = null;

    private function __construct()
    {
        $this->host     = config('database.redis.default.host', '127.0.0.1');
        $this->port     = config('database.redis.default.port', 6379);
        $this->password = config('database.redis.default.password', '123!@#qwe');
        //私有的构造方法
        self::$_instance = new Redis();
        self::$_instance->connect($this->host, $this->port);
        self::$_instance->auth($this->password);
    }

    //获取静态实例
    public static function getRedis()
    {
        if (!self::$_instance) {
            new self;
        }
        return self::$_instance;
    }

    /*
     * 禁止clone
     */
    private function __clone()
    {
    }
}
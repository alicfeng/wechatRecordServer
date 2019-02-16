<?php
/**
 * Created by PhpStorm   User: AlicFeng   DateTime: 19-1-18 下午4:30
 */

namespace App\Common;


class Application
{
    /*获取是否属于开发环境*/
    public static function isDevEnv()
    {
        return 'development' === config('app.env');
    }

    /*获取是否属于调试状态*/
    public static function isDebug()
    {
        return config('app.debug', false);
    }
}
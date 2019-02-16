<?php
/**
 * Created by PhpStorm   User: AlicFeng   DateTime: 19-1-21 上午10:20
 */

namespace App\Base;

trait StaticInstanceTrait
{
    /**
     * Returns static class instance, which can be used to obtain meta information.
     * 笑~ Friendly tips
     * @return static class instance.
     */
    public static function instance()
    {
        return app()->make(get_called_class());
    }
}
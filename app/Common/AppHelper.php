<?php
/**
 * Created by PhpStorm.
 * User: alicfeng
 * Date: 2018/7/20
 * Time: 下午11:13
 */

namespace App\Common;


use App\Queue\WarningJob;

class AppHelper
{
    /**
     * @functionName   程序报警
     * @description    程序报警
     * @version        v1.0.0
     * @author         Alicfeng
     * @datetime       18-10-13 下午5:41
     * @param $user
     * @param $apartment
     * @param $level
     * @param $content
     * @response       []
     */
    public static function alarm($user, $apartment, $level, $content)
    {
        $level    = config('application.alarm_level.' . $level, 'missLevel');
        $datetime = date('Y-m-d H:i:s');
        if ($level != EW_INFO) {
            dispatch(new WarningJob($user, $apartment, "时间:{$datetime} \n" . "{$level} \n" . $content));
        }
    }
}
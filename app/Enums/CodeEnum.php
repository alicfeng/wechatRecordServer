<?php
/**
 * Created by PhpStorm   User: AlicFeng   DateTime: 19-1-18 下午3:24
 */

namespace App\Enums;
/**
 * Class CodeEnum
 * 响应体code与message枚举
 */
class CodeEnum
{
    // base 成功 || 失败
    const SUCCESS = ['0000', 'success'];
    const FAIL    = ['9999', 'fail'];

    // 缺少参数
    const MISS_PARAM = ['1001', 'miss param'];
}
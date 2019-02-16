<?php
/**
 * Created by PhpStorm   User: AlicFeng   DateTime: 19-1-24 上午10:44
 */

namespace App\Validator;


interface SupportIF
{
    /**
     * @functionName   设置规则
     * @description    返回的数组规则 | return ['one'=>[$ruleFiled=>[],$messageFiled=>[],$attributeFiled=>[]]
     * @param string $ruleFiled 规则字段键名
     * @param string $messageFiled 信息字段键名
     * @param string $attributeFiled 属性段键名
     * @return array
     */
    public function loadRule(string $ruleFiled, string $messageFiled, string $attributeFiled);
}
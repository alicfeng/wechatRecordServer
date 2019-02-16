<?php
/**
 * Created by PhpStorm   User: AlicFeng   DateTime: 19-1-21 上午11:06
 */

namespace App\Rules\Self;


/**
 * 自定义请求校验规则
 * Class RequestValidator
 * @package App\Rules\Self
 */
class RequestValidator
{
    /**
     * @functionName   Post请求报文结构化
     * @description    Post请求报文结构化
     * @version        v1.0.0
     * @author         Alicfeng
     * @datetime       19-1-21 上午11:07
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param $validator
     * @return bool
     */
    public function postStructure($attribute, $value, $parameters, $validator)
    {
        return is_array($value) && isset($value);
    }
}
<?php
/**
 * Created by AlicFeng at 2019/1/20 上午12:24
 */

namespace App\Validator;

use Illuminate\Support\Facades\Validator;

class TsbValidator
{

    const FIELD_RULE      = 'rule';
    const FIELD_MESSAGE   = 'message';
    const FIELD_ATTRIBUTE = 'attribute';


    /**
     * 统一校验输入
     * @param $input
     * @param array $validatorStore 校验配置项
     * @return \Illuminate\Contracts\Validation\Validator|\Illuminate\Validation\Validator
     */
    public static function make($input, array $validatorStore)
    {
        return Validator::make($input, $validatorStore[self::FIELD_RULE], $validatorStore[self::FIELD_MESSAGE], [self::FIELD_ATTRIBUTE]);
    }
}
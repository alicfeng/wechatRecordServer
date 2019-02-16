<?php
/**
 * Created by PhpStorm   User: AlicFeng   DateTime: 19-1-23 下午5:17
 */

namespace App\Validator\Support\Content;


use App\Common\Router\InterfaceAlias;
use App\Validator\BaseRuleStore;
use App\Validator\SupportIF;

class ArticleStore extends BaseRuleStore implements SupportIF
{
    /**
     * @functionName   设置规则
     * @description    返回的数组规则 | return ['one'=>[$ruleFiled=>[],$messageFiled=>[],$attributeFiled=>[]]
     * @param string $ruleFiled 规则字段键名
     * @param string $messageFiled 信息字段键名
     * @param string $attributeFiled 属性段键名
     * @return array
     */
    public function loadRule(string $ruleFiled, string $messageFiled, string $attributeFiled)
    {
        return [
            /*文章详情接口*/
            InterfaceAlias::WBS_ARTICLE_DETAIL => [
                $ruleFiled      => [
                    'id' => 'required|integer|min:1'
                ],
                $messageFiled   => [
                    'id.required' => '缺少参数id',
                    'id.integer'  => 'id必须是整数',
                    'id.min'      => 'id的值不合法'
                ],
                $attributeFiled => [

                ]
            ]
        ];
    }
}
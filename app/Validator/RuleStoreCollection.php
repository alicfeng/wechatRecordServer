<?php
/**
 * Created by PhpStorm   User: AlicFeng   DateTime: 19-1-23 下午3:22
 */

namespace App\Validator;


use App\Base\StaticInstanceTrait;
use App\Validator\Support\Content\ArticleStore;

class RuleStoreCollection
{
    use StaticInstanceTrait;
    // 规则集合
    private $ruleStoreContainer = [];
    // 规则注册类集合
    private $ruleClassList = [];
    // 记录是否载入规则
    private $mem = false;

    /*
    |--------------------------------------------------------------------------
    | Register The Auto Loader
    |--------------------------------------------------------------------------
    | 注册规则Store类到规则类集合
    | 对应的规则将会自动加载到规则容器
    */
    public function register()
    {
        $this->ruleClassList = [
            // todo register rule store
            ArticleStore::instance()
        ];
    }

    /**
     * @functionName   加载规则
     * @description    加载规则
     * @version        v1.0.0
     * @author         Alicfeng
     * @datetime       19-1-24 上午10:59
     */
    private function load()
    {
        $this->register();
        foreach ($this->ruleClassList as $item) {
            $this->ruleStoreContainer = array_merge($this->ruleStoreContainer, $item->loadRule(TsbValidator::FIELD_RULE, TsbValidator::FIELD_MESSAGE, TsbValidator::FIELD_ATTRIBUTE));
        }
        $this->mem = true;
    }

    /**
     * @functionName   获取规则
     * @description    根据路由别名获取对应的规则
     * @version        v1.0.0
     * @author         Alicfeng
     * @datetime       19-1-24 上午10:59
     * @param string $name 规则名称
     * @return bool|array
     */
    public function getRule(string $name)
    {
        false == $this->mem ? $this->load() : null;
        if (array_key_exists($name, $this->ruleStoreContainer)) {
            return $this->ruleStoreContainer[$name];
        }
        return false;
    }
}
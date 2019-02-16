<?php
/**
 * Created by AlicFeng in 2017/12/22 18:08
 */

namespace App\Http\Middleware;


use App\Common\Constant;
use App\Enums\CodeEnum;
use App\Helper\ResponseHelper;
use App\Validator\RuleStoreCollection;
use App\Validator\TsbValidator;
use Closure;
use Illuminate\Http\Request;
use Log;


class ValidatorMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            Log::info('validatorMiddleware');
            $routeName = $request->route()->getName();
            $ruleStore = RuleStoreCollection::instance();
            // 路由名称为空则不校验
            if ('' == $routeName || null == $routeName) {
                return $next($request);
            }
            // 路由映射的规则不存在则不校验
            $rule = $ruleStore->getRule($routeName);
            if (false == $rule) {
                return $next($request);
            }
            // 获取请求体校验
            switch ($request->method()) {
                case Request::METHOD_POST:
                    $message = $request->all()[Constant::REQUEST_PACKET_CONSTRUCT_BODY_NAME];
                    break;
                default:
                    $message = $request->all();
                    break;
            }
            $validator = TsbValidator::make($message, $rule);
            if ($validator->fails()) {
                $errTip = json_encode($validator->messages(), JSON_UNESCAPED_UNICODE);
                exit(ResponseHelper::generate(CodeEnum::FAIL[0], CodeEnum::FAIL[1] . $errTip));
            }
            return $next($request);
        }
        catch (\Exception $exception) {
            exit(ResponseHelper::generate(CodeEnum::FAIL[0], CodeEnum::FAIL[1]));
        }
    }

    public function terminate($request, $response)
    {
        //这里是响应后调用的方法(没有返回值)
    }
}
<?php
/**
 * Created by PhpStorm   User: AlicFeng   DateTime: 18-8-4 下午6:10
 */

namespace App\Http\Controllers;


use App\Common\Application;
use App\Common\Constant;
use App\Enums\CodeEnum;
use App\Helper\ResponseHelper;
use Illuminate\Http\Request;
use Log;

class BaseController extends Controller
{
    public function __construct()
    {
        /*Special for tracking log*/
        $this->middleware('track.middleware');
        // 目前仅限开发环境
        if (Application::isDevEnv()) {
            $this->middleware('request.validator');
        }
    }

    /**
     * 获取请求管道参数值
     * @param Request $request 请求对象体
     * @param string $parameterKey 参数的键名
     * @param boolean $allowedEmpty 参数是否允许为空|默认不允许
     * @return mixed
     */
    public function queryBodyParameter($request, $parameterKey, $allowedEmpty = false)
    {
        try {

            $message = $request->post()[Constant::REQUEST_PACKET_CONSTRUCT_BODY_NAME];
            if ($allowedEmpty) {
                return $message[$parameterKey] ?? null;
            } else {
                if (!array_key_exists($parameterKey, $message)) {
                    exit(ResponseHelper::generate(CodeEnum::MISS_PARAM[0],CodeEnum::MISS_PARAM[1], DIRECTORY_SEPARATOR . Constant::REQUEST_PACKET_CONSTRUCT_HEADER_NAME . DIRECTORY_SEPARATOR . Constant::USER_TOKEN_NAME));

                }
                return $message[$parameterKey];
            }

        }
        catch (\Exception $exception) {
            Log::error($exception);
            exit(ResponseHelper::generate(CodeEnum::FAIL[0],CodeEnum::FAIL[1]));
        }
    }

    /**
     * 获取用户的ID
     * @param Request $request 请求对象体
     * @return int 用户ID
     */
    public function uuid($request)
    {
        try {
            $message = $request->post()[Constant::REQUEST_PACKET_CONSTRUCT_HEADER_NAME];
            if (!array_key_exists(Constant::USER_TOKEN_NAME, $message)) {
                exit(ResponseHelper::generate(CodeEnum::MISS_PARAM[0],CodeEnum::MISS_PARAM[1], DIRECTORY_SEPARATOR . Constant::REQUEST_PACKET_CONSTRUCT_HEADER_NAME . DIRECTORY_SEPARATOR . Constant::USER_TOKEN_NAME));
            }
            return $request[Constant::USER_TOKEN_TRANSFORM_USER_ID_SIGN];

        }
        catch (\Exception $exception) {
            Log::error($exception);
            exit(ResponseHelper::generate(CodeEnum::FAIL[0],CodeEnum::FAIL[1]));
        }
    }


    /**
     * 获取URL管道参数
     * @param Request $request 请求对象体
     * @param string $parameterKey 参数的键名
     * @param bool $allowEmpty 参数是否允许为空|默认不允许
     * @param bool $default 默认值
     * @return mixed
     */
    public function parameter($request, $parameterKey, $allowEmpty = false, $default = null)
    {
        try {
            $value = $request->get($parameterKey);
            if (!$allowEmpty && null == $value) {
                exit(ResponseHelper::generate(CodeEnum::MISS_PARAM[0],CodeEnum::MISS_PARAM[1], DIRECTORY_SEPARATOR . Constant::REQUEST_PACKET_CONSTRUCT_HEADER_NAME . DIRECTORY_SEPARATOR . Constant::USER_TOKEN_NAME));
            }
            return (null != $default && null == $value) ? $default : $value;
        }
        catch (\Exception $exception) {
            Log::error($exception);
            exit(ResponseHelper::generate(CodeEnum::FAIL[0],CodeEnum::FAIL[1]));
        }
    }
}
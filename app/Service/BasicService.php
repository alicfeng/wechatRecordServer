<?php
/**
 * Created by PhpStorm AlicFeng 2018\7\9 0009 17:06
 */

namespace App\Service;


use App\Helper\ResponseHelper;
use App\Http\Response\BasicResponse;
use App\Http\Response\ResponseCode;
use Illuminate\Http\Request;

class BasicService
{
    /**
     * 获取post请求body参数
     * @param string $name
     * @param  Request $request
     * @return string
     */
    public function getBodyParam($name, $request)
    {
        $message = $request->post()['body'];
        if (!array_key_exists($name, $message)) {
            exit(BasicResponse::basicResponse(ResponseCode::Missing_Param, '/body/' . $name));
        }
        return $message[$name];
    }

    /**
     * 获取POST请求的参数
     * @param $name
     * @param Request $request
     * @return mixed
     */
    public function getPostParam($name, $request)
    {
        $message = $request->post();
        if (!array_key_exists($name, $message)) {
            exit(BasicResponse::basicResponse(ResponseCode::Missing_Param, '/' . $name));
        }
        return $message[$name];
    }

    /**
     * 通过路径读取参数
     * @param $path
     * @param  $request
     * @return mixed
     */
    public function getPathParam($path, $request)
    {
        $value = $request;
        $paths = explode('/', $path);
        for ($index = 0; $index < count($paths); $index++) {
            if (is_array($value)) {
                if (!array_key_exists($paths[$index], $value)) {
                    exit(BasicResponse::basicResponse(ResponseCode::Missing_Param, $path));
                }
                $value = $value[$paths[$index]];
            }
        }
        return $value;
    }


    /**
     * @param $name
     * @param Request $request
     * @return mixed
     */
    public function getParam($name, $request)
    {
        $value = $request->get($name);
        if (!$value) {
            exit(BasicResponse::basicResponse(ResponseCode::Missing_Param, '/body/' . $name));
        }
        return $value;
    }

    public function result(array $codeEnum, $data = '', bool $logFlag = true, $format = ResponseHelper::FORMAT_JSON)
    {
        return ResponseHelper::generate($codeEnum[0], $codeEnum[1], $data, $logFlag,$format);
    }
}
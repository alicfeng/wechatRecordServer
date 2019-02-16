<?php
/**
 * Created by PhpStorm   User: AlicFeng   DateTime: 19-1-18 下午3:24
 */

namespace App\Helper;

use Log;
use Spatie\ArrayToXml\ArrayToXml;

class ResponseHelper
{
    // 格式 {1-json | 2-xml}
    const FORMAT_JSON = 1;
    const FORMAT_XML  = 2;

    // 结构体根节点项名称
    const STRUCTURE_CODE_NAME    = 'resultCode';
    const STRUCTURE_MESSAGE_NAME = 'message';
    const STRUCTURE_DATA_NAME    = 'data';

    /**
     * @functionName   统一生成响应体
     * @description    统一生成响应体
     * @version        v1.0.0
     * @author         Alicfeng
     * @datetime       19-1-18 下午3:33
     * @param string $code 响应码
     * @param string $message 响应信息
     * @param mixed $data 响应信息
     * @param bool $logFlag 是否打印日志 true打印日志 false不打印日志
     * @param int $format 响应格式
     * @return string
     */
    public static function generate(string $code, string $message, $data = '', bool $logFlag = true, int $format = self::FORMAT_JSON)
    {
        $ret = [self::STRUCTURE_CODE_NAME => $code, self::STRUCTURE_MESSAGE_NAME => $message, self::STRUCTURE_DATA_NAME => $data];
        if (self::FORMAT_JSON === $format) {
            $response = self::json($ret);
        } else {
            $response = self::xml($ret);
        }
        unset($ret);
        true === $logFlag ? Log::info($response) : null;
        return $response;
    }

    /**
     * @functionName   统一转json格式
     * @description    统一转json格式
     * @version        v1.0.0
     * @author         Alicfeng
     * @datetime       19-1-21 下午3:07
     * @param array $ret
     * @return string
     */
    public static function json(array $ret)
    {
        return json_encode($ret, JSON_UNESCAPED_UNICODE);
    }

    /**
     * @functionName   统一转xml格式
     * @description    统一转xml格式
     * @version        v1.0.0
     * @author         Alicfeng
     * @datetime       19-1-21 下午3:07
     * @param array $ret
     * @return string
     */
    public static function xml(array $ret)
    {
        return ArrayToXml::convert($ret, 'root');
    }
}
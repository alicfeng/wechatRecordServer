<?php
/**
 * Created by AlicFeng at 2019-02-13 15:29
 */

namespace App\Lib\Qiniu;


use Log;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

class OssManager
{
    /**
     * 单文件上传
     * @param string $filePath 文件路径
     * @param string $fileName 文件名称
     * @return bool
     */
    public static function upload($filePath, $fileName)
    {
        $auth      = new Auth(config('qiniu.oss.access_key'), config('qiniu.oss.secret_key'));
        $token     = $auth->uploadToken(config('qiniu.oss.bucket'));
        $uploadMgr = new UploadManager();
        try {
            list($ret, $err) = $uploadMgr->putFile($token, $fileName, $filePath);
            if (null === $err) {
                return $ret['key'];
            }
        } catch (\Exception $e) {
            Log::error($e);
            return false;
        }
        return false;
    }
}
<?php
/**
 * Created by AlicFeng at 2019-02-13 15:35
 */

namespace App\Service\Platform;


use App\Enums\CodeEnum;
use App\Lib\Qiniu\OssManager;
use App\Service\BasicService;
use Log;

class FileService extends BasicService
{
    const DOMAIN = 'http://oss.yi-insurance.com/';

    public function upload()
    {
        $file   = $_FILES['file'];
        Log::info($file);
        $result = OssManager::upload($file["tmp_name"], 'chat/' . self::fileKey() . self::getExtName($file['name']));
        return $this->result(CodeEnum::SUCCESS, self::DOMAIN . $result);
    }

    /**
     * 获取文件的扩展名称
     * @param string $oriName 原始文件名
     * @return string
     */
    private static function getExtName($oriName)
    {
        return strtolower(strrchr($oriName, '.'));
    }

    /**
     * 七牛上传keyName
     * @return string
     */
    private static function fileKey()
    {
        return time() . rand(1000, 9999);
    }
}
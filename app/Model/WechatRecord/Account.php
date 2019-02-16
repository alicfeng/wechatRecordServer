<?php
/**
 * Created by AlicFeng at 2019-02-13 10:20
 */

namespace App\Model\WechatRecord;


use App\Common\Database\MySQL\TNS;
use App\Model\BaseModel;

/**
 * 微信账号
 * Class Account
 * @package App\Model\WechatRecord
 */
class Account extends BaseModel
{
    protected $table = TNS::O_WECHAT_ACCOUNT;
}
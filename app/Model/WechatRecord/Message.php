<?php

namespace App\Model\WechatRecord;

use App\Common\Database\MySQL\TNS;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = TNS::O_WECHAT_MESSAGE;
    public static $tableName = TNS::O_WECHAT_MESSAGE;
}

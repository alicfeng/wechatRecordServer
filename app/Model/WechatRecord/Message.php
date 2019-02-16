<?php

namespace App\Model\WechatRecord;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'o_wechat_message';
    public static $tableName = 'o_wechat_message';
}

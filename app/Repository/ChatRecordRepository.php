<?php
/**
 * Created by AlicFeng at 2019-01-31 16:56
 */

namespace App\Repository;

use App\Common\Database\MySQL\TNS;
use App\Common\Database\RedisKey;
use App\Common\Factory\SamegoRedis;
use App\Model\WechatRecord\Account;
use App\Model\WechatRecord\Contact;
use App\Model\WechatRecord\Message;
use Illuminate\Support\Facades\DB;

class ChatRecordRepository
{
    // 在线超时时间 默认为10s
    const ONLINE_TIMEOUT = 10;

    private $database;
    private $redis;


    public function __construct()
    {
        $this->database = DB::connection();
        $this->redis    = SamegoRedis::getRedis();
    }

    /**
     * 更新在线状态
     * 点亮我在线的灯
     * @param string $username
     */
    public function online(string $username)
    {
        $this->redis->set(RedisKey::OPERATION_WECHAT_MONITOR_ONLINE_PRE . $username, 1);
        $this->redis->expire(RedisKey::OPERATION_WECHAT_MONITOR_ONLINE_PRE . $username, self::ONLINE_TIMEOUT);
    }

    /**
     * 同步账号信息
     * @param string $username
     * @param string $nickname
     */
    public function syncAccount(string $username, string $nickname)
    {
        $data['username'] = $username;
        if (!$this->database->table(TNS::O_WECHAT_ACCOUNT)->where($data)->first()) {
            $data['nickname']     = $nickname;
            $data['created_time'] = time();
            $this->database->table(TNS::O_WECHAT_ACCOUNT)->insert($data);
        } else {
            $this->database->table(TNS::O_WECHAT_ACCOUNT)->where($data)->update(['nickname' => $nickname]);
        }
    }

    /**
     * 同步账号联系人
     * @param string $account
     * @param string $username
     * @param string $nickname
     */
    public function syncContact(string $account, string $username, string $nickname)
    {
        $data['username']         = $username;
        $data['account_username'] = $account;
        if (!$this->database->table(TNS::O_WECHAT_CONTACT)->where($data)->first()) {
            $data['nickname']     = $nickname;
            $data['created_time'] = time();
            $this->database->table(TNS::O_WECHAT_CONTACT)->insert($data);
        } else {
            $this->database->table(TNS::O_WECHAT_CONTACT)->where($data)->update(['nickname' => $nickname]);
        }
    }

    /**
     * 同步账号联系人
     * @param string $account
     * @param array $record
     */
    public function syncChatRecord(string $account, array $record)
    {
        $record['username'] = $account;
        if (!$this->database->table(TNS::O_WECHAT_MESSAGE)->where($record)->first()) {
            $this->database->table(TNS::O_WECHAT_MESSAGE)->insert($record);
        }
    }


    /**
     * 获取微信
     * @return mixed
     */
    public function accountList()
    {
        return Account::get();
    }

    /**
     * 获取联系人列表
     * @return array
     */
    public function contactList($account)
    {
        $queryObj = DB::table(Contact::$tableName)
            ->where('account_username', $account)
            ->leftJoin(
                Message::$tableName,
                Contact::$tableName . '.username',
                '=',
                'talker'
            )
            ->where(function($query) use ($account) {
                return $query->where(
                    Message::$tableName . '.username',
                    $account
                )->orWhereNull(Message::$tableName . '.username');
            })
            ->groupBy(
                Contact::$tableName . '.id'
            )
            ->select(
                Contact::$tableName . '.id',
                Contact::$tableName . '.username',
                Contact::$tableName . '.nickname',
                DB::raw(
                    'max(' . Message::$tableName
                    . '.create_time) as lastMsgTime'
                )
            )
            ->orderBy('lastMsgTime', 'desc');
            $res = $queryObj->get();
            return $res ? $res->toArray() : [];
    }

    /**
     * 获取联系人聊天记录
     * @param $account
     * @param $page
     * @return array
     */
    public function messageList($account, $talkerAccount, $page)
    {
        $limit = 20;
        $offset = $limit * $page;

        $queryObj = Message::where([
            'username' => $account,
            'talker' => $talkerAccount
        ])->orderBy('create_time', 'desc')->offset($offset)->limit($limit);

        $res = $queryObj->get();
        return $res ? $res->toArray() : [];
    }
}

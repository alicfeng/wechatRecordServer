<?php
/**
 * Created by AlicFeng at 2019-01-31 15:29
 */

namespace App\Service\Platform;


use App\Common\Database\RedisKey;
use App\Common\Factory\SamegoRedis;
use App\Enums\CodeEnum;
use App\Job\WechatMessageSyncJob;
use App\Repository\ChatRecordRepository;
use App\Service\BasicService;

class ChatRecordService extends BasicService
{
    private $chatRecordRepository;

    public function __construct(ChatRecordRepository $chatRecordRepository)
    {
        $this->chatRecordRepository = $chatRecordRepository;
    }

    const INTERFACE_ACCOUNT_SYNC = 1;// 账号同步
    const INTERFACE_CONTACT_SYNC = 2;// 联系人同步
    const INTERFACE_RECORD_SYNC  = 3;// 聊天记录同步

    const CONTACT_RELATION_SELF   = 1;// 自己
    const CONTACT_RELATION_FRIEND = 3;// 好友

    /**
     * 请求队列处理 用于微信账号、微信联系人、微信聊天记录上传
     * @param int $interface 接口标识
     * @param string $username 微信用户名
     * @param array $message 信息载体
     * @return string
     */
    public function syncQueue(int $interface, string $username, array $message)
    {
        WechatMessageSyncJob::dispatch($interface, $username, $message);
        return $this->result(CodeEnum::SUCCESS);
    }

    /**
     * 异步队列调用方法
     * @param int $interface
     * @param string $username
     * @param array $message
     */
    public function syncHandler(int $interface, string $username, array $message)
    {
        // 对点刷新软件状态
        $this->chatRecordRepository->online($username);
        switch ($interface) {
            case self::INTERFACE_ACCOUNT_SYNC:
                $this->handlerAccount($username, $message);
                break;
            case self::INTERFACE_CONTACT_SYNC:
                $this->handlerContact($username, $message);
                break;
            case self::INTERFACE_RECORD_SYNC:
                $this->handlerChatRecord($username, $message);
                break;
            default:
                break;
        }
    }

    /**
     * 获取微信账号列表
     * @return string
     */
    public function accountList()
    {
        $accountList = $this->chatRecordRepository->accountList();
        $accountList = $accountList ? $accountList->toArray() : [];

        foreach ($accountList as &$account) {
            $cacheStatus = SamegoRedis::getRedis()->get(
                RedisKey::OPERATION_WECHAT_MONITOR_ONLINE_PRE
                . $account['username']
            );
            $account['online'] = (boolean) $cacheStatus;
        }

        return $this->result(CodeEnum::SUCCESS, $accountList);
    }

    /**
     * 获取联系人列表
     * @return string
     */
    public function contactList($account)
    {
        return $this->result(CodeEnum::SUCCESS, $this->chatRecordRepository->contactList($account));
    }

    /**
     * 获取聊天记录
     * @return string
     */
    public function messageList($account, $talkerAccount, $page)
    {
        $list = $this->chatRecordRepository->messageList($account, $talkerAccount, $page);

        // 部分类型消息内容转为富文本
        foreach ($list as &$record) {
            if ($record['type'] === 3) {
                // 图片
                $record['content'] = '<img src=' . $record['content'] . '>';
            } /*elseif ($record['type'] === 34) {
                // 语音 暂时不用转换
                $record['content'] = '<audio controls>'
                    . '<source src="' . $record['content'] . '" type="audio/mpeg">'
                    . '</audio>';
            }*/ elseif ($record['type'] === 43) {
                // 小视频
                $record['content'] = '<video controls>'
                    . '<source src="' . $record['content'] . '" type="video/mp4">'
                    . '</video>';
            }
        }

        return $this->result(CodeEnum::SUCCESS, $list);
    }

    /**
     * 获取在线状态 map
     * @return string
     */
    public function accountOnlineStatusMap()
    {
        $accountList = $this->chatRecordRepository->accountList();
        $accountList = $accountList ? $accountList->toArray() : [];

        $resMap = [];
        foreach ($accountList as $account) {
            $cacheStatus = SamegoRedis::getRedis()->get(
                RedisKey::OPERATION_WECHAT_MONITOR_ONLINE_PRE
                . $account['username']
            );
            $resMap[$account['username']] = (boolean) $cacheStatus;
        }

        return $this->result(CodeEnum::SUCCESS, $resMap);
    }

    /**
     * 处理账号信息
     * @param string $username 微信用户名
     * @param array $message
     */
    private function handlerAccount(string $username, array $message)
    {
        $this->chatRecordRepository->syncAccount($username, $message['nickname']);
    }

    /**
     * 处理微信联系人
     * @param string $username 微信用户名
     * @param array $message
     */
    private function handlerContact(string $username, array $message)
    {
        foreach ($message as $contact) {
            $this->chatRecordRepository->syncContact($username, $contact['username'], $contact['nickname']);
        }
    }

    /**
     * 处理聊天记录
     * @param string $username 微信用户名
     * @param array $message
     */
    private function handlerChatRecord(string $username, array $message)
    {
        foreach ($message as $record) {
            $this->chatRecordRepository->syncChatRecord($username, $record);
        }
    }

}
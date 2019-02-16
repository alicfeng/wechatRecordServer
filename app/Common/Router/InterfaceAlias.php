<?php
/**
 * Created by PhpStorm   User: AlicFeng   DateTime: 19-1-24 上午9:52
 */

namespace App\Common\Router;

/**
 * 统一接口名称alias
 * Class InterfaceName
 * @package App\Common
 */
class InterfaceAlias
{
    const SIMPLE = 'simple';
    /*
    |--------------------------------------------------------------------------
    | 平台
    |--------------------------------------------------------------------------
    */
    // 微信聊天记录同步
    const CHAT_RECORD_SYNC = 'chat_record_sync';
    // 获取微信账号列表
    const CHAT_RECORD_ACCOUNT = 'chat_record_account';
    // 获取微信账号在线状态 MAP
    const CHAT_RECORD_ACCOUNT_ONLINE_MAP = 'chat_record_account_online_map';
    // 获取微信联系人列表
    const CHAT_RECORD_CONTACT = 'chat_record_contact';
    // 获取微信联系人聊天记录列表
    const CHAT_RECORD_MESSAGE = 'chat_record_message';
}
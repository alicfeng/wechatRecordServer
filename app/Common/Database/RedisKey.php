<?php
/**
 * Created by AlicFeng in 2017/12/29 20:15
 */

namespace App\Common\Database;


class RedisKey
{
    // 白名单 - hKey
    const Api_While_List_IP = 'api_white_list_ip';

    // 用户基础信息(前缀)
    const User_Info_Pre = 'c_user_info_';

    // unionid绑定userId
    const User_Unionid_UserID = 'c_union_user_id';

    // phone绑定userId
    const User_Phone_UserID = 'c_phone_user_id';

    // 登陆用户的token对应userID
    const User_Token_Pre = 'user_token_';

    // 核保成功保存订单号
    const Underwriting_Order_Sn_Pre = 'pay_order_sn_';

    // 微信监控账户在线状态
    const OPERATION_WECHAT_MONITOR_ONLINE_PRE = 'wechat_account_online_';
}
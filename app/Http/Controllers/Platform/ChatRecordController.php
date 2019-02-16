<?php
/**
 * Created by AlicFeng at 2019-01-31 14:23
 */

namespace App\Http\Controllers\Platform;


use App\Http\Controllers\BaseController;
use App\Service\Platform\ChatRecordService;
use Illuminate\Http\Request;

class ChatRecordController extends BaseController
{
    private $request;
    private $chatRecordService;

    public function __construct(Request $request, ChatRecordService $chatRecordService)
    {
        parent::__construct();
        $this->request           = $request;
        $this->chatRecordService = $chatRecordService;
    }

    public function sync()
    {
        $type     = $this->queryBodyParameter($this->request, 'type');
        $username = $this->queryBodyParameter($this->request, 'username');
        $message  = $this->queryBodyParameter($this->request, 'message');

        return $this->chatRecordService->syncQueue($type, $username, $message);
    }

    /**
     * @api {POST} platform/chatRecord/account 微信账号列表
     * @apiGroup Platform
     * @apiVersion 1.0.0
     * @apiDescription 微信账号列表
     *
     * @apiSuccess {String} resultCode 接口响应码
     * @apiSuccess {String} message 接口查询结果信息
     * @apiSuccess {Object[]} data 结果集
     * @apiSuccess {String} data.username 账号名称
     * @apiSuccess {String} data.nickname 昵称
     * @apiSuccess {String} data.created_time 创建时间
     *
     * @apiSuccessExample Success-Response:
     * {
     * "resultCode": "0000",
     * "message": "success",
     * "data": [
     * {
     * "username": "fenglican",
     * "nickname": "AlicFeng",
     * "created_time": 1548926115,
     * "online": false
     * },
     * {
     * "username": "wxid_vtha1da6dbz022",
     * "nickname": "听书人",
     * "created_time": 1549871401,
     * "online": false
     * }
     * ]
     * }
     * @apiSampleRequest platform/chatRecord/account
     */
    public function accountList()
    {
        return $this->chatRecordService->accountList();
    }

    /**
     * @api {POST} platform/chatRecord/contact 微信联系人列表
     * @apiGroup Platform
     * @apiVersion 1.0.0
     * @apiDescription 微信联系人列表
     *
     * @apiParam {String} account 帐号编码
     *
     * @apiSuccess {String} resultCode 接口响应码
     * @apiSuccess {String} message 接口查询结果信息
     * @apiSuccess {Object[]} data 结果集
     * @apiSuccess {String} data.id 联系人唯一编码
     * @apiSuccess {String} data.nickname 联系人微信帐号
     * @apiSuccess {String} data.lastMsgTime 最后联系时间
     * @apiSuccess {String} data.nickname 联系人昵称
     *
     * @apiSuccessExample Success-Response:
     * {
     * "resultCode":"0000",
     * "message":"success",
     * "data": [
     * {
     * "id":5,
     * "username":"fenglican",
     * "nickname":"AlicFeng",
     * "lastMsgTime":"1550115043000"
     * },
     * {
     * "id":4,
     * "username":"wxid_vtha1da6dbz022",
     * "nickname":"听书人",
     * "lastMsgTime":null
     * }
     * ]
     * }
     * @apiSampleRequest platform/chatRecord/contact
     */
    public function contactList()
    {
        return $this->chatRecordService->contactList(
            $this->queryBodyParameter($this->request, 'account')
        );
    }

    /**
     * @api {POST} platform/chatRecord/message 微信联系人聊天记录
     * @apiGroup Platform
     * @apiVersion 1.0.0
     * @apiDescription 微信联系人聊天记录
     *
     * @apiParam {String} account 微信帐号
     * @apiParam {String} talkerAccount 联系人帐号
     * @apiParam {Int} page 消息页码
     *
     * @apiSuccess {String} resultCode 接口响应码
     * @apiSuccess {String} message 接口查询结果信息
     * @apiSuccess {Object[]} data 结果集
     * @apiSuccess {String} data.id 聊天消息唯一编码
     * @apiSuccess {String} data.msg_svr_id 聊天记录唯一识别码
     * @apiSuccess {String} data.username 主体微信帐号
     * @apiSuccess {String} data.type 消息类型，"1" -> content  "3" -> "[图片]" "34" -> "[语音]"
     * "47" -> "[表情]"  "50" -> "[语音/视频通话]" "43" -> "[小视频]"
     * "49" -> "[分享]"
     * "48" -> content          // 位置信息
     * "10000" -> content       // 系统提示信息
     * else -> content          // 其他信息，包含红包、转账等
     * @apiSuccess {String} data.is_send 是否发送方，0接收 1发送
     * @apiSuccess {String} data.create_time 消息发送时间
     * @apiSuccess {String} data.talker 消息交互方微信帐号
     *
     * @apiSuccessExample Success-Response:
     * {"resultCode":"0000","message":"success","data":[{"id":2,"msg_svr_id":"3063552582981687280","username":"wxid_vtha1da6dbz022","type":1,"is_send":0,"create_time":"1548489957000","talker":"fenglican","content":"嗯嗯"},{"id":3,"msg_svr_id":"125559945857809338","username":"wxid_vtha1da6dbz022","type":49,"is_send":1,"create_time":"1548492598325","talker":"fenglican","content":"【分享-文件】EnMicroMsg.db.zip"},{"id":4,"msg_svr_id":"0","username":"wxid_vtha1da6dbz022","type":1,"is_send":1,"create_time":"1548568989531","talker":"fenglican","content":"hh"},{"id":5,"msg_svr_id":"0","username":"wxid_vtha1da6dbz022","type":1,"is_send":1,"create_time":"1548569122330","talker":"fenglican","content":"d"},{"id":6,"msg_svr_id":"3136254256605348198","username":"wxid_vtha1da6dbz022","type":1,"is_send":0,"create_time":"1548569122331","talker":"fenglican","content":"墨菲"},{"id":7,"msg_svr_id":"4061315901687656031","username":"wxid_vtha1da6dbz022","type":1,"is_send":0,"create_time":"1549870950000","talker":"fenglican","content":"http:\/\/192.168.3.1:8081\/platform\/chatRecord\/sync"},{"id":8,"msg_svr_id":"3114691078792353464","username":"wxid_vtha1da6dbz022","type":34,"is_send":0,"create_time":"1549884823000","talker":"fenglican","content":"http:\/\/oss.yi-insurance.com\/chat\/15501081755686.amr"},{"id":9,"msg_svr_id":"7831259487405146060","username":"wxid_vtha1da6dbz022","type":34,"is_send":1,"create_time":"1549884949168","talker":"fenglican","content":"http:\/\/oss.yi-insurance.com\/chat\/15501081767008.amr"},{"id":10,"msg_svr_id":"8869885757115957762","username":"wxid_vtha1da6dbz022","type":49,"is_send":0,"create_time":"1549885092000","talker":"fenglican","content":"【分享-链接】
     * <a href='https:\/\/m.toutiaocdn.com\/i6644350002439127555\/?iid=53435514383&app=news_article&timestamp=1547164435&group_id=6644350002439127555&tt_from=weixin_moments&utm_source=weixin_moments&utm_medium=toutiao_ios&utm_campaign=client_share&wxshare_count=2&from=timeline&isappinstalled=0&pbid=6645027629673448974'>程序员的快速开发框架：Github上 10 大优秀的开源后台控制面板<\/a>"},{"id":11,"msg_svr_id":"9165500064676313379","username":"wxid_vtha1da6dbz022","type":1,"is_send":0,"create_time":"1549885142000","talker":"fenglican","content":"我们的生活"},{"id":12,"msg_svr_id":"1420314565494712265","username":"wxid_vtha1da6dbz022","type":1,"is_send":1,"create_time":"1549938629204","talker":"fenglican","content":"[呲牙][呲牙]"},{"id":13,"msg_svr_id":"8129157629838587450","username":"wxid_vtha1da6dbz022","type":1,"is_send":1,"create_time":"1549938914192","talker":"fenglican","content":"123"},{"id":14,"msg_svr_id":"4524263175214165571","username":"wxid_vtha1da6dbz022","type":1,"is_send":0,"create_time":"1549938968000","talker":"fenglican","content":"456"},{"id":15,"msg_svr_id":"2447660149073224387","username":"wxid_vtha1da6dbz022","type":1,"is_send":0,"create_time":"1549939789000","talker":"fenglican","content":"[微笑]"},{"id":16,"msg_svr_id":"5624055251830559750","username":"wxid_vtha1da6dbz022","type":1,"is_send":0,"create_time":"1549939795000","talker":"fenglican","content":"[微笑][微笑]"},{"id":17,"msg_svr_id":"6114200115342524007","username":"wxid_vtha1da6dbz022","type":3,"is_send":0,"create_time":"1549940921000","talker":"fenglican","content":"http:\/\/oss.yi-insurance.com\/chat\/15501081769581.jpg"},{"id":18,"msg_svr_id":"7982630819781135450","username":"wxid_vtha1da6dbz022","type":3,"is_send":0,"create_time":"1549957678000","talker":"fenglican","content":"http:\/\/oss.yi-insurance.com\/chat\/15501081778350.jpg"},{"id":19,"msg_svr_id":"5889755452545731301","username":"wxid_vtha1da6dbz022","type":43,"is_send":0,"create_time":"1550054260000","talker":"fenglican","content":"http:\/\/oss.yi-insurance.com\/chat\/15501254361463.mp4"},{"id":20,"msg_svr_id":"2596162810443707945","username":"wxid_vtha1da6dbz022","type":1,"is_send":1,"create_time":"1550114877677","talker":"fenglican","content":"j"},{"id":21,"msg_svr_id":"3484114155027245227","username":"wxid_vtha1da6dbz022","type":47,"is_send":0,"create_time":"1550115027000","talker":"fenglican","content":"fenglican:0:0:8dc0f7788fb6c16965a6ca6fa7e450dd:
     * <msg>
     * <emoji fromusername = \"fenglican\" tousername = \"wxid_vtha1da6dbz022\" type=\"2\" idbuffer=\"media*#*0_0\" md5=\"8dc0f7788fb6c16965a6ca6fa7e450dd\" len = \"833026\" productid=\"\" androidmd5=\"8dc0f7788fb6c16965a6ca6fa7e450dd\" androidlen=\"833026\" s60v3md5 = \"8dc0f7788fb6c16965a6ca6fa7e450dd\" s60v3len=\"833026\" s60v5md5 = \"8dc0f7788fb6c16965a6ca6fa7e450dd\" s60v5len=\"833026\" cdnurl = \"http*#*\/\/emoji.qpic.cn\/wx_emoji\/wpcsIz5yx9dDEfbWhl24B47a1qZ7yNEVdAArYiaib4icR4uLpnUbSMd8JtnmSK526Z8\/\" designerid = \"\" thumburl = \"\" encrypturl = \"http*#*\/\/emoji.qpic.cn\/wx_emoji\/wpcsIz5yx9dDEfbWhl24B47a1qZ7yNEVdAArYiaib4icR5WVh4YqPk8b5N8AxY1fvch\/\" aeskey= \"8dc1422557e5740dedbd888e917623a4\" externurl = \"http*#*\/\/emoji.qpic.cn\/wx_emoji\/dNZHTLDIia9Zg5AFOpJ1APF7MRWxleZWRGpNcnnzvP6kGBOzwicsRYbuZoX1MS5Zdy\/\" externmd5 = \"0f827e10635aad6eca7c1327c6902a82\" width= \"240\" height= \"240\" tpurl= \"\" tpauthkey= \"\" attachedtext= \"\" attachedtextcolor= \"\" lensid= \"\" ><\/emoji>
     * <gameext type=\"0\" content=\"0\" ><\/gameext><\/msg>:0"},{"id":22,"msg_svr_id":"8570230139669941876","username":"wxid_vtha1da6dbz022","type":1,"is_send":0,"create_time":"1550115043000","talker":"fenglican","content":"没有山，我就是山"}]}
     * @apiSampleRequest platform/chatRecord/message
     */
    public function messageList()
    {
        return $this->chatRecordService->messageList(
            $this->queryBodyParameter($this->request, 'account'),
            $this->queryBodyParameter($this->request, 'talkerAccount'),
            $this->queryBodyParameter($this->request, 'page')
        );
    }

    /**
     * @api {POST} platform/chatRecord/accountOnlineMap 微信帐号在线状态 MAP
     * @apiGroup Platform
     * @apiVersion 1.0.0
     * @apiDescription 微信帐号在线状态 MAP
     *
     * @apiSuccess {String} resultCode 接口响应码
     * @apiSuccess {String} message 接口查询结果信息
     * @apiSuccess {Object} data 结果集
     *
     * @apiSuccessExample Success-Response:
     * {"resultCode":"0000","message":"success","data":{"fenglican":false,"wxid_vtha1da6dbz022":false}}
     *
     * @apiSampleRequest platform/chatRecord/accountOnlineMap
     */
    public function accountOnlineMap()
    {
        return $this->chatRecordService->accountOnlineStatusMap();
    }
}

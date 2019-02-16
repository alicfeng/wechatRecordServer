<?php
/**
 * Created by PhpStorm   User: AlicFeng   DateTime: 19-1-18 下午3:24
 */

namespace App\Enums;
/**
 * Class CodeEnum
 * 响应体code与message枚举
 */
class CodeEnum
{
    // base 成功 || 失败
    const SUCCESS = ['0000', 'success'];
    const FAIL    = ['9999', 'fail'];

    const DO_SERVER_ERROR  = ['9090', '服务异常'];
    const SYSTEM_UPGRADING = ['9998', '十分抱歉,系统正在升级中'];
    // 成功返回码
    const OKAY_CODE   = '0000';
    const FAILED_CODE = '9999';
    /*--------------1000---------------------*/
    // 缺少参数
    const Missing_Param = ['1001', '缺少参数'];
    // 参数为空
    const Param_Is_Empty = ['1002', '参数为空'];
    // 通讯异常
    const Communicate_Err = ['1003', '系统正在开小差, 请稍后再试!'];

    const SeqIng = ['1020', '正在处理中!'];

    // 合作商户ID不存在
    const Cooperators_Not_Exist = ['1004', '合作商户ID不存在'];

    // 参数值不是JSON格式
    const Param_Not_JSON = ['1005', '不是JSON格式'];

    // 公钥不正确或者加密有问题
    const Public_Key_Err = ['1006', '公钥不正确或者加密有问题'];

    // IP不在白名单
    const AWhile_List_Api = ['1007', 'IP不在白名单'];

    // application/json
    const Post_Content_Type = ['1008', '请使用Post - application/json'];

    // 参数为空或缺少
    const Param_Null_OR_Miss = ['1009', '参数为空或缺少'];

    // MySQL数据库异常
    const System_Err_MySQL = ['1010', 'MySQL数据库异常'];

    // 订单入库失败
    const Order_Insert_Err = ['1011', '抱歉!下单失败，请联系客服人员解决'];

    // 产品还未配置完成
    const Product_NULL = ['1012', '产品还未配置完成'];

    // 保存订单号异常
    const Save_OrderSn_Err = ['1013', '保存订单号异常'];

    // 获取支付链接异常
    const Get_Pay_URL_Err = ['1014', '获取支付链接异常'];

    // 您输入的被保人信息与保费试算信息不一致
    const UnderWriting_Message_Err = ['1015', '您输入的被保人信息与保费试算信息不一致'];

    // 计算保费异常
    const CalInsPrice_Err = ['1016', '计算保费异常'];

    // 数据异常
    const Data_Err = ['1017', '核保不通过'];

    // 产品编号未定义
    const Product_Undefined = ['1018', '产品编号未定义'];

    // 证件有效期类型有误
    const Ben_Certificate_Err = ['1021', '受益人年龄小于等于45岁，身份证有效期不能为长期'];

    // 重复下单
    const Repeat_Order = ['1022', '重复下单'];

    // 缺少参数/body | /header
    const MISS_REQUEST_CONTROLLER = ['1024', '缺少参数/body | /header'];

    // 订单相关信息不存在
    const Not_Found_Order = ['1023', '订单相关信息不存在'];

    // 参数规则校验未通过
    const Param_Format_Check_Denied = ['1024', '参数存在谬误，请检查输入'];

    // 核保不通过,核保超时
    const REQUEST_TIMEOUT = ['1025', "核保超时, 若您有任何疑问，可点<a href='https://tsb.yi-insurance.com/QRCode.html'>此咨询客服</a>(您的投保信息和错误提示已保存, 请放心咨询)"];

    /*--------------2000---------------------*/
    // 微信授权失败
    const Wechat_Auth_Err = ['2001', '微信授权失败'];

    // 请重新登录
    const Re_Login_Status = ['2002', '请重新登录'];

    // 手机验证码错误
    const Phone_Code_Wrong = ['2003', '手机验证码错误'];

    //体检未通过不能支付
    const Re_payStatus = ['1015', '未完成体检，暂时不能支付！'];

    //重复请求
    const Rsq_status = ['1016', '正在提交中请稍后'];

    //请求数据异常
    const Request_Data_Err = ['1019', '请求数据不合法'];

    // 银行卡异常
    const Bank_Error = ['1018', '银行卡异常'];

    // 签约失败
    const Bank_Sign_Exception = ['1020', '签约失败'];

    // 已经在线回访过了
    const Had_Online_Visit = ['1021', '已经在线回访过了'];

    // 回访失败
    const Online_Visit_Failed = ['1022', '回访失败'];

    // 订单号异常
    const Order_Exception = ['1022', '订单号异常'];

    // 保单号不存在
    const Policy_Error = ['1023', '保单号不存在'];

    // 待确认、待复核、体检已完成、体检已撤销不能发起体检撤销
    const CancelExamOrderNotAuth = ['1024', '待确认、待复核、体检已完成、体检已撤销不能发起体检撤销'];

    // 请求正在处理中, 请耐心等待
    const REQUEST_HANDLING = ['1026', '请求正在处理中, 请耐心等待'];

    // 支付中
    const Pay_Handling = ['0101', '支付处理中'];

    // 支付失败或超时
    const Pay_Failed = ['0102', '支付失败'];

    // 需要签约
    const Need_Sign = ['0103', '请输入银行短信验证码'];

    /*保险相关*/
    // 此套餐配置不存在 - 费率表不存在
    const RATE_CONFIG_NOT_EXIST = ['3001', '此套餐配置不存在'];

    // 正面识别成功
    const OCR_IDCARD_RIGHT_SUCCESS = ['1031', '正面识别成功'];

    // 反面识别成功
    const OCR_IDCARD_LEFT_SUCCESS = ['1032', '反面识别成功'];


    // 优惠活动相关
    const Invite_Promotions_Join_Failed      = ['4001', '参加活动失败!'];
    const Invite_Promotions_Union_Hash_Wrong = ['4002', 'unionHash异常'];
    const Scan_Card_Promotions_Failed        = ['4003', '激活优惠卡失败！'];
    const Order_Bind_Card_Failed             = ['4004', '订单使用优惠券失败'];

    // 视频点赞失败
    const Goods_Video_Love_Failed       = ['5001', '视频点赞失败!'];
    const Get_Goods_Video_Record_Failed = ['5002', '获取视频点赞记录失败!'];

    // 参数相关
    const Lack_Of_Needed_Param        = ['6001', '此请求缺少需要的参数!'];
    const Auth_Has_Been_Used_Before   = ['6002', '微信授权失败!'];
    const Auth_Failed_For_Some_Reason = ['6003', '利用 code 获取 openid 失败!'];

    /*金额相关*/
    // 提现金额过小
    const  WITHDRAWAL_SO_SMALL = ['7001', '提现金额过小'];

    /*官网相关*/
    const ARTICLE_NOT_FOUND = ['8001', '文章不存在'];
}
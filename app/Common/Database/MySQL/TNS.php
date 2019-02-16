<?php
/**
 * Created by PhpStorm   User: AlicFeng   DateTime: 18-11-27 下午3:33
 */

namespace App\Common\Database\MySQL;

class TNS
{
    const ARTICLE              = 'w_article';// 文章
    const ARTICLE_CLASS        = 'w_article_class';// 文章分类
    const ARTICLE_CLASS_BELONG = 'w_article_class_belong';// 文章分类所属

    const VIDEO              = 'w_video';// 视频
    const VIDEO_CLASS        = 'w_video_class';// 视频分类
    const VIDEO_CLASS_BELONG = 'w_video_class_belong';// 文章分类所属

    const WORKS         = 'w_works';// 著作
    const WORKS_VIDEO   = 'w_works_video';// 著作关联的视频
    const WORKS_ARTICLE = 'w_works_article';// 著作关联的文章

    const RESUME_DESIGNATION = 'w_resume_designation';// 简历专业称号
    const RESUME_EXPERIENCE  = 'w_resume_experience';// 简历工作经历
    const RESUME_EDUCATION   = 'w_resume_education';// 简历教育背景

    const ENTREPRENEURIAL_PROCESS = 'w_entrepreneurial_process';// 创业历程

    const NEWS = 'w_news';// 媒体报道

    // 微信监控
    const O_WECHAT_ACCOUNT = 'o_wechat_account';//微信账号
    const O_WECHAT_CONTACT = 'o_wechat_contact';//微信联系人
    const O_WECHAT_MESSAGE = 'o_wechat_message';//微信聊天记录
}
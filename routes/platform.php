<?php
/**
 * Created by AlicFeng at 2019-02-16 15:48
 */

use \App\Common\Router\InterfaceAlias;

/*platform interface*/
Route::group(['prefix' => 'chatRecord'], function () {
    // 微信信息上传同步
    Route::post('/sync', 'Platform\ChatRecordController@sync')->name(InterfaceAlias::CHAT_RECORD_SYNC);
    // 获取微信账号列表
    Route::post('/account', 'Platform\ChatRecordController@accountList')->name(InterfaceAlias::CHAT_RECORD_ACCOUNT);
    // 获取微信账号列表
    Route::post('/accountOnlineMap', 'Platform\ChatRecordController@accountOnlineMap')->name(InterfaceAlias::CHAT_RECORD_ACCOUNT_ONLINE_MAP);
    // 获取微信联系人列表
    Route::post('/contact', 'Platform\ChatRecordController@contactList')->name(InterfaceAlias::CHAT_RECORD_CONTACT);
    // 联系人聊天记录
    Route::post('/message', 'Platform\ChatRecordController@messageList')->name(InterfaceAlias::CHAT_RECORD_MESSAGE);
});

/*file interface*/
Route::group(['prefix' => 'file'], function () {
    // 单文件上传
    Route::post('upload', 'Platform\FileController@upload');
});
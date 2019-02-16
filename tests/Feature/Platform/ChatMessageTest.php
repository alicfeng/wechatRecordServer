<?php
/**
 * Created by AlicFeng at 2019-02-16 16:58
 */

namespace Tests\Feature\Platform;


use Tests\TestCase;

class ChatMessageTest extends TestCase
{
    public function testQueryAccount()
    {
        $apiRoute    = '/platform/chatRecord/account';
        $requestData = [
            'header' => [
                'companyId' => 'samego'
            ],
            'body'   => [

            ]
        ];
        $this->postJson($apiRoute, $requestData)->assertStatus(200);
    }


    // 测试账号在线状态
    public function testQueryAccountOnlineMap()
    {
        $apiRoute    = '/platform/chatRecord/accountOnlineMap';
        $requestData = [
            'header' => [
                'companyId' => 'samego'
            ],
            'body'   => [

            ]
        ];
        $this->postJson($apiRoute, $requestData)->assertStatus(200);
    }

    // 获取账号联系人
    public function testQueryContact()
    {
        $apiRoute    = '/platform/chatRecord/contact';
        $requestData = [
            'header' => [
                'companyId' => 'samego'
            ],
            'body'   => [
                'account' => 'alicfeng'
            ]
        ];
        $this->postJson($apiRoute, $requestData)->assertStatus(200);
    }

    // 获取聊天记录
    public function testQueryChatMessage()
    {
        $apiRoute    = '/platform/chatRecord/message';
        $requestData = [
            'header' => [
                'companyId' => 'samego'
            ],
            'body'   => [
                'account'       => 'alicfeng',
                'talkerAccount' => 'alicfeng',
                'page'          => 0
            ]
        ];
        $this->postJson($apiRoute, $requestData)->assertStatus(200);
    }
}
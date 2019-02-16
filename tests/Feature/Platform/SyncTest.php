<?php
/**
 * Created by AlicFeng at 2019-02-16 16:42
 */

namespace Tests\Featire\Platform;


use Tests\TestCase;

class SyncTest extends TestCase
{
    const API_ROUTE = '/platform/chatRecord/sync';
    // 同步账号
    public function testAccountSync()
    {
        $requestData = [
            'header' => [
                'companyId' => 'samego'
            ],
            'body'   => [
                'type'     => 1,
                'username' => 'alicfeng',
                'message'  => [
                    'nickname' => 'AlicFeng'
                ]
            ]
        ];
        $resp        = $this->postJson(self::API_ROUTE, $requestData);
        $trueRet     = [
            'resultCode' => '0000',
            'message'    => 'success',
            'data'       => '',
        ];
        $resp->assertStatus(200)->assertJson($trueRet);
    }

    // 同步联系人
    public function testContactSync()
    {
        $requestData = [
            'header' => [
                'companyId' => 'samego'
            ],
            'body'   => [
                'type'     => 2,
                'username' => 'alicfeng',
                'message'  => [
                    [
                        'username' => '星期八',
                        'nickname' => 'AlicFeng'
                    ]
                ]
            ]
        ];
        $resp        = $this->postJson(self::API_ROUTE, $requestData);
        $trueRet     = [
            'resultCode' => '0000',
            'message'    => 'success',
            'data'       => '',
        ];
        $resp->assertStatus(200)->assertJson($trueRet);
    }


    // 同步聊天记录
    public function testChatMessageSync()
    {
        $requestData = [
            'header' => [
                'companyId' => 'samego'
            ],
            'body'   => [
                'type'     => 3,
                'username' => 'alicfeng',
                'message'  => [
                    [
                        'msg_svr_id'  => '6610603480358184263',
                        'talker'      => 'weixin',
                        'content'     => '欢迎你再次回到微信。如果你在使用过程中有任何的问题或建议，记得给我发信反馈哦。',
                        'type'        => '1',
                        'create_time' => '1548485174000',
                        'is_send'     => '0',
                    ]
                ]
            ]
        ];
        $resp        = $this->postJson(self::API_ROUTE, $requestData);
        $trueRet     = [
            'resultCode' => '0000',
            'message'    => 'success',
            'data'       => '',
        ];
        $resp->assertStatus(200)->assertJson($trueRet);
    }
}
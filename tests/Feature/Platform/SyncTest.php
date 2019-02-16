<?php
/**
 * Created by AlicFeng at 2019-02-16 16:42
 */

namespace Tests\Featire\Platform;


use Tests\TestCase;

class SyncTest extends TestCase
{
    // 文章列表
    public function testArticleListRoute()
    {
        $apiRoute = '/platform/chatRecord/sync';
        $response = $this->getJson($apiRoute);
        $response->assertStatus(200);
    }
}
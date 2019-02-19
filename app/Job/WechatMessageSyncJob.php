<?php
/**
 * Created by PhpStorm AlicFeng 2018\6\26 0026 12:55
 */

namespace App\Job;


use App\Service\Platform\ChatRecordService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Log;

class WechatMessageSyncJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public    $tries = 5;
    protected $interface;
    protected $username;
    protected $message;

    public function __construct(int $interface, string $username, array $message)
    {
        $this->interface = $interface;
        $this->message   = $message;
        $this->username  = $username;
    }

    public function handle(ChatRecordService $chatRecordService)
    {
        Log::info('WechatMessageMonitorJob queue interface ' . $this->interface);
        $chatRecordService->syncHandler($this->interface, $this->username, $this->message);
    }
}
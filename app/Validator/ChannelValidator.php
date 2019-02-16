<?php
/**
 * Created by PhpStorm   User: AlicFeng   DateTime: 18-9-3 下午5:07
 */

namespace App\Validator;


use App\Repositories\ChannelRepository;

class ChannelValidator
{
    /**
     * 核保判断订单的有效性
     * @param string $certificateNumber 投保人证件号
     * @param string $channel 一级渠道号
     * @param string $subchn 二级渠道号
     * @return array
     */
    public static function underwritingChannel($certificateNumber, $channel, $subchn)
    {
        $channelRepository = new ChannelRepository;
        if (!$channelRepository->validChannel($channel, $subchn) || $channelRepository->validSelfBuy($certificateNumber, $subchn)) {
            return ['tsb', 'menu'];
        }
        return [$channel, $subchn];
    }
}
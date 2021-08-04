<?php

namespace hquanmr\HuapusPolyv\Service;

use hquanmr\HuapusPolyv\Core\BaseApi;

class Channels extends BaseApi
{
    const   CREATE = 'live/v3/channel/basic/create/';
    const   RECORD = 'live/v3/channel/record/convert/';
    const   RECORDList = 'live/v2/channels/';
    const   PLAYBACKADD  = '/live/v3/channel/playback/add/';
    const   PLAYBACKSET  = '/live/v3/channel/playback/set-setting/';

    public function create($data)
    {
        $url  =  self::CREATE . '?' . http_build_query(['isSign' => 1]);
        return static::parseJson($this->apiJson($url, $data));
    }

    public function recordConvert($urlParm)
    {
        $url  =  self::RECORD . '?' . http_build_query(array_merge(['isSign' => 1], $urlParm));

        return static::parseJson($this->apiJson($url, []));
    }

    public function getRecordFiles($urlParm, $channelId)
    {
        $url  =  self::RECORDList . $channelId . '/recordFiles/?';
        return static::parseJson($this->apiGet($url, array_merge(['isSign' => 1], $urlParm))); //get 是直接写入到里面
    }


    public function playbackadd($urlParm)
    {
        $url  =  self::PLAYBACKADD . '?' . http_build_query(array_merge(['isSign' => 1], $urlParm));
        return static::parseJson($this->apiJson($url, array_merge(['isSign' => 1], $urlParm)));
    }
    public function playbackset($urlParm)
    {
        $url  =  self::PLAYBACKSET . '?' . http_build_query(array_merge(['isSign' => 1], $urlParm));
        return static::parseJson($this->apiJson($url, array_merge(['isSign' => 1], $urlParm)));
    }
}

<?php

namespace hquanmr\HuapusPolyv\Service;

use hquanmr\HuapusPolyv\Core\BaseApi;

class Renovation extends BaseApi
{
    const   ADD = 'live/v3/common/upload-image';
    const   UPDATE = 'live/v2/channels/';

    //暂时没有启用
    public function upload($urlParm, $data)
    {
        $url  =  self::ADD . '?' . http_build_query(array_merge(['isSign' => 1], $urlParm));
        return static::parseJson($this->apiUpload($url,$data));
    }

    public function update($urlParm, $channelId)
    {
        $url  =  self::UPDATE .$channelId. '/update?' . http_build_query(array_merge(['isSign' => 1], $urlParm));
        return static::parseJson($this->apiJson($url,[]));
    }
  
}

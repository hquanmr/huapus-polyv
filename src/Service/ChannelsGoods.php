<?php

namespace hquanmr\HuapusPolyv\Service;

use hquanmr\HuapusPolyv\Core\BaseApi;

class ChannelsGoods extends BaseApi
{
    const   ADD = 'live/v3/channel/product/add';
    const   UPDATE = 'live/v3/channel/product/update';
    const   DEL = 'live/v3/channel/product/delete';
  


    public function create($urlParm, $data)
    {

        $url  =  self::ADD . '?' . http_build_query(array_merge(['isSign' => 1], $urlParm));
        return static::parseJson($this->apiJson($url, $data));
    }

    public function update($urlParm, $data)
    {

        $url  =  self::UPDATE . '?' . http_build_query(array_merge(['isSign' => 1], $urlParm));
        return static::parseJson($this->apiJson($url, $data));
    }

    public function delete($urlParm, $data = [])
    {

        $url  =  self::DEL . '?' . http_build_query(array_merge(['isSign' => 1], $urlParm));
        return static::parseJson($this->apiJson($url, $data));
    }
}

<?php

namespace hquanmr\HuapusPolyv;

use GuzzleHttp\ClientInterface;
use Leo108\SDK\SDK;
use Psr\Log\LoggerInterface;
use hquanmr\HuapusPolyv\Core\Exceptions\InvalidArgumentException;
use hquanmr\HuapusPolyv\Service\Channels;
use hquanmr\HuapusPolyv\Service\ChannelsGoods;
use hquanmr\HuapusPolyv\Service\Renovation;
class Application  extends SDK
{

    /**
     * @var string
     */
    public  $appId;

    /**
     * @var string
     */
    public $userId;

    /**
     * @var string
     */
    public $appSecret;

    public  function __construct(array $config = [], LoggerInterface $logger = null, ClientInterface $httpClient = null)
    {
        parent::__construct($config, $httpClient, $logger);
        $this->parseConfig($config);
    }
    public function parseConfig(array $config)
    {

        if (!isset($config['appId'])) {
            throw new InvalidArgumentException('缺少 appId 参数');
        }
        $this->appId =  $config['appId'];

        if (!isset($config['appSecret'])) {
            throw new InvalidArgumentException('缺少 appSecret 参数');
        }
        $this->appSecret =  $config['appSecret'];

        if (!isset($config['userId'])) {
            throw new InvalidArgumentException('缺少 userId 参数');
        }
        $this->userId =  $config['userId'];
        $this->config = $config;
    }

    protected function getApiMap()
    {
        return [
            'channels' => Channels::class,
            'channelsGoods'=>ChannelsGoods::class,
            'renovation'=>Renovation::class,
            
        ];
    }
}

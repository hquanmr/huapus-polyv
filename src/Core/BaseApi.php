<?php

namespace hquanmr\HuapusPolyv\Core;

use GuzzleHttp\Middleware;
use Leo108\SDK\AbstractApi;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LogLevel;

use hquanmr\HuapusPolyv\Core\Middleware\AttachParamMiddleware;
use hquanmr\HuapusPolyv\Core\Middleware\CheckApiResponseMiddleware;
use hquanmr\HuapusPolyv\Application;


class BaseApi extends AbstractApi
{

    /**
     * @var application
     */
    protected $sdk;

    /**
     * @return application
     */
    protected function getSDK()
    {
        return $this->sdk;
    }


    protected function getFullApiUrl($api)
    {
        return 'http://api.polyv.net/' . ltrim($api, '/');
    }

    /**
     * @param ResponseInterface $response
     * @return array|null
     */
    public static function parseJson(ResponseInterface $response)
    {
        return \GuzzleHttp\json_decode($response->getBody(), true, 512, JSON_BIGINT_AS_STRING);
    }


    /**生成签名
     * @return $sign
     */
    public static function getSign($params, $app)
    {
        ksort($params, SORT_ASC);
        $str = $app->appSecret;
        foreach ($params as $key => $value) {
            $str .= $key;
            $str .= $value;
        }
        return strtoupper(md5($str .  $app->appSecret));
    }
    /**
     * @return array
     */
    protected function getHttpMiddleware()
    {
        return array_filter([
            $this->getCheckApiResponseMiddleware(),
            $this->getRetryMiddleware(),
            $this->getAttachMiddleware(),
            $this->getLogRequestMiddleware(),
        ]);
    }


    /**
     * @return CheckApiResponseMiddleware
     */
    protected function getCheckApiResponseMiddleware()
    {
        return new CheckApiResponseMiddleware(true, [static::class, 'parseJson']);
    }
    /**
     * @return callable
     */
    protected function getRetryMiddleware()
    {
        return Middleware::retry(function ($retries, RequestInterface $request, ResponseInterface $response = null) {
            if ($retries >= $this->getSDK()->getConfig('api_retry', 0)) {
                return false;
            }

            if (!$response || $response->getStatusCode() != 200) {
                return true;
            }
            $ret = static::parseJson($response);
            if ($ret['ErrorCode'] != 0) {
                return true;
            }

            return false;
        });
    }
    public function getAttachMiddleware()
    {
        $app = $this->sdk;
        return new AttachParamMiddleware(function (RequestInterface $request) use ($app) {
            return $this->attachParam($app, $request);
        });
    }

    /**
     * 在请求的 url 后加上请求参数 
     *
     * @param string           $app
     * @param RequestInterface $request
     * @param bool             $cache
     *
     * @return RequestInterface
     */
    protected  function attachParam($app, RequestInterface $request, $cache = true)
    {

        $params                 = \GuzzleHttp\Psr7\parse_query($request->getUri()->getQuery());
        //是否需要签名
        if ($params['isSign']) { 
            $timestamp = time() * 1000;
            $config = [
                'appId' => $app->appId,
                'timestamp' => $timestamp
            ];
            unset($params['isSign']);
            $params = array_merge($params,$config);
            $sign = $this->getSign($params, $app);
            $params['sign'] = $sign;
        }
 
        $uri             = $request->getUri()->withQuery(http_build_query($params));
        return $request->withUri($uri);
    }
    /**
     * @return callable
     */
    protected function getLogRequestMiddleware()
    {
        $logger    = $this->getSDK()->getLogger();

        $formatter = new MessageFormatter($this->getSDK()->getConfig('log.format', MessageFormatter::DEBUG));
        $logLevel  = $this->getSDK()->getConfig('log.level', LogLevel::INFO);

        return Middleware::log($logger, $formatter, $logLevel);
    }
}

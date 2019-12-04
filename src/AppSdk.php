<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2019-12-03
 * Time: 16:52
 */

namespace JoseChan\App\Sdk;



use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Uri;
use JoseChan\Base\Sdk\BaseSdk;

/**
 * 应用Sdk
 * Class AppSdk
 * @package JoseChan\App\Sdk
 */
class AppSdk extends BaseSdk
{
    
    const DOMAIN = "http://127.0.0.1:8001";
    
    public function __construct(Client $client, $config)
    {
        parent::__construct($client, $config);
    }

    /**
     * 获取uri对象
     * @return Uri
     */
    private function getUri()
    {
        $scheme = $this->getConfig("scheme", "http");
        $host = $this->getConfig("host", "127.0.0.1");
        $port = $this->getConfig("port", "80");

        return (new Uri())->withScheme($scheme)->withHost($host)->withPort($port);
    }

    /**
     * 获取应用token
     * @param int $app_id
     * @param String $app_secret
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getToken(int $app_id, String $app_secret)
    {

        $uri = $this->getUri();

        $data = [
            "app_id" => $app_id,
            "app_secret" => $app_secret
        ];

        $uri = $uri->withPath("/api/token/get")
            ->withQuery(http_build_query($data));


        return $this->client->request("GET", (string)$uri);
    }
}
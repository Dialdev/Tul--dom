<?php

namespace Citadel\XpsUpdateClient\Client\Api;


use Bitrix\Main\Diag\Debug;
use Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Application;
use \Bitrix\Main\Web\Uri;
use \Bitrix\Main\Web\HttpClient;

Loc::loadMessages(__FILE__);


class Http
{
    protected $http;


    function __construct()
    {
        $this->http = new HttpClient([
            "compress" => true,
            "disableSslVerification" => true,
        ]);
    }


    /**
     * @param $value
     */
    public function setUserAgent($value)
    {
        $this->http->setHeader('User-Agent', $value);
    }


    /**
     * @param $name
     * @param $value
     */
    public function setHeader($name, $value)
    {
        $this->http->setHeader($name, $value);
    }


    /**
     * @param $timeout int
     */
    public function setTimeout($timeout)
    {
        $this->http->setStreamTimeout($timeout);
    }


    /**
     * @param $connect_timeout int
     */
    public function setConnectTimeout($connect_timeout)
    {
        $this->http->setTimeout($connect_timeout);
    }


    /**
     * @param $token string
     */
    public function setTokenAuthorization($token)
    {
        $this->http->setHeader('Authorization-Token', $token);
    }


    /**
     * @param $method
     * @param $url string
     * @param null $data
     * @return bool
     */
    public function query($method, $url, $data = null)
    {
        $response = $this->http->query($method, $url, $data);

        return $response ? $this->http->getResult() : false;
    }


    /**
     * @return array
     */
    public function getError()
    {
        return $this->http->getError();
    }


    /*
     * @return int
     */
    public function getStatus()
    {
        return $this->http->getStatus();
    }


    /**
     * @return array
     */
    public function getHeaders()
    {
        $headers = [];

        foreach ($this->http->getHeaders()->toArray() as $ar)
        {
            $headers[$ar['name']] = $ar['values'][0];
        }

        return $headers;
    }

}
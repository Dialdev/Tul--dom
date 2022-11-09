<?php

namespace Citadel\XpsUpdateClient\Client\Api;


use Bitrix\Main\Diag\Debug;
use Bitrix\Main\Localization\Loc;
use Citadel\XpsUpdateClient;


Loc::loadMessages(__FILE__);


abstract class Api
{
    const CONNECT_TIMEOUT = 10;
    const TIMEOUT = 30;

    protected $httpClient;
    protected $apiUrl;
    protected $errors = [];


    function __construct($url)
    {
        $client_name = XpsUpdateClient\Options::getValue("HTTP_CLIENT");

        $controller = __NAMESPACE__ . '\\' . ucfirst(strtolower($client_name));

        if ($controller && class_exists($controller))
        {
            $this->httpClient = new $controller;
        }
        else
        {
            $this->httpClient = new Http();
        }

        $this->setTimeout(self::TIMEOUT);
        $this->setConnectTimeout(self::CONNECT_TIMEOUT);
        $this->setHeader('Content-Type',  'application/json; charset=utf-8');
        $this->setHeader('Accept',  'text/json');
        $this->setUserAgent(isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'Curl/PHP ' . PHP_VERSION);

        $this->apiUrl = rtrim($url, "/");
    }

    /**
     * @param $value
     */
    public function setUserAgent($value)
    {
        $this->httpClient->setUserAgent($value);
    }


    /**
     * @param $name
     * @param $value
     */
    public function setHeader($name, $value)
    {
        $this->httpClient->setHeader($name, $value);
    }


    /**
     * @param $timeout int
     */
    public function setTimeout($timeout)
    {
        $this->httpClient->setTimeout($timeout);
    }


    /**
     * @param $connect_timeout int
     */
    public function setConnectTimeout($connect_timeout)
    {
        $this->httpClient->setConnectTimeout($connect_timeout);
    }


    /**
     * @param $token
     * @return void
     */
    public function setTokenAuthorization($token)
    {
        return $this->httpClient->setTokenAuthorization(trim($token));
    }


    /**
     * @param $url
     * @return void
     */
    public function setApiUrl($url)
    {
        return $this->httpClient->setApiUrl($url);
    }


    /**
     * @param $method
     * @param $url
     * @param null $data
     * @return bool|mixed
     * @throws \Exception
     */
    public function query($method, $url, $data = null)
    {
        $this->errors = [];
        $result = $this->httpClient->query($method, $this->apiUrl . $url, $data);

        if (!empty($this->httpClient->getError()))
        {
            $this->errors[] = Loc::getMessage(
                "CLIENT_API_SERVER_ERRORS",
                [
                    '#URL#' => $this->apiUrl,
                    "#ERRORS#" => implode('", "', $this->httpClient->getError())
                ]
            );
        }
        else
        {
            if ($this->getStatus() == 403)
            {
                $this->errors[] = Loc::getMessage(
                    "CLIENT_API_SERVER_FORBIDDEN",
                    [
                        '#URL#' => $this->apiUrl,
                    ]
                );
            }
            elseif (strpos($this->getHeaders()['Content-Type'], 'application/json') !== false)
            {
                $result = json_decode($result, true);

                if (!$result)
                {
                    $this->errors[] = Loc::getMessage("CLIENT_API_SERVER_NOT_FOUND", ['#URL#' => $this->apiUrl]);
                }
                else
                {
                    if (isset($result['error']) && strlen($result['error']) > 0)
                    {
                        $this->errors[] = Loc::getMessage(
                            "CLIENT_API_SERVER_ERRORS",
                            [
                                '#URL#' => $this->apiUrl,
                                "#ERRORS#" => $result['error']
                            ]
                        );
                    }
                }
            }
            else
            {
                $this->errors[] = Loc::getMessage("CLIENT_API_SERVER_NOT_FOUND", ['#URL#' => $this->apiUrl]);
            }
        }

        if (!empty($this->errors))
        {
            throw new \Exception(join("\n", $this->errors));
        }

        return $result['result'];
    }


    /**
     * @return array
     */
    public function getError()
    {
        return $this->errors;
    }


    /*
     * @return int
     */
    public function getStatus()
    {


        return $this->httpClient->getStatus();
    }


    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->httpClient->getHeaders();
    }

}
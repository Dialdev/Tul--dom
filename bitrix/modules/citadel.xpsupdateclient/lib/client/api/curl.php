<?php

namespace Citadel\XpsUpdateClient\Client\Api;


use Bitrix\Main\Diag\Debug;
use Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Application;

Loc::loadMessages(__FILE__);


class Curl
{
    protected $reqHeaders = array();
    protected $resHeaders = array();
    protected $referer;
    protected $user_agent;
    protected $options = array();
    protected $error = [];
    protected $request;
    protected $status;


    function __construct()
    {
    }


    /**
     * @param $value
     */
    public function setUserAgent($value)
    {
        $this->user_agent = $value;
    }


    /**
     * @param $name
     * @param $value
     */
    public function setHeader($name, $value)
    {
        $this->reqHeaders[$name] = $value;
    }


    /**
     * @param $timeout int
     */
    public function setTimeout($timeout)
    {
        $this->options[CURLOPT_TIMEOUT] = $timeout;
    }


    /**
     * @param $connect_timeout int
     */
    public function setConnectTimeout($connect_timeout)
    {
        $this->options[CURLOPT_CONNECTTIMEOUT] = $connect_timeout;
    }


    /**
     * @param $token string
     */
    public function setTokenAuthorization($token)
    {
        $this->reqHeaders['Authorization-Token'] = $token;
    }


    /**
     * Makes an HTTP request of the specified $method to a $url with an optional array or string of $vars
     *
     * Returns a CurlResponse object if the request was successful, false otherwise
     *
     * @param string $method
     * @param string $url
     * @param array|string $vars
     * @return string
     **/
    public function query($method, $url, $vars = null)
    {
        $this->error = [];
        $this->resHeaders = [];
        $this->status = 0;

        $this->request = curl_init();

        if (is_array($vars))
        {
            $vars = http_build_query($vars, '', '&');
        }

        switch (strtoupper($method)) {
            case 'HEAD':
                curl_setopt($this->request, CURLOPT_NOBODY, true);
                break;

            case 'GET':
                curl_setopt($this->request, CURLOPT_HTTPGET, true);

                if (!empty($vars))
                {
                    $url .= ((stripos($url, '?') !== false) ? '&' : '?') . $vars;
                }

                break;

            case 'POST':
                curl_setopt($this->request, CURLOPT_POST, true);
                break;

            default:
                curl_setopt($this->request, CURLOPT_CUSTOMREQUEST, $method);
        }


        $this->set_request_options($url, $vars);
        $response = curl_exec($this->request);

        if (!$response)
        {
            $this->error[] = curl_error($this->request) . ' (' . curl_errno($this->request) . ')';
        }
        else
        {
            $header_size = curl_getinfo($this->request, CURLINFO_HEADER_SIZE);
            $headers = trim(substr($response, 0, $header_size));
            $response = trim(substr($response, $header_size));
            $this->status = curl_getinfo($this->request, CURLINFO_HTTP_CODE);

            foreach (explode("\n", $headers) as $i => $line)
            {
                $pos = intval(strpos($line, ":"));
                $this->resHeaders[trim(substr($line, 0, $pos == 0 ? strlen($line) : $pos))] = trim(substr($line, $pos == 0 ? $pos : $pos + 1));
            }
        }

        curl_close($this->request);

        return $response;
    }


    /**
     * @return array
     */
    public function getError()
    {
        return $this->error;
    }


    /*
     * @return int
     */
    public function getStatus()
    {
        return intval($this->status);
    }


    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->resHeaders;
    }


    /**
     * Sets the CURLOPT options for the current request
     *
     * @param string $url
     * @param string $vars
     * @return void
     * @access protected
     **/
    protected function set_request_options($url, $vars)
    {
        curl_setopt($this->request, CURLOPT_URL, $url);

        if (!empty($vars))
        {
            curl_setopt($this->request, CURLOPT_POSTFIELDS, $vars);
        }

        if ($this->user_agent)
        {
            curl_setopt($this->request, CURLOPT_USERAGENT, $this->user_agent);
        }

        // Set some default CURL options
        curl_setopt($this->request, CURLOPT_HEADER, true);
        curl_setopt($this->request, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->request, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->request, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($this->request, CURLOPT_FOLLOWLOCATION, true);

        // Set any custom CURL options
        foreach ($this->options as $option => $value)
        {
            curl_setopt($this->request, $option, $value);
        }

        // Set CURL headers
        $headers = array();

        foreach ($this->reqHeaders as $key => $value)
        {
            $headers[] = $key.': '.$value;
        }

        curl_setopt($this->request, CURLOPT_HTTPHEADER, $headers);
    }

}
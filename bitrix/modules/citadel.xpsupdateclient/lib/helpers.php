<?php

namespace Citadel\XpsUpdateClient;

use Citadel\XpsUpdateClient\Options;
use Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Application;

Loc::loadMessages(__FILE__);


class Helpers
{
    public static function getAvailableMethods()
    {
        return ["GET", "PUT", "PATCH", "POST", "DELETE", "OPTIONS"];
    }


    public static function generateToken()
    {
        $token = md5(time());
        $token = str_split($token, 8);
        $token = implode('-', $token);

        return $token;
    }


    public static function log($log, $from = "")
    {
        if (Options::getValue('USE_LOG') == 'Y')
        {
            \Bitrix\Main\Diag\Debug::dumpToFile($log, ConvertTimeStamp(time(), 'FULL') . " - " . $from, str_replace('.', '-' . date('Y-m-d') . '.', trim(Options::getValue('LOG_PATH'), "/")));
        }
    }

    public static function getServerProtocol()
    {
        return Application::getInstance()->getContext()->getServer()->getServerPort() == 443 ? 'https://' : 'http://';
    }

}
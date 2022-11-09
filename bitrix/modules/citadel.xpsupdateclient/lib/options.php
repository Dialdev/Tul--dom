<?php

namespace Citadel\XpsUpdateClient;

use Bitrix\Main\Config\Option;
use Bitrix\Main\Context;


class Options
{
    const MODULE_ID = 'citadel.xpsupdateclient';


    public static function save($data)
    {
        $defaults = Option::getDefaults(self::getModuleId());

        foreach ($defaults as $def_code => $def_val)
        {
            if (isset($data[$def_code]))
            {
                $val = isset($data[$def_code]) ? $data[$def_code] : $def_val;
                Option::set(self::getModuleId(), $def_code, $val, self::getSiteId());
            }
        }

        return true;
    }

    public static function restore()
    {
        Option::delete(self::getModuleId());

        return true;
    }


    public static function getValue($option)
    {
        return Option::get(self::getModuleId(), $option, '', self::getSiteId());
    }


    public static function getModuleId()
    {
        return self::MODULE_ID;
    }


    private static function getSiteId()
    {
        return false;

        //
        // multi sites not supported
        //
        //$aDefaultLang = \CLang::GetList($by, $order, Array("DEFAULT" => "Y"))->Fetch();
        //return (Context::getCurrent()->getSite()) ? Context::getCurrent()->getSite() : ($aDefaultLang['LID'] ? $aDefaultLang['LID'] : 's1');
    }
}
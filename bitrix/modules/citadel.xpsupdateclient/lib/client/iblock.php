<?php

namespace Citadel\XpsUpdateClient\Client;


use Bitrix\Main\Localization\Loc;


Loc::loadMessages(__FILE__);


class Iblock
{
    /**
     * @return mixed
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public static function getIblocks()
    {
        static $aResult;

        if ($aResult)
        {
            return $aResult;
        }

        $rsTypes = \Bitrix\Iblock\TypeTable::getList([
            'select' => ['*', 'LANG_MESSAGE.NAME'],
            'order' => [
                'SORT' => 'ASC'
            ]
        ]);

        while ($aType = $rsTypes->fetch())
        {
            $aResult['TYPES'][$aType['ID']] = $aType;
            $aResult['TYPES'][$aType['ID']]['NAME'] = $aType['IBLOCK_TYPE_LANG_MESSAGE_NAME'];
        }


        $rsIBlocks = \Bitrix\Iblock\IblockTable::getList([
            'select' => [
                '*'
            ],
            "filter" => [
                "ACTIVE" => "Y"
            ],
            'order' => [
                'SORT' => 'ASC',
                'NAME' => 'ASC',
            ]
        ]);

        while ($aIBlock = $rsIBlocks->fetch())
        {
            $aIBlock['PROPERTIES'] = self::getIblockProperties($aIBlock['ID']);
            $aResult['IBLOCKS'][$aIBlock['ID']] = $aIBlock;

            foreach ($aIBlock['PROPERTIES'] as $aProperty)
            {
                $aResult['PROPERTIES'][] = $aProperty;
            }
        }

        return $aResult;
    }


    public static function getIblockProperties($iblock_id)
    {
        $aProperties = [
            "NAME" => [
                "ID" => "NAME",
                "CODE" =>  "NAME",
                "NAME" => Loc::getMessage("IBLOCK_NAME_TITLE"),
                "IBLOCK_ID" => $iblock_id,
                "PROPERTY_TYPE" => 'S',
                "PROPERTY_IS_FIELD" => true,
                "PROPERTY_CAN_BE_KEY" => true,
                "PROPERTY_SYNC_ALLOWED" => true,
            ],
            "CODE" => [
                "ID" => "CODE",
                "CODE" =>  "CODE",
                "NAME" => Loc::getMessage("IBLOCK_CODE_TITLE"),
                "IBLOCK_ID" => $iblock_id,
                "PROPERTY_TYPE" => 'S',
                "PROPERTY_IS_FIELD" => true,
                "PROPERTY_CAN_BE_KEY" => true,
                "PROPERTY_SYNC_ALLOWED" => true,
            ],
            "PREVIEW_TEXT" => [
                "ID" => "PREVIEW_TEXT",
                "CODE" =>  "PREVIEW_TEXT",
                "NAME" => Loc::getMessage("IBLOCK_PREVIEW_TEXT_TITLE"),
                "IBLOCK_ID" => $iblock_id,
                "PROPERTY_TYPE" => 'S',
                "PROPERTY_IS_FIELD" => true,
                "PROPERTY_CAN_BE_KEY" => false,
                "PROPERTY_SYNC_ALLOWED" => true,
            ],
            "DETAIL_TEXT" => [
                "ID" => "DETAIL_TEXT",
                "CODE" =>  "DETAIL_TEXT",
                "NAME" => Loc::getMessage("IBLOCK_DETAIL_TEXT_TITLE"),
                "IBLOCK_ID" => $iblock_id,
                "PROPERTY_TYPE" => 'S',
                "PROPERTY_IS_FIELD" => true,
                "PROPERTY_CAN_BE_KEY" => false,
                "PROPERTY_SYNC_ALLOWED" => true,
            ],
            "PREVIEW_PICTURE" => [
                "ID" => "PREVIEW_PICTURE",
                "CODE" =>  "PREVIEW_PICTURE",
                "NAME" => Loc::getMessage("IBLOCK_PREVIEW_PICTURE_TITLE"),
                "IBLOCK_ID" => $iblock_id,
                "PROPERTY_TYPE" => 'F',
                "PROPERTY_IS_FIELD" => true,
                "PROPERTY_CAN_BE_KEY" => false,
                "PROPERTY_SYNC_ALLOWED" => true,
            ],
            "DETAIL_PICTURE" => [
                "ID" => "DETAIL_PICTURE",
                "CODE" =>  "DETAIL_PICTURE",
                "NAME" => Loc::getMessage("IBLOCK_DETAIL_PICTURE_TITLE"),
                "IBLOCK_ID" => $iblock_id,
                "PROPERTY_TYPE" => 'F',
                "PROPERTY_IS_FIELD" => true,
                "PROPERTY_CAN_BE_KEY" => false,
                "PROPERTY_SYNC_ALLOWED" => true,
            ],
        ];

        $rsProps = \Bitrix\Iblock\PropertyTable::getList([
            'select' => ['*'],
            'filter' => [
                '=IBLOCK_ID' => $iblock_id,
                'ACTIVE' => 'Y'
            ],
            'order' => [
                'SORT' => 'ASC',
                'NAME' => 'ASC',
            ]
        ]);

        while ($aProperty = $rsProps->fetch())
        {
            $aProperty['PROPERTY_CAN_BE_KEY'] = in_array($aProperty["PROPERTY_TYPE"], ['S', 'N']) && $aProperty["MULTIPLE"] != "Y";

            $aProperty['PROPERTY_SYNC_ALLOWED'] = in_array($aProperty["PROPERTY_TYPE"], ['S', 'N', 'F']);

            $aProperty['NAME'] = $aProperty['NAME'] . ' {' . $aProperty['PROPERTY_TYPE']  . ($aProperty['MULTIPLE'] == "Y" ? 'M' : '') . '}';

            $aProperties[$aProperty['ID']] = $aProperty;
        }

        return $aProperties;
    }
}
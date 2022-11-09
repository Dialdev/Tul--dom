<?php
namespace Citadel\XpsUpdateClient\Table;


use Bitrix\Main\Entity;
use Bitrix\Main\Localization\Loc;


Loc::loadMessages(__FILE__);


class ClientTable extends Entity\DataManager
{
    /**
     * @inheritdoc
     */
    public static function getTableName()
    {
        return 'b_citadel_xpsupdateclient_client';
    }

    /**
     * @inheritdoc
     */
    public static function getMap()
    {
        return array(
            'ID' => array(
                'data_type' => 'integer',
                'primary' => true,
                'autocomplete' => true,
                'title' => Loc::getMessage('CLIENT_TABLE_ID_FIELD'),
            ),
            'ACTIVE' => array(
                'data_type' => 'boolean',
                'values' => array('N','Y'),
                'title' => Loc::getMessage('CLIENT_TABLE_ACTIVE_FIELD'),
            ),
            'SERVER_URL' => array(
                'data_type' => 'text',
                'required' => false,
                'title' => Loc::getMessage('CLIENT_TABLE_SERVER_URL_FIELD'),
                'validation' => array(__CLASS__, 'validation_SERVER_URL')
            ),
            'SERVER_KEY' => array(
                'data_type' => 'text',
                'required' => true,
                'title' => Loc::getMessage('CLIENT_TABLE_SERVER_KEY_FIELD'),
            ),
            'DESCRIPTION' => array(
                'data_type' => 'text',
                'required' => false,
                'title' => Loc::getMessage('CLIENT_TABLE_DESCRIPTION_FIELD'),
            ),
            'DATE_CREATE' => array(
                'data_type' => 'datetime',
                'title' => Loc::getMessage('CLIENT_TABLE_DATE_CREATE_FIELD'),
            ),
            'DATE_UPDATE' => array(
                'data_type' => 'datetime',
                'title' => Loc::getMessage('CLIENT_TABLE_DATE_UPDATE_FIELD'),
            ),
            'CREATED_BY' => array(
                'data_type' => 'integer',
                'title' => Loc::getMessage('CLIENT_TABLE_CREATED_BY_ID_FIELD'),
            ),
            'UPDATED_BY' => array(
                'data_type' => 'integer',
                'title' => Loc::getMessage('CLIENT_TABLE_UPDATED_BY_ID_FIELD'),
            ),
            'DATE_LAST_SYNC' => array(
                'data_type' => 'datetime',
                'title' => Loc::getMessage('CLIENT_TABLE_DATE_LAST_SYNC_FIELD'),
            ),

            'SERVER_IBLOCK_TYPE' => array(
                'data_type' => 'text',
                'title' => Loc::getMessage('CLIENT_TABLE_SERVER_IBLOCK_TYPE_FIELD'),
            ),
            'SERVER_IBLOCK_ID' => array(
                'data_type' => 'integer',
                'title' => Loc::getMessage('CLIENT_TABLE_SERVER_IBLOCK_ID_FIELD'),
            ),
            'SERVER_IBLOCK_KEY_ID' => array(
                'data_type' => 'text',
                'title' => Loc::getMessage('CLIENT_TABLE_SERVER_IBLOCK_KEY_ID_FIELD'),
            ),
            'CLIENT_IBLOCK_TYPE' => array(
                'data_type' => 'text',
                'title' => Loc::getMessage('CLIENT_TABLE_CLIENT_IBLOCK_TYPE_FIELD'),
            ),
            'CLIENT_IBLOCK_ID' => array(
                'data_type' => 'integer',
                'title' => Loc::getMessage('CLIENT_TABLE_CLIENT_IBLOCK_ID_FIELD'),
            ),
            'CLIENT_IBLOCK_KEY_ID' => array(
                'data_type' => 'text',
                'title' => Loc::getMessage('CLIENT_TABLE_CLIENT_IBLOCK_KEY_ID_FIELD'),
            ),
            'PROPERTIES_JSON' => array(
                'data_type' => 'text',
                'required' => false,
                'serialized' => true,
                'title' => Loc::getMessage('CLIENT_TABLE_IBLOCK_PROPERTIES_JSON_FIELD'),
                'save_data_modification' => array(__CLASS__, "save_data_modification_PROPERTIES_JSON"),
            ),
        );
    }


    /**
     * @param Entity\Event $event
     * @return Entity\EventResult
     */
    public static function onBeforeAdd(Entity\Event $event)
    {
        $arFields = $event->getParameter("fields");
        $result = new Entity\EventResult();

        $arFields['DATE_CREATE'] = \Bitrix\Main\Type\DateTime::createFromTimestamp(time());
        $arFields['DATE_UPDATE'] = $arFields['DATE_CREATE'];
        $arFields['CREATED_BY'] = \CUser::GetID();
        $arFields['UPDATED_BY'] = \CUser::GetID();

        $result->modifyFields($arFields);

        return $result;
    }


    /**
     * @param Entity\Event $event
     * @return Entity\EventResult
     */
    public static function onBeforeUpdate(Entity\Event $event)
    {
        $arFields = $event->getParameter("fields");
        $result = new Entity\EventResult();

        $arFields['DATE_UPDATE'] = \Bitrix\Main\Type\DateTime::createFromTimestamp(time());
        $arFields['UPDATED_BY'] = \CUser::GetID();

        $result->modifyFields($arFields);

        return $result;
    }


    /**
     * @return array
     */
    public static function validation_SERVER_URL()
    {
        return [
            function ($value)
            {
                return filter_var($value, FILTER_VALIDATE_URL) === false ?
                    Loc::getMessage('CLIENT_TABLE_NOT_URL', ['#FIELD#' => static::getEntity()->getField('SERVER_URL')->getTitle()]) :
                    true;
            }
        ];
    }

    /**
     * @return array
     */
    public static function save_data_modification_PROPERTIES_JSON()
    {
        return [
            function ($value)
            {
                $aProps = [];

                foreach ((array)$value['SERVER'] as $i => $_null)
                {
                    if (!empty($value['SERVER'][$i]) && !empty($value['CLIENT'][$i]))
                    {
                        $aProps['SERVER'][] = $value['SERVER'][$i];
                        $aProps['CLIENT'][] = $value['CLIENT'][$i];
                    }
                }

                return $aProps;
            }
        ];
    }


}
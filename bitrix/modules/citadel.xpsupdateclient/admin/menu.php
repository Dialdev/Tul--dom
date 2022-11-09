<?php
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

if($APPLICATION->GetGroupRight("citadel.xpsupdateclient") >= 'R')
{
    $aMenu = array(
        "parent_menu" => "global_menu_services",
        "section" => "citadel_xpsupdateclient",
        "sort" => 100,
        "text" => Loc::getMessage("CLIENT_MENU_SECTION_TITLE"),
        "title" => '',
        "url" => "citadel_xpsupdateclient_client_edit.php",
        "icon" => "form_menu_icon",
        "page_icon" => "clouds_menu_icon",
        "items_id" => "menu_citadel_xpsupdateclient",
        "items" => array(
            array(
                'sort' => 1,
                'icon' => '',
                'page_icon' => '',
                "text" => Loc::getMessage("CLIENT_MENU_CLIENT_TITLE"),
                "url" => "citadel_xpsupdateclient_client_edit.php",
                "more_url" => array(),
                "title" => ''
            ),
        )
    );

    return $aMenu;
}

return false;

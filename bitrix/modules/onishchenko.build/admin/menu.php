<?
use \Bitrix\Main\Localization\Loc;

if($APPLICATION->GetGroupRight("onishchenko.build")>"D"){
    Loc::LoadMessages(__FILE__);
    $aMenu = array(
        "parent_menu" => "global_menu_settings",
        "sort"        => 1,
        "url"         => "/bitrix/admin/recaptcha_settings.php?lang=".LANGUAGE_ID,
        "text"        => Loc::getMessage('BUILD_SETTINGS'),
        "title"       => Loc::getMessage('BUILD_SETTINGS'),
        "icon"        => "sys_menu_icon",
        "page_icon"   => "sys_page_icon",
    );
    return $aMenu;
}
return false;
?>
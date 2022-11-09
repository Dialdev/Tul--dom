<?
define('DEFAULT_TEMPLATE_PATH','/bitrix/templates/.default');
Bitrix\Main\Loader::registerAutoLoadClasses(null, array(
    '\Onishchenko\Build\Recaptcha' => '/bitrix/modules/onishchenko.build/lib/recaptcha.php',
));


Class ConishchenkoBuild{
    function OnBuildGlobalMenu(&$aGlobalMenu, &$aModuleMenu){

    }
}
?>
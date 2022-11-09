<?
IncludeModuleLangFile(__FILE__);
Class onishchenko_build extends CModule
{
	const MODULE_ID = 'onishchenko.build';
	var $MODULE_ID = 'onishchenko.build';
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;
	var $MODULE_CSS;
	var $strError = '';

	function __construct()
	{
		$arModuleVersion = array();
		include(dirname(__FILE__)."/version.php");
		$this->MODULE_VERSION = $arModuleVersion["VERSION"];
		$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
		$this->MODULE_NAME = GetMessage("onishchenko.build_MODULE_NAME");
		$this->MODULE_DESCRIPTION = GetMessage("onishchenko.build_MODULE_DESC");

		$this->PARTNER_NAME = GetMessage("onishchenko.build_PARTNER_NAME");
		$this->PARTNER_URI = GetMessage("onishchenko.build_PARTNER_URI");
	}

	function InstallDB($arParams = array())
	{
		RegisterModuleDependences('main', 'OnBuildGlobalMenu', self::MODULE_ID, 'ConishchenkoBuild', 'OnBuildGlobalMenu');
		return true;
	}

	function UnInstallDB($arParams = array())
	{
		UnRegisterModuleDependences('main', 'OnBuildGlobalMenu', self::MODULE_ID, 'ConishchenkoBuild', 'OnBuildGlobalMenu');
		return true;
	}

	function InstallEvents()
	{
        global $DB;
        include_once($_SERVER["DOCUMENT_ROOT"].'/bitrix/modules/'.self::MODULE_ID.'/install/events.php');
        return true;
	}

	function UnInstallEvents()
	{
        $statusMes = [
            'BUILD_FEEDBACK_FORM',
            'BUILD_CALL_FORM',
            'BUILD_REVIEWS',
            'BUILD_APPLY_FOR_JOB',
            'BUILD_APPOINTMENTS_FORM',
            'BUILD_FAQ',
            'BUILD_STAFF_QUESTION',
            'BUILD_QUESTION',
        ];

        $eventType = new CEventType;
        $eventM = new CEventMessage;
        foreach($statusMes as $v)
        {
            $eventType->Delete($v);
            $dbEvent = CEventMessage::GetList($b="ID", $order="ASC", Array("EVENT_NAME" => $v));
            while($arEvent = $dbEvent->Fetch())
            {
                $eventM->Delete($arEvent["ID"]);
            }
        }

        return true;
	}

	function InstallFiles($arParams = array())
	{
        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/bitrix/admin/recaptcha_settings.php',
            '<'.'? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/'.self::MODULE_ID.'/admin/recaptcha_settings.php");?'.'>');
		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/install/components'))
		{
			if ($dir = opendir($p))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.')
						continue;
					CopyDirFiles($p.'/'.$item, $_SERVER['DOCUMENT_ROOT'].'/bitrix/components/'.$item, $ReWrite = True, $Recursive = True);
				}
				closedir($dir);
			}
		}
		return true;
	}

	function UnInstallFiles()
	{
		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/admin'))
		{
			if ($dir = opendir($p))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.')
						continue;
					unlink($_SERVER['DOCUMENT_ROOT'].'/bitrix/admin/'.self::MODULE_ID.'_'.$item);
				}
				closedir($dir);
			}
		}
		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/install/components'))
		{
			if ($dir = opendir($p))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.' || !is_dir($p0 = $p.'/'.$item))
						continue;

					$dir0 = opendir($p0);
					while (false !== $item0 = readdir($dir0))
					{
						if ($item0 == '..' || $item0 == '.')
							continue;
						DeleteDirFilesEx('/bitrix/components/'.$item.'/'.$item0);
					}
					closedir($dir0);
				}
				closedir($dir);
			}
		}
		return true;
	}

	function DoInstall()
	{
        global $APPLICATION;
        $this->InstallFiles();
        if($this->InstallDB()) {
            RegisterModule(self::MODULE_ID);
            $this->InstallEvents();
            COption::SetOptionString("main", "optimize_css_files", "Y");
            COption::SetOptionString("main", "optimize_js_files", "N");
            COption::SetOptionString("main", "use_minified_assets", "Y");
            COption::SetOptionString("main", "move_js_to_body", "Y");
            COption::SetOptionString("main", "compres_css_js_files", "Y");
        }
	}

	function DoUninstall()
	{
        global $APPLICATION;
        UnRegisterModule(self::MODULE_ID);
        $this->UnInstallDB();
        $this->UnInstallFiles();
        $this->UnInstallEvents();
	}
}
?>

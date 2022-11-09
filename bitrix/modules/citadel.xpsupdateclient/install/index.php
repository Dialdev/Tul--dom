<?php

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\Config\Option;
use Bitrix\Main\EventManager;
use Bitrix\Main\Application;
use Bitrix\Main\IO\Directory;
use Bitrix\Main\SystemException;

Loc::loadMessages(__FILE__);



class citadel_xpsupdateclient extends CModule
{
    public $MODULE_ID = "citadel.xpsupdateclient";
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_NAME;
    public $MODULE_DESCRIPTION;
    public $PARTNER_NAME;
    public $PARTNER_URI;


    public function __construct()
    {
        $arModuleVersion = array();

        require __DIR__ . "/version.php";

        $this->MODULE_ID 		   = str_replace("_", ".", get_class($this));
        $this->MODULE_VERSION 	   = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        $this->MODULE_NAME 		   = Loc::getMessage("XPSUPDATECLIENT_NAME");
        $this->MODULE_DESCRIPTION  = Loc::getMessage("XPSUPDATECLIENT_DESCRIPTION");
        $this->PARTNER_NAME 	   = Loc::getMessage("XPSUPDATECLIENT_PARTNER_NAME");
        $this->PARTNER_URI  	   = Loc::getMessage("XPSUPDATECLIENT_PARTNER_URI");

        return false;
    }


    /**
     * @return bool
     */
    function DoInstall()
    {
        global $APPLICATION;

        if (CheckVersion(ModuleManager::getVersion("main"), "15.00.00"))
        {
            $this->InstallFiles();
            $this->InstallDB();

            ModuleManager::registerModule($this->MODULE_ID);

            $this->InstallEvents();
        }
        else
        {
            $APPLICATION->ThrowException(
                Loc::getMessage("INSTALL_ERROR_VERSION")
            );
        }

        $APPLICATION->IncludeAdminFile(
            Loc::getMessage("INSTALL_TITLE") . " \"" . Loc::getMessage("XPSUPDATECLIENT_NAME") . "\"",
            __DIR__ . "/step.php"
        );

        return false;
    }


    /**
     * @return bool
     */
    function DoUninstall()
    {
        global $APPLICATION;

        $this->UnInstallFiles();
        $this->UnInstallDB();
        $this->UnInstallEvents();

        ModuleManager::unRegisterModule($this->MODULE_ID);

        $APPLICATION->IncludeAdminFile(
            Loc::getMessage("INSTALL_TITLE") . " \"" . Loc::getMessage("XPSUPDATECLIENT_NAME") . "\"",
            __DIR__ . "/unstep.php"
        );

        return false;
    }


    public function InstallFiles()
    {
        //
        // install admin pages
        //
        $oDir = new Bitrix\Main\IO\Directory($this->getModuleDir() . '/admin/pages');

        if ($oDir->isExists())
        {
            foreach ($oDir->getChildren() as $oFile)
            {
                if ($oFile instanceof Bitrix\Main\IO\File)
                {
                    $oFile::putFileContents(
                        Application::getDocumentRoot() . '/bitrix/admin/' . get_class($this) . '_' . $oFile->getName(),
                        '<'.'? require_once($_SERVER["DOCUMENT_ROOT"]."' . $this->getModuleDir(true) . '/admin/pages/' . $oFile->getName() . '");?'.'>'
                    );
                }
            }
        }

        //
        // install css
        //
        $srcDir = new Bitrix\Main\IO\Directory($this->getModuleDir() . '/install/css');
        $destDir = new Bitrix\Main\IO\Directory(Bitrix\Main\Application::getDocumentRoot() . '/bitrix/css/' . $this->MODULE_ID);
        $destDir->create();

        if ($srcDir->isExists())
        {
            foreach ($srcDir->getChildren() as $oFile)
            {
                if ($oFile instanceof Bitrix\Main\IO\File)
                {
                    $oFile::putFileContents(
                        $destDir->getPath() . '/' . $oFile->getName() . '.php',
                        '<? header("Content-type: text/css; charset: UTF-8"); echo file_get_contents("' . $srcDir->getPath() . '/' . $oFile->getName() . '");'
                    );
                }
            }
        }

        //
        // install js
        //
        $srcDir = new Bitrix\Main\IO\Directory($this->getModuleDir() . '/install/js');
        $destDir = new Bitrix\Main\IO\Directory(Bitrix\Main\Application::getDocumentRoot() . '/bitrix/js/' . $this->MODULE_ID);
        $destDir->create();

        if ($srcDir->isExists())
        {
            foreach ($srcDir->getChildren() as $oFile)
            {
                if ($oFile instanceof Bitrix\Main\IO\File)
                {
                    $oFile::putFileContents(
                        $destDir->getPath() . '/' . $oFile->getName() . '.php',
                        '<? header("Content-Type: application/javascript"); echo file_get_contents("' . $srcDir->getPath() . '/' . $oFile->getName() . '");'
                    );
                }
            }
        }

        return false;
    }


    public function UnInstallFiles()
    {
        //
        // unstall admin pages
        //
        $oDir = new Bitrix\Main\IO\Directory($this->getModuleDir() . '/admin/pages');

        foreach ($oDir->getChildren() as $oFile)
        {
            if ($oFile instanceof Bitrix\Main\IO\File)
            {
                $oFile::deleteFile(Application::getDocumentRoot() . '/bitrix/admin/' . get_class($this) . '_' . $oFile->getName());
            }
        }

        //
        // uninstall css
        //
        $destDir = new Bitrix\Main\IO\Directory(Bitrix\Main\Application::getDocumentRoot() . '/bitrix/css/' . $this->MODULE_ID);
        $destDir->delete();

        //
        // uninstall js
        //
        $destDir = new Bitrix\Main\IO\Directory(Bitrix\Main\Application::getDocumentRoot() . '/bitrix/js/' . $this->MODULE_ID);
        $destDir->delete();

        return false;
    }


    public function InstallDB()
    {
        global $DB, $DBType, $APPLICATION;

        $errors = $DB->RunSQLBatch(self::getModuleDir() . '/install/' .  $DBType . "/install.sql");

        if (!empty($errors))
        {
            $APPLICATION->ThrowException(implode("", $errors));
            return false;
        }

        return false;
    }


    public function UnInstallDB()
    {
        global $DB, $DBType, $APPLICATION;

        Bitrix\Main\Config\Option::delete($this->MODULE_ID);

        $errors = $DB->RunSQLBatch(self::getModuleDir() . '/install/' . $DBType . "/uninstall.sql");

        if (!empty($errors))
        {
            $APPLICATION->ThrowException(implode("", $errors));
            return false;
        }

        return false;
    }


    public function InstallEvents()
    {
        return false;
    }


    public function UnInstallEvents()
    {
        return false;
    }


    /**
     * @param bool $notDocumentRoot
     * @return mixed|string
     */
    private function getModuleDir($notDocumentRoot = false)
    {
        $dir = $notDocumentRoot
            ? str_ireplace(Bitrix\Main\Application::getDocumentRoot(), '',  dirname(__FILE__))
            : dirname(__FILE__);

        return dirname($dir);
    }

}
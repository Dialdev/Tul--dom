<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

if (!defined("WIZARD_SITE_ID"))
	return;

if (!defined("WIZARD_SITE_DIR"))
	return;

IncludeModuleLangFile(__FILE__);	
$path = str_replace("//", "/", WIZARD_ABSOLUTE_PATH."/site/public/".LANGUAGE_ID."/");

$handle = @opendir($path);
if ($handle)
{
	while ($file = readdir($handle))
	{
		if (in_array($file, array(".", "..")))
			continue; 
		
		$to = ($file == 'upload' ? $_SERVER['DOCUMENT_ROOT'] . '/upload' : WIZARD_SITE_PATH."/".$file);
		
		CopyDirFiles(
			$path.$file,
			$to,
			$rewrite = true, 
			$recursive = true,
			$delete_after_copy = false
		);
	}
	
	if(CModule::IncludeModule("search"))
	{
		CSearch::ReIndexAll(Array(WIZARD_SITE_ID, WIZARD_SITE_DIR));
	}
}
function ___writeToAreasFile($fn, $text)
{
	if(file_exists($fn) && !is_writable($abs_path) && defined("BX_FILE_PERMISSIONS"))
		@chmod($abs_path, BX_FILE_PERMISSIONS);

	$fd = @fopen($fn, "wb");
	if(!$fd)
		return false;

	if(false === fwrite($fd, $text))
	{
		fclose($fd);
		return false;
	}

	fclose($fd);

	if(defined("BX_FILE_PERMISSIONS"))
		@chmod($fn, BX_FILE_PERMISSIONS);
}

WizardServices::PatchHtaccess(WIZARD_SITE_PATH);
$site_dir = (substr_count(WIZARD_SITE_DIR,'/') == 2)? WIZARD_SITE_DIR : '/' ;
$arReplace = Array(
	"SITE_NAME" => COption::GetOptionString("main", "site_build_name"
			, GetMessage("NAME_YOU_MARKET"), $wizard->GetVar("siteID")),
	"PHONE" => COption::GetOptionString("main", "site_build_phone"
			, GetMessage("wiz_phone"), $wizard->GetVar("siteID")),
	"EMAIL" => COption::GetOptionString("main", "site_build_email", GetMessage("D_email"), $wizard->GetVar("siteID")),
    "SITE_DIR" => $site_dir,
		
);


CWizardUtil::ReplaceMacros($_SERVER["DOCUMENT_ROOT"]."/".WIZARD_SITE_DIR."/include/email.php", $arReplace);
CWizardUtil::ReplaceMacros($_SERVER["DOCUMENT_ROOT"]."/".WIZARD_SITE_DIR."/include/footer-about.php", $arReplace);
CWizardUtil::ReplaceMacros($_SERVER["DOCUMENT_ROOT"]."/".WIZARD_SITE_DIR."/include/phone.php", $arReplace);
CWizardUtil::ReplaceMacros($_SERVER["DOCUMENT_ROOT"]."/".WIZARD_SITE_DIR."/include/footer-phone.php", $arReplace);
CWizardUtil::ReplaceMacros($_SERVER["DOCUMENT_ROOT"]."/".WIZARD_SITE_DIR."/include/contacts-page.php", $arReplace);
CWizardUtil::ReplaceMacros($_SERVER["DOCUMENT_ROOT"]."/".WIZARD_SITE_DIR."/contacts/index.php", $arReplace);

CWizardUtil::ReplaceMacros($_SERVER["DOCUMENT_ROOT"]."/".WIZARD_SITE_DIR."/company/reviews/index.php", $arReplace);
CWizardUtil::ReplaceMacros($_SERVER["DOCUMENT_ROOT"]."/".WIZARD_SITE_DIR."/company/staff/index.php", $arReplace);
CWizardUtil::ReplaceMacros($_SERVER["DOCUMENT_ROOT"]."/".WIZARD_SITE_DIR."/company/faq/index.php", $arReplace);
CWizardUtil::ReplaceMacros($_SERVER["DOCUMENT_ROOT"]."/".WIZARD_SITE_DIR."/company/jobs/index.php", $arReplace);

CWizardUtil::ReplaceMacros($_SERVER["DOCUMENT_ROOT"]."/".WIZARD_SITE_DIR."/include/footer-components.php", $arReplace);
CWizardUtil::ReplaceMacros($_SERVER["DOCUMENT_ROOT"]."/".WIZARD_SITE_DIR."/include/footer-left-components.php", $arReplace);

CWizardUtil::ReplaceMacros($_SERVER["DOCUMENT_ROOT"]."/".WIZARD_SITE_DIR."/info/articles/index.php", $arReplace);
CWizardUtil::ReplaceMacros($_SERVER["DOCUMENT_ROOT"]."/".WIZARD_SITE_DIR."/info/articles/.left.menu_ext.php", $arReplace);
CWizardUtil::ReplaceMacros($_SERVER["DOCUMENT_ROOT"]."/".WIZARD_SITE_DIR."/info/news/index.php", $arReplace);

CWizardUtil::ReplaceMacros($_SERVER["DOCUMENT_ROOT"]."/".WIZARD_SITE_DIR."/services/index.php", $arReplace);

CWizardUtil::ReplaceMacros($_SERVER["DOCUMENT_ROOT"]."/".WIZARD_SITE_DIR."/catalog/index.php", $arReplace);
CWizardUtil::ReplaceMacros($_SERVER["DOCUMENT_ROOT"]."/".WIZARD_SITE_DIR."/catalog/.left.menu_ext.php", $arReplace);

CWizardUtil::ReplaceMacros($_SERVER["DOCUMENT_ROOT"]."/".WIZARD_SITE_DIR."/portfolio/projects/index.php", $arReplace);
CWizardUtil::ReplaceMacros($_SERVER["DOCUMENT_ROOT"]."/".WIZARD_SITE_DIR."/portfolio/projects/.left.menu_ext.php", $arReplace);
?>
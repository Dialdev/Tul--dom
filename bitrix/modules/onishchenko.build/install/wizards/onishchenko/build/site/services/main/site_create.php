<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

if (!defined("WIZARD_SITE_ID"))
	return;

IncludeModuleLangFile(__FILE__);
use Bitrix\Main\Localization\CultureTable;

$site_id = "";
if (COption::GetOptionString("main", "build", "N") == "Y")
{

	$site_id = COption::GetOptionString("main", "site_build_id");
	
	$db_res = CSite::GetList($by="sort", $order="desc", array("LID" => $site_id));
	if (!($db_res && $res = $db_res->Fetch()))
	{
		$culture = CultureTable::getRow(array('filter'=>array(
			"=FORMAT_DATE" => "DD.MM.YYYY",
			"=FORMAT_DATETIME" => "DD.MM.YYYY HH:MI:SS",
			"=FORMAT_NAME" => CSite::GetDefaultNameFormat(),
			"=CHARSET" => (defined("BX_UTF") ? "UTF-8" : "windows-1251"),
		)));

		if($culture)
		{
			$cultureId = $culture["ID"];
		}
		else
		{
			$addResult = CultureTable::add(array(
				"NAME" => $site_id,
				"CODE" => $site_id,
				"FORMAT_DATE" => "DD.MM.YYYY",
				"FORMAT_DATETIME" => "DD.MM.YYYY HH:MI:SS",
				"FORMAT_NAME" => CSite::GetDefaultNameFormat(),
				"CHARSET" => (defined("BX_UTF") ? "UTF-8" : "windows-1251"),
			));
			$cultureId = $addResult->getId();
		}

		$arFields = array(
			"LID" => $site_id,
			"ACTIVE" => "Y",
			"SORT" => 500,
			"DEF" => "N",
			"NAME" => GetMessage("wiz_site_build_name"),
			"DIR" => COption::GetOptionString("main", "site_build_folder"),
			"SITE_NAME" => GetMessage("wiz_site_build_name"),
			"SERVER_NAME" => $_SERVER["SERVER_NAME"],
			"EMAIL" => COption::GetOptionString("main", "email_from"),
			"LANGUAGE_ID" => LANGUAGE_ID,
			"DOC_ROOT" => "",
			"CULTURE_ID" => $cultureId,
		);
		$obSite = new CSite;
		$result = $obSite->Add($arFields);
		if ($result)
		{
			COption::SetOptionString("main", "build", "N");
		}
		else 
		{
			echo $obSite->LAST_ERROR; 
			die(); 
		}
	}
}

COption::SetOptionString("main", "new_user_registration", "N"); 
COption::SetOptionString('socialnetwork', 'allow_tooltip', 'N', false , $site_id);

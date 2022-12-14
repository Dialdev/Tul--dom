<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if(!CModule::IncludeModule("iblock")) return;

if(!defined("WIZARD_SITE_ID")) return;
if(!defined("WIZARD_SITE_DIR")) return;
if(!defined("WIZARD_SITE_PATH")) return;
if(!defined("WIZARD_TEMPLATE_ID")) return;
if(!defined("WIZARD_TEMPLATE_ABSOLUTE_PATH")) return;
if(!defined("WIZARD_THEME_ID")) return;

$bitrixTemplateDir = $_SERVER["DOCUMENT_ROOT"].BX_PERSONAL_ROOT."/templates/".WIZARD_TEMPLATE_ID."/";
//$bitrixTemplateDir = $_SERVER["DOCUMENT_ROOT"]."/local/templates/".WIZARD_TEMPLATE_ID."/";

$iblockShortCODE = "banners";
$iblockXMLFile = WIZARD_SERVICE_RELATIVE_PATH."/xml/".LANGUAGE_ID."/".$iblockShortCODE.".xml";
$iblockTYPE = "aspro_max_adv";
$iblockXMLID = "aspro_max_".$iblockShortCODE."_".WIZARD_SITE_ID;
$iblockCODE = "aspro_max_".$iblockShortCODE;
$iblockID = false;

$rsIBlock = CIBlock::GetList(array(), array("XML_ID" => $iblockXMLID, "TYPE" => $iblockTYPE));
if ($arIBlock = $rsIBlock->Fetch()) {
	$iblockID = $arIBlock["ID"];
	if (WIZARD_INSTALL_DEMO_DATA) {
		// delete if already exist & need install demo
		CIBlock::Delete($arIBlock["ID"]);
		$iblockID = false;
	}
}

if(WIZARD_INSTALL_DEMO_DATA){
	if(!$iblockID){
		// add new iblock
		$permissions = array("1" => "X", "2" => "R");
		$dbGroup = CGroup::GetList($by = "", $order = "", array("STRING_ID" => "content_editor"));
		if($arGroup = $dbGroup->Fetch()){
			$permissions[$arGroup["ID"]] = "W";
		};
		
		// replace macros IN_XML_SITE_ID & IN_XML_SITE_DIR in xml file - for correct url links to site
		if(file_exists($_SERVER["DOCUMENT_ROOT"].$iblockXMLFile.".back")){
			@copy($_SERVER["DOCUMENT_ROOT"].$iblockXMLFile.".back", $_SERVER["DOCUMENT_ROOT"].$iblockXMLFile);
		}
		@copy($_SERVER["DOCUMENT_ROOT"].$iblockXMLFile, $_SERVER["DOCUMENT_ROOT"].$iblockXMLFile.".back");
		CWizardUtil::ReplaceMacros($_SERVER["DOCUMENT_ROOT"].$iblockXMLFile, Array("IN_XML_SITE_DIR" => WIZARD_SITE_DIR));
		CWizardUtil::ReplaceMacros($_SERVER["DOCUMENT_ROOT"].$iblockXMLFile, Array("IN_XML_SITE_ID" => WIZARD_SITE_ID));
		$iblockID = WizardServices::ImportIBlockFromXML($iblockXMLFile, $iblockCODE, $iblockTYPE, WIZARD_SITE_ID, $permissions);
		if(file_exists($_SERVER["DOCUMENT_ROOT"].$iblockXMLFile.".back")){
			@copy($_SERVER["DOCUMENT_ROOT"].$iblockXMLFile.".back", $_SERVER["DOCUMENT_ROOT"].$iblockXMLFile);
		}
		if ($iblockID < 1)	return;
			
		// iblock fields
		$iblock = new CIBlock;
		$arFields = array(
			"ACTIVE" => "Y",
			"CODE" => $iblockCODE,
			"XML_ID" => $iblockXMLID,
			"FIELDS" => array(
				"IBLOCK_SECTION" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => "Array",
				),
				"ACTIVE" => array(
					"IS_REQUIRED" => "Y",
					"DEFAULT_VALUE"=> "Y",
				),
				"ACTIVE_FROM" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => "",
				),
				"ACTIVE_TO" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => "",
				),
				"SORT" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => "0",
				), 
				"NAME" => array(
					"IS_REQUIRED" => "Y",
					"DEFAULT_VALUE" => "",
				), 
				"PREVIEW_PICTURE" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => array(
						"FROM_DETAIL" => "N",
						"SCALE" => "Y",
						"WIDTH" => "1500",
						"HEIGHT" => "1500",
						"IGNORE_ERRORS" => "N",
						"METHOD" => "resample",
						"COMPRESSION" => 95,
						"DELETE_WITH_DETAIL" => "N",
						"UPDATE_WITH_DETAIL" => "N",
					),
				), 
				"PREVIEW_TEXT_TYPE" => array(
					"IS_REQUIRED" => "Y",
					"DEFAULT_VALUE" => "text",
				), 
				"PREVIEW_TEXT" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => "",
				), 
				"DETAIL_PICTURE" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => array(
						"SCALE" => "N",
						"WIDTH" => "",
						"HEIGHT" => "",
						"IGNORE_ERRORS" => "N",
						"METHOD" => "resample",
						"COMPRESSION" => 95,
					),
				), 
				"DETAIL_TEXT_TYPE" => array(
					"IS_REQUIRED" => "Y",
					"DEFAULT_VALUE" => "text",
				), 
				"DETAIL_TEXT" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => "",
				), 
				"XML_ID" =>  array(
					"IS_REQUIRED" => "Y",
					"DEFAULT_VALUE" => "",
				), 
				"CODE" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => array(
						"UNIQUE" => "N",
						"TRANSLITERATION" => "N",
						"TRANS_LEN" => 100,
						"TRANS_CASE" => "L",
						"TRANS_SPACE" => "-",
						"TRANS_OTHER" => "-",
						"TRANS_EAT" => "Y",
						"USE_GOOGLE" => "N",
					),
				),
				"TAGS" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => "",
				), 
				"SECTION_NAME" => array(
					"IS_REQUIRED" => "Y",
					"DEFAULT_VALUE" => "",
				), 
				"SECTION_PICTURE" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => array(
						"FROM_DETAIL" => "N",
						"SCALE" => "N",
						"WIDTH" => "",
						"HEIGHT" => "",
						"IGNORE_ERRORS" => "N",
						"METHOD" => "resample",
						"COMPRESSION" => 95,
						"DELETE_WITH_DETAIL" => "N",
						"UPDATE_WITH_DETAIL" => "N",
					),
				), 
				"SECTION_DESCRIPTION_TYPE" => array(
					"IS_REQUIRED" => "Y",
					"DEFAULT_VALUE" => "text",
				), 
				"SECTION_DESCRIPTION" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => "",
				), 
				"SECTION_DETAIL_PICTURE" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => array(
						"SCALE" => "N",
						"WIDTH" => "",
						"HEIGHT" => "",
						"IGNORE_ERRORS" => "N",
						"METHOD" => "resample",
						"COMPRESSION" => 95,
					),
				), 
				"SECTION_XML_ID" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => "",
				), 
				"SECTION_CODE" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => array(
						"UNIQUE" => "N",
						"TRANSLITERATION" => "N",
						"TRANS_LEN" => 100,
						"TRANS_CASE" => "L",
						"TRANS_SPACE" => "-",
						"TRANS_OTHER" => "-",
						"TRANS_EAT" => "Y",
						"USE_GOOGLE" => "N",
					),
				), 
			),
		);
		
		$iblock->Update($iblockID, $arFields);
	}
	else{
		// attach iblock to site
		$arSites = array(); 
		$db_res = CIBlock::GetSite($iblockID);
		while ($res = $db_res->Fetch())
			$arSites[] = $res["LID"]; 
		if (!in_array(WIZARD_SITE_ID, $arSites)){
			$arSites[] = WIZARD_SITE_ID;
			$iblock = new CIBlock;
			$iblock->Update($iblockID, array("LID" => $arSites));
		}
	}

	// iblock user fields
	$dbSite = CSite::GetByID(WIZARD_SITE_ID);
	if($arSite = $dbSite -> Fetch()) $lang = $arSite["LANGUAGE_ID"];
	if(!strlen($lang)) $lang = "ru";
	WizardServices::IncludeServiceLang("editform_useroptions.php", $lang);
	WizardServices::IncludeServiceLang("properties_hints.php", $lang);
	$arProperty = array();
	$dbProperty = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $iblockID));
	while($arProp = $dbProperty->Fetch())
		$arProperty[$arProp["CODE"]] = $arProp["ID"];

	// properties hints

	// edit form user options
	CUserOptions::SetOption("form", "form_element_".$iblockID, array(
		"tabs" => 'edit1--#--'.GetMessage("WZD_OPTION_12").'--,--ACTIVE--#--'.GetMessage("WZD_OPTION_2").'--,--ACTIVE_FROM--#--'.GetMessage("WZD_OPTION_14").'--,--ACTIVE_TO--#--'.GetMessage("WZD_OPTION_16").'--,--SORT--#--'.GetMessage("WZD_OPTION_8").'--,--NAME--#--'.GetMessage("WZD_OPTION_4").'--,--PROPERTY_'.$arProperty["TITLE_H1"].'--#--'.GetMessage("WZD_OPTION_18").'--,--PROPERTY_'.$arProperty["TYPE_BANNERS"].'--#--'.GetMessage("WZD_OPTION_20").'--,--PREVIEW_PICTURE--#--'.GetMessage("WZD_OPTION_22").'--,--DETAIL_PICTURE--#--'.GetMessage("WZD_OPTION_24").'--,--PROPERTY_'.$arProperty["TARGETS"].'--#--'.GetMessage("WZD_OPTION_26").'--,--PROPERTY_'.$arProperty["URL_STRING"].'--#--'.GetMessage("WZD_OPTION_28").'--;--cedit3--#--'.GetMessage("WZD_OPTION_30").'--,--PROPERTY_'.$arProperty["TEXTCOLOR"].'--#--'.GetMessage("WZD_OPTION_32").'--,--PROPERTY_'.$arProperty["DARK_MENU_COLOR"].'--#--'.GetMessage("WZD_OPTION_34").'--,--PROPERTY_'.$arProperty["TEXT_POSITION"].'--#--'.GetMessage("WZD_OPTION_36").'--,--PROPERTY_'.$arProperty["TOP_TEXT"].'--#--'.GetMessage("WZD_OPTION_38").'--,--PREVIEW_TEXT--#--'.GetMessage("WZD_OPTION_40").'--,--cedit3_csection1--#--'.GetMessage("WZD_OPTION_42").'--,--PROPERTY_'.$arProperty["BUTTON1CLASS"].'--#--'.GetMessage("WZD_OPTION_44").'--,--PROPERTY_'.$arProperty["BUTTON1TEXT"].'--#--'.GetMessage("WZD_OPTION_46").'--,--PROPERTY_'.$arProperty["BUTTON1LINK"].'--#--'.GetMessage("WZD_OPTION_48").'--,--PROPERTY_'.$arProperty["BUTTON2CLASS"].'--#--'.GetMessage("WZD_OPTION_50").'--,--PROPERTY_'.$arProperty["BUTTON2TEXT"].'--#--'.GetMessage("WZD_OPTION_52").'--,--PROPERTY_'.$arProperty["BUTTON2LINK"].'--#--'.GetMessage("WZD_OPTION_54").'--;--cedit1--#--'.GetMessage("WZD_OPTION_56").'--,--PROPERTY_'.$arProperty["SHOW_VIDEO"].'--#--'.GetMessage("WZD_OPTION_58").'--,--PROPERTY_'.$arProperty["VIDEO_SOURCE"].'--#--'.GetMessage("WZD_OPTION_60").'--,--PROPERTY_'.$arProperty["VIDEO"].'--#--'.GetMessage("WZD_OPTION_62").'--,--PROPERTY_'.$arProperty["VIDEO_AUTOSTART"].'--#--'.GetMessage("WZD_OPTION_64").'--,--PROPERTY_'.$arProperty["VIDEO_COVER"].'--#--'.GetMessage("WZD_OPTION_66").'--,--PROPERTY_'.$arProperty["VIDEO_DISABLE_SOUND"].'--#--'.GetMessage("WZD_OPTION_68").'--,--PROPERTY_'.$arProperty["VIDEO_LOOP"].'--#--'.GetMessage("WZD_OPTION_70").'--,--PROPERTY_'.$arProperty["VIDEO_SRC"].'--#--'.GetMessage("WZD_OPTION_72").'--,--PROPERTY_'.$arProperty["BUTTON_VIDEO_TEXT"].'--#--'.GetMessage("WZD_OPTION_74").'--,--PROPERTY_'.$arProperty["BUTTON_VIDEO_CLASS"].'--#--'.GetMessage("WZD_OPTION_76").'--;--cedit2--#--'.GetMessage("WZD_OPTION_78").'--,--PROPERTY_'.$arProperty["LINK_ITEM"].'--#--'.GetMessage("WZD_OPTION_80").'--,--PROPERTY_'.$arProperty["SHOW_STICKERS"].'--#--'.GetMessage("WZD_OPTION_82").'--,--PROPERTY_'.$arProperty["SHOW_RATING"].'--#--'.GetMessage("WZD_OPTION_84").'--,--PROPERTY_'.$arProperty["SHOW_DATE_SALE"].'--#--'.GetMessage("WZD_OPTION_86").'--,--PROPERTY_'.$arProperty["SHOW_PRICES"].'--#--'.GetMessage("WZD_OPTION_88").'--,--PROPERTY_'.$arProperty["SHOW_OLD_PRICE"].'--#--'.GetMessage("WZD_OPTION_90").'--,--PROPERTY_'.$arProperty["SHOW_DISCOUNT"].'--#--'.GetMessage("WZD_OPTION_92").'--,--PROPERTY_'.$arProperty["SHOW_BUTTONS"].'--#--'.GetMessage("WZD_OPTION_94").'--;--cedit4--#--'.GetMessage("WZD_OPTION_96").'--,--PROPERTY_'.$arProperty["LINK_REGION"].'--#--'.GetMessage("WZD_OPTION_98").'--;--edit2--#--'.GetMessage("WZD_OPTION_100").'--,--SECTIONS--#--'.GetMessage("WZD_OPTION_100").'--,--XML_ID--#--'.GetMessage("WZD_OPTION_102").'--;----#--'.GetMessage("WZD_OPTION_10").'--;--',
	));
	// list user options
	CUserOptions::SetOption("list", "tbl_iblock_list_".md5($iblockTYPE.".".$iblockID), array(
		'columns' => '', 'by' => '', 'order' => '', 'page_size' => '',
	));
}

if($iblockID){
	$arSection = CIBlockSection::GetList(array(), array("XML_ID" => 361, "IBLOCK_ID" => $iblockID))->Fetch();
	if($arSection)
	{
		CWizardUtil::ReplaceMacrosRecursive(WIZARD_SITE_PATH, Array("IBLOCK_BANNERS_TYPE_3_8" => $arSection['ID']));
		CWizardUtil::ReplaceMacrosRecursive($bitrixTemplateDir, Array("IBLOCK_BANNERS_TYPE_3_8" => $arSection['ID']));
	}

	$arSection2 = CIBlockSection::GetList(array(), array("XML_ID" => 359, "IBLOCK_ID" => $iblockID))->Fetch();
	if($arSection2)
	{
		CWizardUtil::ReplaceMacrosRecursive(WIZARD_SITE_PATH, Array("IBLOCK_BANNERS_TYPE_2_7" => $arSection2['ID']));
		CWizardUtil::ReplaceMacrosRecursive($bitrixTemplateDir, Array("IBLOCK_BANNERS_TYPE_2_7" => $arSection2['ID']));
	}

	$arSection3 = CIBlockSection::GetList(array(), array("XML_ID" => 360, "IBLOCK_ID" => $iblockID))->Fetch();
	if($arSection3)
	{
		CWizardUtil::ReplaceMacrosRecursive(WIZARD_SITE_PATH, Array("IBLOCK_BANNERS_TYPE_9" => $arSection3['ID']));
		CWizardUtil::ReplaceMacrosRecursive($bitrixTemplateDir, Array("IBLOCK_BANNERS_TYPE_9" => $arSection3['ID']));
	}

	$arSection4 = CIBlockSection::GetList(array(), array("XML_ID" => 363, "IBLOCK_ID" => $iblockID))->Fetch();
	if($arSection4)
	{
		CWizardUtil::ReplaceMacrosRecursive(WIZARD_SITE_PATH, Array("IBLOCK_BANNERS_TYPE_10" => $arSection4['ID']));
		CWizardUtil::ReplaceMacrosRecursive($bitrixTemplateDir, Array("IBLOCK_BANNERS_TYPE_10" => $arSection4['ID']));
	}
	
	// replace macros IBLOCK_TYPE & IBLOCK_ID & IBLOCK_CODE
	CWizardUtil::ReplaceMacrosRecursive(WIZARD_SITE_PATH, Array("IBLOCK_BANNERS_TYPE" => $iblockTYPE));
	CWizardUtil::ReplaceMacrosRecursive(WIZARD_SITE_PATH, Array("IBLOCK_BANNERS_ID" => $iblockID));
	CWizardUtil::ReplaceMacrosRecursive(WIZARD_SITE_PATH, Array("IBLOCK_BANNERS_CODE" => $iblockCODE));
	CWizardUtil::ReplaceMacrosRecursive($bitrixTemplateDir, Array("IBLOCK_BANNERS_TYPE" => $iblockTYPE));
	CWizardUtil::ReplaceMacrosRecursive($bitrixTemplateDir, Array("IBLOCK_BANNERS_ID" => $iblockID));
	CWizardUtil::ReplaceMacrosRecursive($bitrixTemplateDir, Array("IBLOCK_BANNERS_CODE" => $iblockCODE));
}
?>

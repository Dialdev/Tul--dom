<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

IncludeModuleLangFile(__FILE__);

if (!defined("WIZARD_TEMPLATE_ID"))
	return;

$bitrixTemplateDir = $_SERVER["DOCUMENT_ROOT"]."/bitrix/templates";
	
CopyDirFiles(
	$_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/onishchenko.build/install/wizards/onishchenko/build/site/templates",
	$bitrixTemplateDir, 
	$rewrite = true,
	$recursive = true,
	$delete_after_copy = false
);

$wizard =& $this->GetWizard();
$site_dir = (substr_count(WIZARD_SITE_DIR,'/') == 2)? WIZARD_SITE_DIR : '/' ;
if (strlen(WIZARD_SITE_ID)) {
   $obSite = new CSite();
   $t = $obSite->Update(WIZARD_SITE_ID, array(
      'ACTIVE' => "Y",
      'TEMPLATE'=>array(
          array(
              'CONDITION' => "",
              'SORT' => 1,
              'TEMPLATE' => "inner_left_menu"
          ),
          array(
              'CONDITION' => "CSite::InDir('".$site_dir."portfolio/projects')",
              'SORT' => 2,
              'TEMPLATE' => "inner_left_menu"
          ),
          array(
              'CONDITION' => "CSite::InDir('".$site_dir."portfolio')",
              'SORT' => 3,
              'TEMPLATE' => "inner_without_menu"
          ),
          array(
              'CONDITION' => "CSite::InDir('".$site_dir."info')",
              'SORT' => 100,
              'TEMPLATE' => "inner_right_menu"
          ),
          array(
              'CONDITION' => "CSite::InDir('".$site_dir."index.php')",
              'SORT' => 100,
              'TEMPLATE' => "main_page"
          ),
          array(
              'CONDITION' => "CSite::InDir('".$site_dir."contacts')",
              'SORT' => 100,
              'TEMPLATE' => "inner_without_menu"
          ),
      )
   ));
}
$arr = array(
    "CONDITION" => "#^".$site_dir."portfolio/projects/#",
    "RULE" => "",
    "ID" => "bitrix:news",
    "PATH" => $site_dir."portfolio/projects/index.php",
);
CUrlRewriter::Add($arr);

$arr = array(
    "CONDITION" => "#^".$site_dir."info/articles/#",
    "RULE" => "",
    "ID" => "bitrix:news",
    "PATH" => $site_dir."info/articles/index.php",
);
CUrlRewriter::Add($arr);

$arr = array(
    "CONDITION" => "#^".$site_dir."info/news/#",
    "RULE" => "",
    "ID" => "bitrix:news",
    "PATH" => $site_dir."info/news/index.php",
);
CUrlRewriter::Add($arr);

$arr = array(
    "CONDITION" => "#^".$site_dir."services/#",
    "RULE" => "",
    "ID" => "bitrix:news",
    "PATH" => $site_dir."services/index.php",
);
CUrlRewriter::Add($arr);

$arr = array(
    "CONDITION" => "#^".$site_dir."catalog/#",
    "RULE" => "",
    "ID" => "bitrix:news",
    "PATH" => $site_dir."catalog/index.php",
);
CUrlRewriter::Add($arr);



COption::SetOptionString("main", "wizard_template_id", WIZARD_TEMPLATE_ID, false, WIZARD_SITE_ID);


?>

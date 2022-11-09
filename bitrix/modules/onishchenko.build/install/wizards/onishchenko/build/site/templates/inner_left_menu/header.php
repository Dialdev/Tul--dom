<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)die();?>
<?\Bitrix\Main\Loader::IncludeModule('onishchenko.build')?>
<?use Bitrix\Main\Page\Asset; ?>
<!DOCTYPE html>
<html lang="<?=LANGUAGE_ID?>">
<head>
    <title><?$APPLICATION->ShowTitle();?></title>
    <?$APPLICATION->ShowHead()?>
    <!--meta-->
    <?Asset::getInstance()->addString('<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />'); ?>
    <?Asset::getInstance()->addString('<meta name="format-detection" content="telephone=no" />'); ?>
    <?Asset::getInstance()->addString("<link href='//fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,600,700,800&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>"); ?>
    <?Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH."/css/reset.css");?>
    <?Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH."/css/superfish.css");?>
      <?Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH."/css/style.css");?>
    <?Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH."/css/responsive.css");?>
    <!--fonts-->
    <?Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH."/includes/fonts/streamline-small/style.css");?>
    <?Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH."/includes/fonts/template/styles.css");?>
    <?Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH."/includes/fonts/social/styles.css");?>
    <?Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH."/css/jquery.fancybox.min.css");?>

    <link rel="shortcut icon" href="<?=DEFAULT_TEMPLATE_PATH?>/images/favicon.ico">
</head>
<body>
<?$APPLICATION->ShowPanel()?>
<?Asset::getInstance()->addJs(DEFAULT_TEMPLATE_PATH."/js/jquery-1.12.4.min.js");?>
<?$APPLICATION->IncludeFile(SITE_DIR."include/customizer.php",Array(), Array("MODE"=>"html"));?>
<div class="site-container">
   <div class="header-top-bar-container clearfix">
      <div class="header-top-bar">
         <div class="left logo">
             <?$APPLICATION->IncludeFile(SITE_DIR."include/logo.php",Array(), Array("MODE"=>"html"));?>
         </div>
         <div class="left top-header-description">
             <?$APPLICATION->IncludeFile(SITE_DIR."include/top-header-text.php",Array(), Array("MODE"=>"html"));?>
         </div>
         <ul class="top-header-contacts">
            <li class="template-phone">
                <?$APPLICATION->IncludeFile(SITE_DIR."include/phone.php",Array(), Array("MODE"=>"html"));?>
            </li>
            <li class="template-mail">
                <?$APPLICATION->IncludeFile(SITE_DIR."include/email.php",Array(), Array("MODE"=>"html"));?>
            </li>
            <li>
                <?$APPLICATION->IncludeFile(SITE_DIR."include/call-button.php",Array(), Array("MODE"=>"html"));?>
            </li>
         </ul>
      </div>
   </div>
    <div class="header-container">
        <div class="vertical-align-table column-1-1">
            <div class="header clearfix">
                <?$APPLICATION->IncludeComponent(
                  "bitrix:menu",
                  "main_menu",
                  array(
                     "ALLOW_MULTI_SELECT" => "N",
                     "CHILD_MENU_TYPE" => "left",
                     "DELAY" => "N",
                     "MAX_LEVEL" => "4",
                     "MENU_CACHE_GET_VARS" => array(
                     ),
                     "MENU_CACHE_TIME" => "3600",
                     "MENU_CACHE_TYPE" => "N",
                     "MENU_CACHE_USE_GROUPS" => "Y",
                     "ROOT_MENU_TYPE" => "top",
                     "USE_EXT" => "Y",
                     "COMPONENT_TEMPLATE" => "main_menu"
                  ),
                  false
               );?>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:search.form",
                    "search",
                    array(
                        "PAGE" => "#SITE_DIR#search/",
                        "COMPONENT_TEMPLATE" => "search"
                    ),
                    false
                );?>
            </div>
        </div>
    </div>
<div class="theme-page padding-bottom-70">
   <div class="row full-width page-header vertical-align-table">
      <div class="row full-width padding-top-bottom-50 vertical-align-cell">
         <div class="row">
            <div class="page-header-left">
               <h1><?$APPLICATION->ShowTitle(false)?></h1>
            </div>
            <div class="page-header-right">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:breadcrumb",
                    "breadcrumb",
                    Array(
                        "PATH" => "",
                        "SITE_ID" => "s1",
                        "START_FROM" => "0"
                    )
                );?>
            </div>
         </div>
      </div>
   </div>
   <div class="clearfix">
      <div class="row margin-top-50">
         <div class="column column-1-4" id="fly_sidebar">
            <div class="re-smart-column-wrapper">
             <?$APPLICATION->IncludeComponent(
               "bitrix:menu",
               "left_menu",
               array(
                  "ALLOW_MULTI_SELECT" => "N",
                  "CHILD_MENU_TYPE" => "bottom",
                  "DELAY" => "N",
                  "MAX_LEVEL" => "2",
                  "MENU_CACHE_GET_VARS" => array(
                  ),
                  "MENU_CACHE_TIME" => "3600000",
                  "MENU_CACHE_TYPE" => "A",
                  "MENU_CACHE_USE_GROUPS" => "N",
                  "ROOT_MENU_TYPE" => "left",
                  "USE_EXT" => "Y",
                  "COMPONENT_TEMPLATE" => "left_menu"
               ),
               false
            );?>
             <?$APPLICATION->ShowViewContent('catalog_filter')?>
             <?if(strpos($APPLICATION->GetCurDIr(), 'catalog') === false):?>
             <?$APPLICATION->IncludeComponent(
                 "roman:light.akcii",
                 "",
                 Array(
                     "CACHE_TIME" => "36000000",
                     "CACHE_TYPE" => "A",
                     "IBLOCK_ID" => "#IB_AKTSII#",
                     "IBLOCK_TYPE" => "content",
                 ),
                 false
             );?>
             <?$APPLICATION->IncludeComponent(
                 "roman:light.advice",
                 "",
                 Array(
                     "CACHE_TIME" => "36000000",
                     "CACHE_TYPE" => "A",
                     "IBLOCK_ID" => "#IB_ADVICE#",
                     "IBLOCK_TYPE" => "content",
                 ),
                 false
             );?>
             <?endif;?>
             <?$APPLICATION->ShowViewContent('min_size_land_photo')?>
             <?$APPLICATION->ShowViewContent('files')?>
         </div>
      </div>
      <div class="column column-3-4">


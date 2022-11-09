<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
$frame = new \Bitrix\Main\Page\FrameBuffered("advice");
$frame->begin();
?>
<?$random = rand(0,count($arResult)-1)?>
<h6 class="box-header page-margin-top"><?=$arResult[$random]['NAME']?></h6>
<p class="margin-top-10"><?=$arResult[$random]['PREVIEW_TEXT']?></p>
<?$frame->beginStub();?>
   <h6 class="box-header page-margin-top"><?=$arResult[$random]['NAME']?></h6>
   <p class="margin-top-10"><?=$arResult[$random]['PREVIEW_TEXT']?></p>
<?$frame->end();?>
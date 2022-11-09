<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeModuleLangFile(__FILE__);
$frame = new \Bitrix\Main\Page\FrameBuffered("akcii");
$frame->begin();
?>
<?$random = rand(0,count($arResult)-1)?>
<div class="call-to-action detail-action" style="margin-right:0;">
    <div class="hexagon small"><div class="sl-small-percent"></div></div>
    <h4 class="margin-top-58"><?=$arResult[$random]['NAME']?></h4>
    <p class="description">
       <?if($arResult[$random]['DATE_FROM'] && $arResult[$random]['DATE_TO']):?>
        <span class="action-date"><?=GetMessage('with')?> <?=$arResult[$random]['DATE_FROM']?> <?=GetMessage('at')?> <?=$arResult[$random]['DATE_TO']?></span>
        <?endif;?>
      <?=$arResult[$random]['PREVIEW_TEXT']?>
   </p>
</div>
<?$frame->beginStub();?>
   <div class="call-to-action detail-action" style="margin-right:0;">
      <div class="hexagon small"><div class="sl-small-percent"></div></div>
      <h4 class="margin-top-58">Xxxxxxxxx</h4>
      <p class="description">
         <span class="action-date">C xx.xx.xxxx по xx.xx.xxxx </span>
         xxxxxxx xxxxxx xxxx xxxxxxx</p>
   </div>
<?$frame->end();?>
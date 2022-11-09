<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<div class="row">
   <?foreach($arResult["ITEMS"] as $arItem):?>
   <?
   $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
   $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
   ?>
   <div class="call-to-action col-3 detail-action" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
      <div class="hexagon small"><div class="sl-small-percent"></div></div>
      <h4 class="margin-top-58"><?=$arItem['NAME']?></h4>
      <p class="description">
         <?if($arItem['DATE_FROM'] && $arItem['DATE_TO']):?>
         <span class="action-date"><?=GetMessage('WITH')?> <?=$arItem['DATE_FROM']?> <?=GetMessage('AT')?> <?=$arItem['DATE_TO']?></span>
         <?endif;?>
         <?=$arItem['PREVIEW_TEXT']?>
      </p>
   </div>
   <?endforeach;?>
</div>


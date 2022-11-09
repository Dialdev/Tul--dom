<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<div class="row">
   <?foreach($arResult["ITEMS"] as $arItem):?>
   <?
   $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
   $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
   $image = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'],["width" => 215, "height" => 303], BX_RESIZE_IMAGE_PROPORTIONAL);
   ?>
   <div class="call-to-action col-3 detail-action" style="min-height:390px;" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
      <a href="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" class="gallery">
         <img src="<?=$image['src']?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>">
      </a>
      <h6><?=$arItem['NAME']?></h6>
   </div>
   <?endforeach;?>
</div>
<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<div class="row">
   <div class="our-clients-list-container page-margin-top logo-carusel">
      <ul class="our-clients-list">
          <?foreach($arResult["ITEMS"] as $arItem):?>
              <?
              $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
              $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
              ?>
         <li id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <img class="logo-brands" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>" title="<?=$arItem['PREVIEW_PICTURE']['TITLE']?>">
         </li>
          <?endforeach;?>
      </ul>
      <div class="our-clients-pagination"></div>
   </div>
</div>

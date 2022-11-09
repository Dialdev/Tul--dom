<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<div class="row full-width page-margin-top-section">
   <ul class="galleries-list clearfix page-margin-top">
       <?foreach($arResult["ITEMS"] as $arItem):?>
           <?
           $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
           $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
           ?>
      <li id="<?=$this->GetEditAreaId($arItem['ID']);?>">
         <a href="<?=$arItem['DETAIL_PAGE_URL']?>" title="<?=$arItem['NAME']?>">
            <img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>" title="<?=$arItem['PREVIEW_PICTURE']['TITLE']?>">
         </a>
         <div class="view align-center">
            <div class="vertical-align-table">
               <div class="vertical-align-cell">
                  <p class="description"><?=$arItem['NAME']?></p>
                  <a class="more simple" href="<?=$arItem['DETAIL_PAGE_URL']?>" title="<?=GetMessage('READ_MORE')?>"><?=GetMessage('READ_MORE')?></a>
               </div>
            </div>
         </div>
      </li>
       <?endforeach;?>
   </ul>
</div>
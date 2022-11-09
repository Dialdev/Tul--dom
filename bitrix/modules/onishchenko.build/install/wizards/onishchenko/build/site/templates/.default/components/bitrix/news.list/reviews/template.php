<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<div class="row full-width padding-top-70 padding-bottom-66 parallax parallax-1">
   <div class="row testimonials-container">
      <a href="#" class="slider-control left template-arrow-left-1"></a>
      <ul class="testimonials-list">
          <?foreach($arResult["ITEMS"] as $arItem):?>
          <?
          $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
          $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
              $min_photo = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'],["width" => 100, "height" => 100], BX_RESIZE_IMAGE_PROPORTIONAL);
          ?>
         <li id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="client-review-container">
               <div class="photo">
                  <img src="<?=$min_photo['src']?>" alt="<?=$arItem['NAME']?>">
               </div>
               <div class="client-about">
                  <h6><?=$arItem['NAME']?></h6>
                  <?if($arItem['PROPERTIES']['SERVICE']['VALUE']):?>
                  <p><?=$arItem['PROPERTIES']['SERVICE']['VALUE']?></p>
                  <?endif;?>
               </div>

            </div>
            <p  class="review-text">
               <span class="quotes">"</span>
                <?=$arItem['PREVIEW_TEXT']?>
               <span class="quotes">"</span>
            </p>

         </li>
          <?endforeach;?>
      </ul>
      <a href="#" class="slider-control right template-arrow-left-1"></a>
   </div>
</div>
<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<div class="row">
   <div class="our-clients-list-container page-margin-top car-carusel">
      <ul class="our-clients-list">
          <?foreach($arResult["ITEMS"] as $arItem):?>
              <?
              $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
              $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
              if($arItem['PREVIEW_PICTURE']){
                  $image = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], ["width" => 287, "height" => 192], BX_RESIZE_IMAGE_PROPORTIONAL);
              }
              else{
                  $image['src'] = DEFAULT_TEMPLATE_PATH . '/images/no-photo.gif';
              }
              ?>
         <li id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <img src="<?=$image['src']?>" alt="<?=$arItem['NAME']?>">
            <div class="car-carusel-hover">
               <p class="description"><?=$arItem['NAME']?></p>
               <a href="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" class="gallery show-big-photo template-search"></a>
               <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="show-big-photo">...</a>
            </div>
         </li>
          <?endforeach;?>
      </ul>
      <div class="our-clients-pagination"></div>
   </div>
</div>
<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<ul class="blog services clearfix">
    <?foreach($arResult["ITEMS"] as $arItem):?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        if($arItem['PREVIEW_PICTURE']){
            $image = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], ["width" => 270, "height" => 180], BX_RESIZE_IMAGE_PROPORTIONAL);
        }
        else{
            $image['src'] = DEFAULT_TEMPLATE_PATH . '/images/no-photo.gif';
        }
    ?>
   <li class="row" id="<?=$this->GetEditAreaId($arItem['ID']);?>" style="margin-bottom:40px">
      <a href="<?=$arItem['DETAIL_PAGE_URL']?>" title="<?=$arItem['NAME']?>" class="post-image">
         <img width="100%" class="list-img" src="<?=$image['src']?>" alt="<?=$arItem['NAME']?>">
      </a>
      <div class="service-container catalog-item-container">
         <h3>
            <a href="<?=$arItem['DETAIL_PAGE_URL']?>">
                <?=$arItem['NAME']?>
               <?if($arItem['PROPERTIES']['PRICE']['VALUE']):?>
                 - <?=number_format($arItem['PROPERTIES']['PRICE']['VALUE'],false, false, ' ')?> &#8381;
               <?endif;?>
            </a>
         </h3>
         <div class="catalog-parameters-container first">
            <div class="list-container">
               <div class="list-icon-container">
                  <img src="<?=DEFAULT_TEMPLATE_PATH?>/images/list_icon/size.png" alt="size">
               </div>
               <span>
                  <?=GetMessage('SIZE_LAND')?><br>
                  <b><?if($arItem['PROPERTIES']['MIN_SIZE_LAND']['VALUE']):?><?=$arItem['PROPERTIES']['MIN_SIZE_LAND']['VALUE']?><?else:?><?=GetMessage('NONE')?><?endif;?></b>
               </span>
            </div>
            <div class="list-container">
               <div class="list-icon-container">
                  <img src="<?=DEFAULT_TEMPLATE_PATH?>/images/list_icon/calendar.png" alt="calendar">
               </div>
               <span>
                  <?=GetMessage('CONSTRUCTION_TIME')?><br>
                  <b><?if($arItem['PROPERTIES']['SROK_STROITELSTVA']['VALUE']):?><?=$arItem['PROPERTIES']['SROK_STROITELSTVA']['VALUE']?><?else:?><?=GetMessage('NONE')?><?endif;?></b>
               </span>
            </div>
         </div>
         <div class="catalog-parameters-container">
            <div class="list-container">
               <div class="list-icon-container">
                  <img src="<?=DEFAULT_TEMPLATE_PATH?>/images/list_icon/square.png" alt="square">
               </div>
               <span>
                  <?=GetMessage('SQUARE')?><br>
                  <b><?if($arItem['PROPERTIES']['PLOSHCHAD']['VALUE']):?><?=$arItem['PROPERTIES']['PLOSHCHAD']['VALUE']?> <?=GetMessage('METER')?><sup>2</sup><?else:?><?=GetMessage('NONE')?><?endif;?></b>
               </span>
            </div>
            <div class="list-container">
               <div class="list-icon-container">
                  <img src="<?=DEFAULT_TEMPLATE_PATH?>/images/list_icon/count_room.png" alt="count room">
               </div>
               <span>
                  <?=GetMessage('COUNT_ROOM')?><br>
                  <b><?if($arItem['PROPERTIES']['COUNT_ROOMS']['VALUE']):?><?=$arItem['PROPERTIES']['COUNT_ROOMS']['VALUE']?><?else:?><?=GetMessage('NONE')?><?endif;?></b>
               </span>
            </div>
         </div>
      </div>
   </li>
       <div style="clear:both;"></div>
    <?endforeach;?>
</ul>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
   <br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
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
               <?if($arItem['PROPERTIES']['PLOSHCHAD']['VALUE']):?>
                   <?=$arItem['NAME']?>, <?=$arItem['PROPERTIES']['PLOSHCHAD']['VALUE']?> <span class="square"> <?=GetMessage('METER')?><sup>2</sup></span>
               <?else:?>
                   <?=$arItem['NAME']?>
               <?endif;?>
            </a>
         </h3>
         <p class="service-text">
            <?=$arItem['PREVIEW_TEXT']?>
         </p>
         <?if($arItem['PROPERTIES']['POSITION']['VALUE']):?>
         <span><?=GetMessage('LAND')?>: <b><?=$arItem['PROPERTIES']['POSITION']['VALUE']?></b></span>
         <?endif;?>
         <div style="margin-top:10px;">
            <a class="more" href="<?=$arItem['DETAIL_PAGE_URL']?>" title="<?=GetMessage('READ_MORE')?>"><span><?=GetMessage('READ_MORE')?></span></a>
         </div>

      </div>
   </li>
       <div style="clear:both;"></div>
    <?endforeach;?>
</ul>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
   <br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
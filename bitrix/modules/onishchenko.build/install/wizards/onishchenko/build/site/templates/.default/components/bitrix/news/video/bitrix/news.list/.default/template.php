<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<ul class="blog clearfix">
    <?foreach($arResult["ITEMS"] as $arItem):?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
   <li id="<?=$this->GetEditAreaId($arItem['ID']);?>" style="margin-bottom:40px">
      <a href="<?=$arItem['DETAIL_PAGE_URL']?>" title="<?=$arItem['NAME']?>" class="post-image">
         <img width="100%" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['PREVIEW_PICTURE']['TITLE']?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>">
      </a>
      <div class="post-content-details-container clearfix">
         <ul class="post-content-details">
            <li><?=$arItem['DISPLAY_ACTIVE_FROM']?></li>
            <li><?=GetMessage('AUTHOR')?>: <?=strstr($arItem['CREATED_USER_NAME'],' ')?></a></li>
            <li class="template-eye"><?=($arItem['SHOW_COUNTER']) ? $arItem['SHOW_COUNTER'] : 0 ?></li>
         </ul>
      </div>
      <h3 class="box-header"><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a></h3>
      <p>
          <?=$arItem['PREVIEW_TEXT']?>
      </p>
      <div class="row margin-top-40 padding-bottom-20">
         <a class="more" href="<?=$arItem['DETAIL_PAGE_URL']?>" title="<?=GetMessage('READ_MORE')?>"><span><?=GetMessage('READ_MORE')?></span></a>
      </div>
   </li>
    <?endforeach;?>
</ul>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
   <br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
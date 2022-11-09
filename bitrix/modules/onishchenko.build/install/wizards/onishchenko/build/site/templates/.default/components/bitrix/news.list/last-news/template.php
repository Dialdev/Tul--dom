<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>

<h6 class="box-header page-margin-top"><?=GetMessage('TYPICAL_PROJECTS')?></h6>
<ul class="blog small clearfix">
    <?foreach($arResult["ITEMS"] as $arItem):?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        if($arItem['PREVIEW_PICTURE']){
            $image = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], ["width" => 90, "height" => 60], BX_RESIZE_IMAGE_PROPORTIONAL);
        }
        else{
            $image['src'] = DEFAULT_TEMPLATE_PATH . '/images/no-photo.gif';
        }
        ?>
       <li id="<?=$this->GetEditAreaId($arItem['ID']);?>">
          <a href="<?=$arItem['DETAIL_PAGE_URL']?>" title="<?=$arItem['NAME']?>" class="post-image">
             <img src="<?=$image['src']?>" alt="<?=$arItem['NAME']?>" style="display:block;width:90px;">
          </a>
          <div class="post-content">
             <a href="<?=$arItem['DETAIL_PAGE_URL']?>" title="<?=$arItem['NAME']?>"><?=$arItem['NAME']?> <?=$arItem['PROPERTIES']['YEAR']['VALUE']?></a>
             <ul class="post-details">
                <li class="date"><?=GetMessage('SQUARE')?> <?=$arItem['PROPERTIES']['PLOSHCHAD']['VALUE']?> <span class="square"><?=GetMessage('METER')?><sup style="font-size:10px;">2</sup></span></li>
             </ul>
          </div>
       </li>
    <?endforeach;?>
</ul>
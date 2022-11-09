<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<h3 class="box-header"><?=GetMessage('POPULAR_QUESTIONS')?></h3>
<ul class="accordion margin-top-40 clearfix">
   <?$i = 1;?>
    <?foreach($arResult["ITEMS"] as $arItem):?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
   <li id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="my-item" data-id="<?=$i?>">
      <h4 class="my-accordion">
          <?if($i == 1):?>
         <span class="my-icon template-arrow-circle-down"></span>
          <?else:?>
             <span class="my-icon template-arrow-circle-right"></span>
          <?endif;?>
          <?=$arItem['NAME']?>
      </h4>
      <p class="my-accordion-text" <?if($i == 1):?>style="display:block;"<?endif;?>><?=$arItem['PREVIEW_TEXT']?></p>
   </li>
        <?$i++;?>
    <?endforeach;?>
</ul>

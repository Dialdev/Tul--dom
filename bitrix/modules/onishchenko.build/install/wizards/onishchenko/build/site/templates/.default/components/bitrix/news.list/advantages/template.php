<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<div class="row page-margin-top ">
   <?$i = 0;?>
    <?foreach($arResult["ITEMS"] as $arItem):?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
   <div class="column column-1-3 my-column <?if($i % 3 == 0 ):?>first-advantages<?endif;?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
      <ul class="features-list big">
         <li>
            <div class="hexagon"><div class="sl-small-wrench-screwdriver"></div></div>
            <h4 class="box-header page-margin-top my-h4"><?=$arItem['NAME']?></h4>
            <p><?=$arItem['PREVIEW_TEXT']?></p>
         </li>
      </ul>
   </div>
        <?$i ++;?>
    <?endforeach;?>
</div>
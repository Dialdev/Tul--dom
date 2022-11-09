<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
   <div class="tab-jobs active-job all"><?=GetMessage('ALL_QUESTIONS')?></div>
<?foreach($arResult['SECTIONS'] as $section):?>
   <div class="tab-jobs" data-sectionid="<?=$section['ID']?>"><?=$section['NAME']?></div>
<?endforeach;?>
   <ul class="accordion margin-top-40 clearfix">
      <?$i = 1;?>
       <?foreach($arResult['ITEMS'] as $arItem):?>
           <?
           $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
           $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
           ?>
      <li id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="my-item" data-id="<?=$i?>" data-itemsectionid="<?=$arItem['IBLOCK_SECTION_ID']?>">
         <h4 class="my-accordion">
             <?if($i == 1):?>
                <span class="my-icon template-arrow-circle-down"></span>
             <?else:?>
                <span class="my-icon template-arrow-circle-right"></span>
             <?endif;?>
             <?=$arItem['NAME']?>
         </h4>
         <div class="my-accordion-text" <?if($i == 1):?>style="display:block;"<?endif;?>>
            <p class="jobs-demand">
               <?=$arItem['PREVIEW_TEXT']?>
            </p>
         </div>
      </li>
      <?$i++;?>
      <?endforeach;?>
   </ul>





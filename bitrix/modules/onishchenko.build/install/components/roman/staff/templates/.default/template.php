<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<?foreach($arResult as $arItem):?>
<div class="row staff-row">
   <h3 style="margin-bottom:30px;"><?=$arItem['NAME']?></h3>
    <?foreach( $arItem['ITEMS'] as $staff):?>
        <?
        $this->AddEditAction($staff['ID'], $staff['EDIT_LINK'], CIBlock::GetArrayByID($staff["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($staff['ID'], $staff['DELETE_LINK'], CIBlock::GetArrayByID($staff["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
       <div class="staff-container" id="<?=$this->GetEditAreaId($staff['ID']);?>">
          <img src="<?=$staff['IMG']?>" alt="<?=$staff['NAME']?>" class="staff-photo">
          <div class="staff-info-container">
             <h5><?=$staff['NAME']?></h5>
             <span class="staff-rang"><?=$staff['PREVIEW_TEXT']?></span>
             <span> Email: <?=$staff['PROPERTY_EMAIL_VALUE']?></span>
          </div>
          <a href="#form_question" data-email="<?=$staff['PROPERTY_EMAIL_VALUE']?>" data-staffid="<?=$staff['ID']?>" data-staffname="<?=$staff['NAME']?>" class="more ask-question" style="padding:10px;"><?=GetMessage('QUESTION')?></a>
       </div>
    <?endforeach;?>
</div>
<?endforeach;?>




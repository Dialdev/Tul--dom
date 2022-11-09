<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>

<?if (!empty($arResult)):?>
<div class="column column-1-4">
   <h6 class="box-header"><?=GetMessage('OUR_SERVICES')?></h6>
   <ul class="list margin-top-20">
   <?
   foreach($arResult as $arItem):
      if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
         continue;
   ?>
      <li class="template-bullet">
         <a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
      </li>
   <?endforeach?>
   </ul>
</div>
<?endif?>

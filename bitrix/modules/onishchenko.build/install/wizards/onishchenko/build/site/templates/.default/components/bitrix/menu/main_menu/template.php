<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<?if (!empty($arResult)):?>
   <a href="#" class="mobile-menu-switch vertical-align-cell">
      <span class="line"></span>
      <span class="line"></span>
      <span class="line"></span>
   </a>
   <div class="menu-container clearfix vertical-align-cell">
   <nav>
   <ul class="sf-menu">
<?
$previousLevel = 0;
foreach($arResult as $arItem):?>
	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>
	<?if ($arItem["IS_PARENT"]):?>
		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<li <?if ($arItem["SELECTED"]):?>class="selected"<?endif?>><a href="<?=$arItem["LINK"]?>" title="<?=$arItem["TEXT"]?>"><?=$arItem["TEXT"]?></a>
				<ul>
		<?else:?>
			<li><a href="<?=$arItem["LINK"]?>" title="<?=$arItem["TEXT"]?>"><?=$arItem["TEXT"]?><span style="float: right;font-size: 10px;" class="template-arrow-menu"></span></a>
				<ul>
		<?endif?>
	<?else:?>
		<?if ($arItem["PERMISSION"] > "D"):?>
			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li <?if ($arItem["SELECTED"]):?>class="selected"<?endif?>><a href="<?=$arItem["LINK"]?>" title="<?=$arItem["TEXT"]?>"><?=$arItem["TEXT"]?></a></li>
			<?else:?>
				<li><a href="<?=$arItem["LINK"]?>" title="<?=$arItem["TEXT"]?>"><?=$arItem["TEXT"]?></a></li>
			<?endif?>
		<?endif?>
	<?endif?>
	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>
<?endforeach?>
<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>
         </ul>
</nav>
    <?/*Мобильное меню*/?>
   <div class="mobile-menu-container">
      <div class="mobile-menu-divider"></div>
      <nav>
         <ul class="mobile-menu collapsible-mobile-submenus">
             <?
             $previousLevel = 0;
             foreach($arResult as $arItem):?>
             <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
                 <?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
             <?endif?>
             <?if ($arItem["IS_PARENT"]):?>
                <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                  <li <?if ($arItem["SELECTED"]):?>class="selected"<?endif?>><a href="<?=$arItem["LINK"]?>" title="<?=$arItem["TEXT"]?>"><?=$arItem["TEXT"]?></a>
                  <a href="#" class="template-arrow-menu"></a>
                  <ul>
               <?else:?>
                  <li><a href="<?=$arItem["LINK"]?>" title="<?=$arItem["TEXT"]?>"><?=$arItem["TEXT"]?></a>
                     <a href="#" class="template-arrow-menu"></a>
                  <ul>
               <?endif?>
            <?else:?>
               <?if ($arItem["PERMISSION"] > "D"):?>
                  <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                   <li <?if ($arItem["SELECTED"]):?>class="selected"<?endif?>><a href="<?=$arItem["LINK"]?>" title="<?=$arItem["TEXT"]?>"><?=$arItem["TEXT"]?></a></li>
                  <?else:?>
                   <li><a href="<?=$arItem["LINK"]?>" title="<?=$arItem["TEXT"]?>"><?=$arItem["TEXT"]?></a></li>
                  <?endif?>
               <?endif?>
            <?endif?>
            <?$previousLevel = $arItem["DEPTH_LEVEL"];?>
            <?endforeach?>
            <?if ($previousLevel > 1)://close last item tags?>
              <?=str_repeat("</ul></li>", ($previousLevel-1) );?>
            <?endif?>
         </ul>
      </nav>
   </div>
    <?/*Мобильное меню[конец]*/?>
   </div>
<?endif?>
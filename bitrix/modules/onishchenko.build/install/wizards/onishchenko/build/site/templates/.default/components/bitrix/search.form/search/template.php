<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<div class="search-container">
   <a class="template-search top-search" href="#" title="Search"></a>
   <form class="search" action="<?=$arResult["FORM_ACTION"]?>">
      <input type="text" name="q" placeholder="Search..." class="search-input hint">
      <fieldset class="search-submit-container">
         <span class="template-search"></span>
         <input name="s" class="search-submit" type="submit" value="" >
      </fieldset>
   </form>
</div>
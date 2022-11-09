<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
IncludeModuleLangFile(__FILE__);
if( !empty($arResult['DISPLAY_PROPERTIES']['FILES']['FILE_VALUE'])):
    ob_start();
    ?>
   <h6 class="box-header page-margin-top"><?=GetMessage('FILES')?></h6>
   <div class="files-wrap">
       <?if(is_array($arResult['DISPLAY_PROPERTIES']['FILES']['FILE_VALUE'][0])):?>
           <?foreach($arResult['DISPLAY_PROPERTIES']['FILES']['FILE_VALUE'] as $file):?>
               <?
               if($file['CONTENT_TYPE'] == 'application/pdf'){
                   $img = DEFAULT_TEMPLATE_PATH.'/images/pdf.png';
               }
               elseif($file['CONTENT_TYPE'] == 'application/msword'){
                   $img = DEFAULT_TEMPLATE_PATH.'/images/msword.png';
               }
               elseif($file['CONTENT_TYPE'] == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                   || $file['CONTENT_TYPE'] == 'application/vnd.ms-excel'
               ){
                   $img = DEFAULT_TEMPLATE_PATH.'/images/exel.png';
               }
               else{
                   $img = DEFAULT_TEMPLATE_PATH.'/images/file.png';
               }
               ?>
             <a href="<?=$file['SRC']?>" title="<?=$file['ORIGINAL_NAME']?>" class="download file-container" data-type="<?=$file['CONTENT_TYPE']?>" data-src="<?=$file['SRC']?>" data-name="<?=$file['ORIGINAL_NAME']?>">
                <div class="file-icon">
                   <img src="<?=$img?>" alt="<?=$file['ORIGINAL_NAME']?>">
                </div>
                <span class="file-name"><?=$file['ORIGINAL_NAME']?></span>
             </a>
           <?endforeach;?>
       <?else:?>
           <?
           if($arResult['DISPLAY_PROPERTIES']['FILES']['FILE_VALUE']['CONTENT_TYPE'] == 'application/pdf'){
               $img = DEFAULT_TEMPLATE_PATH.'/images/pdf.png';
           }
           elseif($file['CONTENT_TYPE'] == 'application/msword'){
               $img = DEFAULT_TEMPLATE_PATH.'/images/msword.png';
           }
           elseif($file['CONTENT_TYPE'] == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
               || $file['CONTENT_TYPE'] == 'application/vnd.ms-excel'
           ){
               $img = DEFAULT_TEMPLATE_PATH.'/images/exel.png';
           }
           else{
               $img = DEFAULT_TEMPLATE_PATH.'/images/file.png';
           }
           ?>
          <a href="<?=$arResult['DISPLAY_PROPERTIES']['FILES']['FILE_VALUE']['SRC']?>"
             title="<?=$arResult['DISPLAY_PROPERTIES']['FILES']['FILE_VALUE']['ORIGINAL_NAME']?>"
             class="download file-container"
             data-type="<?=$arResult['DISPLAY_PROPERTIES']['FILES']['FILE_VALUE']['CONTENT_TYPE']?>"
             data-src="<?=$arResult['DISPLAY_PROPERTIES']['FILES']['FILE_VALUE']['SRC']?>"
             data-name="<?=$arResult['DISPLAY_PROPERTIES']['FILES']['FILE_VALUE']['ORIGINAL_NAME']?>"
          >
             <div class="file-icon">
                <img src="<?=$img?>" alt="<?=$arResult['DISPLAY_PROPERTIES']['FILES']['FILE_VALUE']['ORIGINAL_NAME']?>">
             </div>
             <span class="file-name"><?=$arResult['DISPLAY_PROPERTIES']['FILES']['FILE_VALUE']['ORIGINAL_NAME']?></span>
          </a>

       <?endif;?>
   </div>
    <?php
    $files =  ob_get_clean();
    $APPLICATION->AddViewContent('files',$files);
endif;

if($arResult['DISPLAY_PROPERTIES']['MIN_SIZE_LAND_PHOTO']['FILE_VALUE']):
    ob_start();
    ?>
   <div class="square-land-param">
      <h6 class="box-header"><?=GetMessage('MIN_SIZE_LAND')?></h6>
      <img src="<?=$arResult['DISPLAY_PROPERTIES']['MIN_SIZE_LAND_PHOTO']['FILE_VALUE']['SRC']?>"
           alt="<?=GetMessage('LAND')?>">
   </div>
    <?php
    $min_size_land_photo =  ob_get_clean();
    $APPLICATION->AddViewContent('min_size_land_photo',$min_size_land_photo);
endif;
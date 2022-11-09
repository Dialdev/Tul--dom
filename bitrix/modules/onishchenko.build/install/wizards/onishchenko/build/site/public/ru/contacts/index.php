<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
?>
   <div class="row margin-top-50">
      <div class="column column-3-4">
         <div class="contact-map" id="map">
             <?$APPLICATION->IncludeComponent(
                 "bitrix:map.yandex.view",
                 ".default",
                 array(
                     "CONTROLS" => array(
                         0 => "ZOOM",
                         1 => "SCALELINE",
                     ),
                     "INIT_MAP_TYPE" => "MAP",
                     "MAP_DATA" => "a:4:{s:10:\"yandex_lat\";d:55.75638944755924;s:10:\"yandex_lon\";d:37.579489364623996;s:12:\"yandex_scale\";i:14;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:3:\"LON\";d:37.5806051635742;s:3:\"LAT\";d:55.756728253730934;s:4:\"TEXT\";s:7:\"Мы тут!\";}}}",
                     "MAP_HEIGHT" => "450",
                     "MAP_ID" => "",
                     "MAP_WIDTH" => "100%",
                     "OPTIONS" => array(
                         0 => "ENABLE_DBLCLICK_ZOOM",
                         1 => "ENABLE_DRAGGING",
                     ),
                     "COMPONENT_TEMPLATE" => ".default"
                 ),
                 false
             );?>
         </div>
         <div class="row page-margin-top">
             <?$APPLICATION->IncludeFile(SITE_DIR."include/contacts-page.php",Array(), Array("MODE"=>"html"));?>
         </div>
          <?$APPLICATION->IncludeComponent(
              "roman:feedback_form",
              ".default",
              array(
                  "IBLOCK_ID" => "#IB_FEEDBACK#",
                  "IBLOCK_TYPE" => "content",
                  "EMAIL_TO" => "#EMAIL#",
                  "CACHE_TIME" => "36000000",
                  "CACHE_TYPE" => "A",
                  "COMPONENT_TEMPLATE" => ".default",
              ),
              false
          );?>
      </div>
      <div class="column column-1-4" id="fly_sidebar">
         <div class="re-smart-column-wrapper">
             <?$APPLICATION->IncludeComponent(
                 "roman:light.akcii",
                 "",
                 Array(
                     "CACHE_TIME" => "36000000",
                     "CACHE_TYPE" => "A",
                     "IBLOCK_ID" => "#IB_AKTSII#",
                     "IBLOCK_TYPE" => "content",
                 ),
                 false
             );?>
             <?$APPLICATION->IncludeComponent(
                 "bitrix:news.list",
                 "last-news",
                 array(
                     "ACTIVE_DATE_FORMAT" => "d.m.Y",
                     "ADD_SECTIONS_CHAIN" => "N",
                     "AJAX_MODE" => "N",
                     "AJAX_OPTION_ADDITIONAL" => "",
                     "AJAX_OPTION_HISTORY" => "N",
                     "AJAX_OPTION_JUMP" => "N",
                     "AJAX_OPTION_STYLE" => "N",
                     "CACHE_FILTER" => "N",
                     "CACHE_GROUPS" => "N",
                     "CACHE_TIME" => "36000000",
                     "CACHE_TYPE" => "A",
                     "CHECK_DATES" => "Y",
                     "DISPLAY_BOTTOM_PAGER" => "N",
                     "DISPLAY_DATE" => "Y",
                     "DISPLAY_NAME" => "Y",
                     "DISPLAY_PICTURE" => "Y",
                     "DISPLAY_PREVIEW_TEXT" => "Y",
                     "DISPLAY_TOP_PAGER" => "N",
                     "FIELD_CODE" => array(
                         0 => "",
                         1 => "",
                     ),
                     "FILTER_NAME" => "",
                     "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                     "IBLOCK_ID" => "#IB_CATALOG#",
                     "IBLOCK_TYPE" => "content",
                     "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                     "INCLUDE_SUBSECTIONS" => "Y",
                     "MESSAGE_404" => "",
                     "NEWS_COUNT" => "3",
                     "PAGER_BASE_LINK_ENABLE" => "N",
                     "PAGER_DESC_NUMBERING" => "N",
                     "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                     "PAGER_SHOW_ALL" => "N",
                     "PAGER_SHOW_ALWAYS" => "N",
                     "PAGER_TITLE" => "",
                     "PARENT_SECTION" => "",
                     "PARENT_SECTION_CODE" => "",
                     "PREVIEW_TRUNCATE_LEN" => "",
                     "PROPERTY_CODE" => array(
                       0 => "PLOSHCHAD",
                     ),
                     "SET_BROWSER_TITLE" => "N",
                     "SET_LAST_MODIFIED" => "N",
                     "SET_META_DESCRIPTION" => "N",
                     "SET_META_KEYWORDS" => "N",
                     "SET_STATUS_404" => "N",
                     "SET_TITLE" => "N",
                     "SHOW_404" => "N",
                     "SORT_BY1" => "ACTIVE_FROM",
                     "SORT_BY2" => "SORT",
                     "SORT_ORDER1" => "DESC",
                     "SORT_ORDER2" => "ASC",
                     "STRICT_SECTION_CHECK" => "N",
                     "COMPONENT_TEMPLATE" => "last-news",
                     "DETAIL_URL" => "",
                     "PAGER_TEMPLATE" => ".default"
                 ),
                 false
             );?>
         </div>
      </div>
   </div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
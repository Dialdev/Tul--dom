<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Главная');
?>
<?$APPLICATION->IncludeComponent(
	"roman:slider",
	".default",
	array(
		"IBLOCK_TYPE" => "content",
		"IBLOCK_ID" => "#IB_SLIDER#",
		"COMPONENT_TEMPLATE" => ".default",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000"
	),
	false
);?>
   <div class="theme-page">
      <div class="clearfix">
          <?$APPLICATION->IncludeFile(SITE_DIR."include/index-text1.php",Array(), Array("MODE"=>"html"));?>
         <div class="row" id="customizer_append_container">
            <div class="row">
               <div class="row full-width mobile-padding" style="padding: 30px 0px 60px 0px;">
                  <div class="row">
                     <div style="margin-top:40px;"></div>
                      <?$APPLICATION->IncludeComponent(
                          "bitrix:catalog.section.list",
                          "index-sectionlist",
                          array(
                              "IBLOCK_TYPE" => 'content',
                              "IBLOCK_ID" => '#IB_CATALOG#',
                              "CACHE_TYPE" => 'A',
                              "CACHE_TIME" => '360000000',

                          ),
                          false
                      );?>
                  </div>
               </div>
                <?$APPLICATION->IncludeFile(SITE_DIR."include/index-why-choose-us.php",Array(), Array("MODE"=>"html"));?>
                <?$APPLICATION->IncludeFile(SITE_DIR."include/index-advantages.php",Array(), Array("MODE"=>"html"));?>
            </div>
         </div>
          <?
              global $arIndexReviewsFilter;
              $arIndexReviewsFilter = array(
                  array(
                      "LOGIC" => "OR",
                      array("=PROPERTY_SHOW_VALUE" => "Выводить только на главную"),
                      array("=PROPERTY_SHOW_VALUE" => "Выводить на главную и в разделе отзывы")
                  )
              );
              ?>
              <? $APPLICATION->IncludeComponent(
                  "bitrix:news.list",
                  "reviews",
                  array(
                      "ACTIVE_DATE_FORMAT" => "d.m.Y",
                      "ADD_SECTIONS_CHAIN" => "Y",
                      "AJAX_MODE" => "N",
                      "AJAX_OPTION_ADDITIONAL" => "",
                      "AJAX_OPTION_HISTORY" => "N",
                      "AJAX_OPTION_JUMP" => "N",
                      "AJAX_OPTION_STYLE" => "N",
                      "CACHE_FILTER" => "Y",
                      "CACHE_GROUPS" => "N",
                      "CACHE_TIME" => "36000000",
                      "CACHE_TYPE" => "A",
                      "CHECK_DATES" => "Y",
                      "DISPLAY_BOTTOM_PAGER" => "Y",
                      "DISPLAY_DATE" => "Y",
                      "DISPLAY_NAME" => "Y",
                      "DISPLAY_PICTURE" => "Y",
                      "DISPLAY_PREVIEW_TEXT" => "Y",
                      "DISPLAY_TOP_PAGER" => "N",
                      "FIELD_CODE" => array(
                          0 => "",
                          1 => "",
                      ),
                      "FILTER_NAME" => "arIndexReviewsFilter",
                      "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                      "IBLOCK_ID" => "#IB_REVIEWS#",
                      "IBLOCK_TYPE" => "content",
                      "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                      "INCLUDE_SUBSECTIONS" => "Y",
                      "MESSAGE_404" => "",
                      "NEWS_COUNT" => "4",
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
                          0 => "SHOW",
                          1 => "",
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
                      "COMPONENT_TEMPLATE" => "reviews",
                      "DETAIL_URL" => "",
                      "PAGER_TEMPLATE" => ".default"
                  ),
                  false
              );
          ?>
         <div class="row page-margin-top-section">
          <?$APPLICATION->IncludeFile(SITE_DIR."include/index-release-projects.php",Array(), Array("MODE"=>"html"));?>
          <?$APPLICATION->IncludeComponent(
              "bitrix:news.list",
              "carusel",
              Array(
                  "ACTIVE_DATE_FORMAT" => "d.m.Y",
                  "ADD_SECTIONS_CHAIN" => "Y",
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
                  "DISPLAY_BOTTOM_PAGER" => "Y",
                  "DISPLAY_DATE" => "Y",
                  "DISPLAY_NAME" => "Y",
                  "DISPLAY_PICTURE" => "Y",
                  "DISPLAY_PREVIEW_TEXT" => "Y",
                  "DISPLAY_TOP_PAGER" => "N",
                  "FIELD_CODE" => array("",""),
                  "FILTER_NAME" => "",
                  "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                  "IBLOCK_ID" => "#IB_PROJECTS#",
                  "IBLOCK_TYPE" => "content",
                  "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                  "INCLUDE_SUBSECTIONS" => "Y",
                  "MESSAGE_404" => "",
                  "NEWS_COUNT" => "20",
                  "PAGER_BASE_LINK_ENABLE" => "N",
                  "PAGER_DESC_NUMBERING" => "N",
                  "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                  "PAGER_SHOW_ALL" => "N",
                  "PAGER_SHOW_ALWAYS" => "N",
                  "PAGER_TITLE" => "",
                  "PARENT_SECTION" => "",
                  "PARENT_SECTION_CODE" => "",
                  "PREVIEW_TRUNCATE_LEN" => "",
                  "PROPERTY_CODE" => array("",""),
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
                  "STRICT_SECTION_CHECK" => "N"
              )
          );?>
      </div>
         <div class="row page-margin-top-section">
             <?$APPLICATION->IncludeFile(SITE_DIR."include/index-text3.php",Array(), Array("MODE"=>"html"));?>
            <div class="column column-1-2">
                <?
                global $arIndexQuestionsFilter;
                $arIndexQuestionsFilter = array(
                    "=PROPERTY_SHOW_VALUE" => "Да"
                );
                ?>
                <?$APPLICATION->IncludeComponent(
                  "bitrix:news.list",
                  "questions",
                  array(
                     "ACTIVE_DATE_FORMAT" => "d.m.Y",
                     "ADD_SECTIONS_CHAIN" => "Y",
                     "AJAX_MODE" => "N",
                     "AJAX_OPTION_ADDITIONAL" => "",
                     "AJAX_OPTION_HISTORY" => "N",
                     "AJAX_OPTION_JUMP" => "N",
                     "AJAX_OPTION_STYLE" => "N",
                     "CACHE_FILTER" => "Y",
                     "CACHE_GROUPS" => "N",
                     "CACHE_TIME" => "36000000",
                     "CACHE_TYPE" => "A",
                     "CHECK_DATES" => "Y",
                     "DISPLAY_BOTTOM_PAGER" => "Y",
                     "DISPLAY_DATE" => "Y",
                     "DISPLAY_NAME" => "Y",
                     "DISPLAY_PICTURE" => "Y",
                     "DISPLAY_PREVIEW_TEXT" => "Y",
                     "DISPLAY_TOP_PAGER" => "N",
                     "FIELD_CODE" => array(
                        0 => "",
                        1 => "",
                     ),
                     "FILTER_NAME" => "arIndexQuestionsFilter",
                     "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                     "IBLOCK_ID" => "#IB_QUESTIONS#",
                     "IBLOCK_TYPE" => "content",
                     "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                     "INCLUDE_SUBSECTIONS" => "Y",
                     "MESSAGE_404" => "",
                     "NEWS_COUNT" => "5",
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
                        0 => "",
                        1 => "",
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
                     "COMPONENT_TEMPLATE" => "questions",
                     "DETAIL_URL" => "",
                     "PAGER_TEMPLATE" => ".default"
                  ),
                  false
               );?>
            </div>
         </div>
         <div class="row full-width top-border page-margin-top-section padding-bottom-50">
             <?$APPLICATION->IncludeComponent(
                 "bitrix:news.list",
                 "logo-carusel",
                 Array(
                     "ACTIVE_DATE_FORMAT" => "d.m.Y",
                     "ADD_SECTIONS_CHAIN" => "Y",
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
                     "DISPLAY_BOTTOM_PAGER" => "Y",
                     "DISPLAY_DATE" => "Y",
                     "DISPLAY_NAME" => "Y",
                     "DISPLAY_PICTURE" => "Y",
                     "DISPLAY_PREVIEW_TEXT" => "Y",
                     "DISPLAY_TOP_PAGER" => "N",
                     "FIELD_CODE" => array("",""),
                     "FILTER_NAME" => "",
                     "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                     "IBLOCK_ID" => "#IB_LOGO#",
                     "IBLOCK_TYPE" => "content",
                     "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                     "INCLUDE_SUBSECTIONS" => "Y",
                     "MESSAGE_404" => "",
                     "NEWS_COUNT" => "20",
                     "PAGER_BASE_LINK_ENABLE" => "N",
                     "PAGER_DESC_NUMBERING" => "N",
                     "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                     "PAGER_SHOW_ALL" => "N",
                     "PAGER_SHOW_ALWAYS" => "N",
                     "PAGER_TITLE" => "",
                     "PARENT_SECTION" => "",
                     "PARENT_SECTION_CODE" => "",
                     "PREVIEW_TRUNCATE_LEN" => "",
                     "PROPERTY_CODE" => array("",""),
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
                     "STRICT_SECTION_CHECK" => "N"
                 )
             );?>
         </div>
      </div>
   </div>
<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');?>
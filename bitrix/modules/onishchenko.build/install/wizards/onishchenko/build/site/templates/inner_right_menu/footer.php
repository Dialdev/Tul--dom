<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)die();?>
<?use Bitrix\Main\Page\Asset; ?>
</div>
   <div class="column column-1-4" id="fly_sidebar">
      <div class="re-smart-column-wrapper">
          <?$APPLICATION->IncludeComponent(
              "bitrix:menu",
              "left_menu",
              array(
                  "ALLOW_MULTI_SELECT" => "N",
                  "CHILD_MENU_TYPE" => "bottom",
                  "DELAY" => "N",
                  "MAX_LEVEL" => "2",
                  "MENU_CACHE_GET_VARS" => array(
                  ),
                  "MENU_CACHE_TIME" => "3600000",
                  "MENU_CACHE_TYPE" => "A",
                  "MENU_CACHE_USE_GROUPS" => "N",
                  "ROOT_MENU_TYPE" => "left",
                  "USE_EXT" => "Y",
                  "COMPONENT_TEMPLATE" => "left_menu"
              ),
              false
          );?>
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
              "roman:light.advice",
              "",
              Array(
                  "CACHE_TIME" => "36000000",
                  "CACHE_TYPE" => "A",
                  "IBLOCK_ID" => "#IB_ADVICE#",
                  "IBLOCK_TYPE" => "content",
              ),
              false
          );?>
      </div>
   </div>
</div>
</div>
</div>
</div>
<div class="row dark-gray footer-row full-width padding-top-30 padding-bottom-50">
    <div class="row padding-bottom-30">
        <?$APPLICATION->IncludeFile(SITE_DIR."include/footer-address.php",Array(), Array("MODE"=>"html"));?>
        <?$APPLICATION->IncludeFile(SITE_DIR."include/footer-phone.php",Array(), Array("MODE"=>"html"));?>
        <?$APPLICATION->IncludeFile(SITE_DIR."include/footer-dop.php",Array(), Array("MODE"=>"html"));?>
    </div>
    <div class="row row-4-4 top-border page-padding-top">
        <div class="column column-1-4">
            <?$APPLICATION->IncludeFile(SITE_DIR."include/footer-about.php",Array(), Array("MODE"=>"html"));?>
        </div>
        <?$APPLICATION->IncludeComponent(
            "bitrix:menu",
            "bottom_menu",
            array(
                "ALLOW_MULTI_SELECT" => "N",
                "DELAY" => "N",
                "MAX_LEVEL" => "1",
                "MENU_CACHE_GET_VARS" => array(
                ),
                "MENU_CACHE_TIME" => "36000000",
                "MENU_CACHE_TYPE" => "A",
                "MENU_CACHE_USE_GROUPS" => "N",
                "ROOT_MENU_TYPE" => "bottom",
                "USE_EXT" => "N",
            ),
            false
        );?>
        <?$APPLICATION->IncludeFile(SITE_DIR."include/footer-social.php",Array(), Array("MODE"=>"html"));?>
        <?$APPLICATION->IncludeFile(SITE_DIR."include/footer-worktime.php",Array(), Array("MODE"=>"html"));?>
    </div>
</div>
<?$APPLICATION->IncludeFile(SITE_DIR."include/copyright.php",Array(), Array("MODE"=>"html"));?>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"></script>
<script>
    var recaptcha_open_key = "<?=COption::GetOptionString("main", "open_google_recaptcha_key", "")?>";
</script>
<?Asset::getInstance()->addJs(DEFAULT_TEMPLATE_PATH."/js/jquery.parallax.min.js");?>
<?Asset::getInstance()->addJs(DEFAULT_TEMPLATE_PATH."/js/main.js");?>
<?$APPLICATION->IncludeFile(SITE_DIR."include/footer-components.php",Array(), Array("MODE"=>"html"));?>
</body>
</html>
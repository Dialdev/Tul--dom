<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)die();
$this->addExternalJS(DEFAULT_TEMPLATE_PATH."/js/jquery.maskedinput.min.js");
$this->setFrameMode(true);
?>
<div class="form-window-wrap form-call">
   <div class="form-window">
      <div class="form-window-title">
         <h4><?=GetMessage('FORM_NAME')?></h4>
         <a href="#" class="close">&times;</a>
      </div>
      <div class="form-wrap">
         <p id="message" style="padding: 20px 0px 20px 0px;;color:red;font-weight:bold;"></p>
         <form class="contact-form">
            <input class="text-input" name="name" type="text"  placeholder="<?=GetMessage('NAME_CALL')?>">
            <input class="text-input" name="phone" type="text"  placeholder="<?=GetMessage('PHONE')?>">
            <textarea name="message" class="message" placeholder="<?=GetMessage('MESSAGE')?>"></textarea>
             <?=bitrix_sessid_post()?>
             <?if($arResult['RECAPTCHA'] == 'Y'):?>
            <div id="recaptcha-call-form" class="g-recaptcha" data-sitekey="<?=RECAPTCHA_OPEN_KEY?>"></div>
             <?endif;?>
         </form>
         <p><?=GetMessage('REQUIRE')?></p>
         <p class="personal"><?=GetMessage('POLITICA_CONF_1')?> <a href="<?=SITE_DIR?>company/politika-konfidentsialnosti/"><?=GetMessage('POLITICA_CONF_2')?></a></p>
         <a class="more submit-contact-form"  href="javascript:void(null)" title="<?=GetMessage('SEND')?>">
            <span><?=GetMessage('SEND')?></span>
         </a>
      </div>
   </div>
</div>
<script>
    var call_js_obj = {
        page:"<?=$APPLICATION->GetCurPage()?>",
        <?if($arResult['RECAPTCHA'] !== 'Y'):?>
        no_google_api: true,
        <?else:?>
        no_google_api: false,
        <?endif;?>
        APPLY_NO_ROBOT:"<?=GetMessage('APPLY_NO_ROBOT')?>",
        REQUIRED_FIELDS:"<?=GetMessage('REQUIRED_FIELDS')?>"
    }
</script>
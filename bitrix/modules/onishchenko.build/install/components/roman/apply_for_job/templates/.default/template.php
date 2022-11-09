<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<div id="form_job" style="display:none;">
   <h3 style="margin:30px 0px 0px 0px;"><?=GetMessage('FORM_NAME')?></h3>
   <p id="message" style="padding: 20px 0px 20px 0px;color:red;font-weight:bold;"></p>
   <form class="contact-form form-job">
      <div class="row">
         <fieldset class="column column-1-2">
            <input class="text-input" name="name" type="text"  placeholder="<?=GetMessage('NAME_')?>">
            <input class="text-input" name="email" type="text"  placeholder="<?=GetMessage('EMAIL')?>">
            <input class="text-input" disabled name="job" type="text">
             <?=bitrix_sessid_post()?>
             <?if($arResult['RECAPTCHA'] == 'Y'):?>
            <div id="recaptcha-job-form" class="g-recaptcha" data-sitekey="<?=RECAPTCHA_OPEN_KEY?>"></div>
            <?endif;?>
         </fieldset>
         <fieldset class="column column-1-2">
            <textarea name="resume" placeholder="<?=GetMessage('RESUME')?>"></textarea>
            <p>
                <?=GetMessage('REQUIRE')?><br>
                <?=GetMessage('POLITIKA_CONF_1')?> <a href="<?=SITE_DIR?>company/politika-konfidentsialnosti/"><?=GetMessage('POLITIKA_CONF_2')?></a>
            </p>
            <a class="more submit-contact-form"  href="javascript:void(null)" title="<?=GetMessage('SEND')?>"><span><?=GetMessage('SEND')?></span></a>
         </fieldset>
      </div>
   </form>
</div>
<script>
   var job_js_obj = {
       page:"<?=$APPLICATION->GetCurPage()?>",
      <?if($arResult['RECAPTCHA'] !== 'Y'):?>
      no_google_api: true,
      <?else:?>
      no_google_api: false,
      <?endif;?>
       CORRECT_EMAIL:"<?=GetMessage('CORRECT_EMAIL')?>",
       APPLY_NO_ROBOT:"<?=GetMessage('APPLY_NO_ROBOT')?>",
       REQUIRED_FIELDS:"<?=GetMessage('REQUIRED_FIELDS')?>"
   }
</script>
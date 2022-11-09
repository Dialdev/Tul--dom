<?
use \Bitrix\Main\Localization\Loc;
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");

Loc::LoadMessages(__FILE__);

$POST_RIGHT = $APPLICATION->GetGroupRight("onishchenko.build");
if ($POST_RIGHT == "D")
    $APPLICATION->AuthForm(Loc::getMessage('ACCESS_DENIED'));

$aTabs = array(
    array("DIV" => "fedit1", "TAB" => Loc::getMessage('google_repaptcha'), "ICON" => "main_settings", "TITLE" => Loc::getMessage('setting_google_repaptcha')),
    array("DIV" => "fedit2", "TAB" => Loc::getMessage('jivosite'), "ICON" => "main_settings", "TITLE" => Loc::getMessage('setting_jivosite')),
    array("DIV" => "fedit3", "TAB" => Loc::getMessage('vk'), "ICON" => "main_settings", "TITLE" => Loc::getMessage('setting_vk')),
);

$tabControl = new CAdminTabControl("tabControl", $aTabs);

$isAdmin = $USER->IsAdmin();

if($REQUEST_METHOD=="POST" && (strlen($save)>0 || strlen($apply)>0) && check_bitrix_sessid() && $isAdmin){
    COption::SetOptionString("main","open_google_recaptcha_key",$_POST['open_key']);
    COption::SetOptionString("main","secret_google_recaptcha_key",$_POST['secret_key']);
    COption::SetOptionString("main","method",$_POST['method']);
    COption::SetOptionString("main","jivosite_key",$_POST['jivosite_key']);
    COption::SetOptionString("main","vk_key",$_POST['vk_key']);
}

$open_key = COption::GetOptionString("main", "open_google_recaptcha_key", "");
$secret_key = COption::GetOptionString("main", "secret_google_recaptcha_key", "");
$method = COption::GetOptionString("main", "method", "");
$jivosite_key = COption::GetOptionString("main", "jivosite_key", "");
$vk_key = COption::GetOptionString("main", "vk_key", "");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");
?>
<form method="POST" action="<?=$APPLICATION->GetCurPage()?>">
    <?=bitrix_sessid_post()?>
    <?$tabControl->Begin();?>
    <?$tabControl->BeginNextTab();?>
    <tr>
        <td width="40%" class="adm-detail-content-cell-l"><?=Loc::getMessage('open_key_google_recaptcha')?></td>
        <td width="70%" class="adm-detail-content-cell-r">
            <input type="text" name="open_key" value="<?=$open_key?>">
        </td>
    </tr>
    <tr>
        <td width="40%" class="adm-detail-content-cell-l"><?=Loc::getMessage('secret_key_google_recaptcha')?></td>
        <td width="60%" class="adm-detail-content-cell-r">
            <input type="text" name="secret_key" value="<?=$secret_key?>">
        </td>
    </tr>
   <tr>
      <td width="40%" class="adm-detail-content-cell-l"><?=Loc::getMessage('method')?></td>
      <td width="60%" class="adm-detail-content-cell-r">
         <select  name="method" >
            <option value="curl" <?if($method !=='file_get_contents'):?>selected<?endif;?>>curl</option>
            <option value="file_get_contents" <?if($method =='file_get_contents'):?>selected<?endif;?>>file_get_contents</option>
         </select>
      </td>
   </tr>
    <?$tabControl->BeginNextTab();?>
   <tr>
      <td width="40%" class="adm-detail-content-cell-l"><?=Loc::getMessage('jivosite_key')?></td>
      <td width="70%" class="adm-detail-content-cell-r">
         <input type="text" name="jivosite_key" value="<?=$jivosite_key?>">
      </td>
   </tr>
    <?$tabControl->BeginNextTab();?>
   <tr>
      <td width="40%" class="adm-detail-content-cell-l"><?=Loc::getMessage('vk_key')?></td>
      <td width="70%" class="adm-detail-content-cell-r">
         <input type="text" name="vk_key" value="<?=$vk_key?>">
      </td>
   </tr>
    <?
    $tabControl->Buttons(array("disabled" => !$isAdmin));
    $tabControl->End();
    ?>
</form>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");?>
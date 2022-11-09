<?php
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Page;
use Citadel\XpsUpdateClient;

global $APPLICATION, $USER;

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");

if (!CModule::IncludeModule("citadel.xpsupdateclient"))
{
    $APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));
}

$modulePermissions = $APPLICATION->GetGroupRight("citadel.xpsupdateclient");

if ($modulePermissions < "W")
{
    $APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));
}

Page\Asset::getInstance()->addString('<link rel="stylesheet" type="text/css" href="/bitrix/css/citadel.xpsupdateclient/admin.css.php">');
Page\Asset::getInstance()->addString('<script src="/bitrix/js/citadel.xpsupdateclient/admin_client.js.php"></script>');


Loc::loadMessages(__FILE__);
Loc::loadMessages(__DIR__ . '/client.php');

$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$fields = XpsUpdateClient\Table\ClientTable::getEntity()->getFields();

$action = $request->get('action');
$row = null;
$errors = array();

$aTabs = array(
    array(
        'DIV' => 'server',
        'TAB' => GetMessage("CLIENT_CLIENT_TITLE"),
        'ICON'=>'ad_contract_edit',
        'TITLE'=> GetMessage("CLIENT_CLIENT_TITLE_INFO")
    ),
    array(
        'DIV' => 'iblocks',
        'TAB' => GetMessage("CLIENT_IB_TITLE"),
        'ICON'=>'ad_contract_edit',
        'TITLE'=> GetMessage("CLIENT_IB_TITLE_INFO")
    )
);

$tabControl = new CAdminForm('client_edit', $aTabs);

//
// get item from DB
//
$ID = 1;

if ($ID > 0)
{
    $row = XpsUpdateClient\Table\ClientTable::getById($ID)->fetch();
}

//
// delete action
//
if ($row['ID'] > 0 && $action === 'delete' && $modulePermissions >= "W" && check_bitrix_sessid())
{
//    XpsUpdateClient\Table\ClientTable::delete($row['ID']);
//    LocalRedirect('citadel_xpsupdateclient_client.php?&lang='.LANGUAGE_ID);
}

//
// save action
//
if (($request->getPost("save") || $request->getPost("apply")) && $request->isPost() && $modulePermissions >= "W" && check_bitrix_sessid())
{
    if ($row)
    {
        $ID = intval($ID);
        $result = XpsUpdateClient\Table\ClientTable::update($ID, $request->get("form"));
    }
    else
    {
        $result = XpsUpdateClient\Table\ClientTable::add($request->get("form"));
        $ID = $result->getId();
    }

    if ($result->isSuccess())
    {
        if ($request->getPost("save"))
        {
            LocalRedirect('citadel_xpsupdateclient_client_edit.php?lang=' . LANGUAGE_ID);
        }
        else
        {
            LocalRedirect('citadel_xpsupdateclient_client_edit.php?lang='.LANGUAGE_ID);
        }

        $row = XpsUpdateClient\Table\ClientTable::getById($ID)->fetch();
    }
    else
    {
        $errors = $result->getErrorMessages();

        foreach ($request->getPost("form") as $k => $v)
        {
            if (isset($fields[$k]))
            {
                $row[$k] = $v;
            }
        }
    }
}

//
//
//
if ($action == 'showtab'/* && $tabControl->GetSelectedTab() == 'iblocks'*/)
{
    foreach ($request->getPost("form") as $k => $v)
    {
        if (isset($fields[$k]))
        {
            $row[$k] = $v;
        }
    }

    if (filter_var($request->getPost("form")['SERVER_URL'], FILTER_VALIDATE_URL) === false)
    {
        $errors[] = Loc::getMessage("NOT_URL", ['#FIELD#' => XpsUpdateClient\Table\ClientTable::getEntity()->getField('SERVER_URL')->getTitle()]);
    }

    if (strlen($request->getPost("form")['SERVER_KEY']) === 0)
    {
        $errors[] = Loc::getMessage("FIELD_EMPTY", ['#FIELD#' => XpsUpdateClient\Table\ClientTable::getEntity()->getField('SERVER_KEY')->getTitle()]);
    }

    if (empty($errors))
    {
        $api = new XpsUpdateClient\Client\IblockApi($request->getPost("form")['SERVER_URL']);
        $api->setTokenAuthorization($request->getPost("form")['SERVER_KEY']);

        try
        {
            $serverIblockTypes = $api->getIblockTypes();
            $serverIblockItems = $api->getIblockItems();
            $serverIblockProperties = $api->getIblockProperties();
        }
        catch (\Exception $e)
        {
            $errors = $api->getError();
        }
    }
}

if (empty($errors))
{
    switch($_REQUEST['action'])
    {
        case  "sync":
            if ($modulePermissions >= "W")
            {
                try
                {
                    $syncUpdatedCount = XpsUpdateClient\Client\IblockApi::getElementsByClient($ID);
                }
                catch (\Exception $e)
                {
                    $errors[] = $e->getMessage();
                }
            }
            break;
    }
}


// set title
if (intval($row['ID']) == 0)
{
    $APPLICATION->SetTitle(GetMessage('CLIENT_EDIT_TITLE'));
}
else
{
    $APPLICATION->SetTitle(GetMessage('CLIENT_EDIT_TITLE', array('#ID#' => $row['ID'])));
}

//$context = new CAdminContextMenu($aMenu);

//view
if ($_REQUEST['mode'] == 'list')
{
    require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_admin_js.php');
}
else
{
    require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_admin_after.php');
}

//$context->Show();


if (!empty($errors))
{
    CAdminMessage::ShowMessage(join("\n", $errors));
}

if ($_REQUEST['action'] == 'sync' && empty($errors))
{
    echo BeginNote();
    echo Loc::getMessage(
        "CLIENT_IB_SYNC_UPDATED",
        [
            "#COUNT#" => intval($syncUpdatedCount),
        ]
    );
    echo EndNote();
}

?>

<? if ($row['SERVER_IBLOCK_ID'] && $row['SERVER_IBLOCK_KEY_ID'] && $row['CLIENT_IBLOCK_ID'] && $row['CLIENT_IBLOCK_KEY_ID']): ?>

    <div class="adm-list-table-top">
        <a href="?action=sync" class="adm-btn"><?echo Loc::getMessage("CLIENT_IB_SYNC");?></a>
    </div>

<? endif; ?>

<?

$tabControl->BeginPrologContent();
echo CAdminCalendar::ShowScript();
\CJSCore::Init(array('jquery'));
$tabControl->EndPrologContent();

$tabControl->BeginEpilogContent();
?>

<?=bitrix_sessid_post()?>
    <input type="hidden" name="ID" value="1">
    <input type="hidden" name="lang" value="<?echo LANGUAGE_ID?>">
    <input type="hidden" name="action" value="">

<?
$tabControl->EndEpilogContent();

$tabControl->Begin(array('FORM_ACTION' => $APPLICATION->GetCurPage().'?&ID=' . IntVal($row['ID']) . '&lang=' . LANG));
$tabControl->BeginNextFormTab(); ?>

<? if (intval($row['ID']) > 0): ?>

    <?
    $tabControl->BeginCustomField("DATE_CREATE", GetMessage('CREATED'));
    ?>
    <tr class="adm-detail-valign-top">
        <td width="40%"><? echo $tabControl->GetCustomLabelHTML() ?></td>
        <td width="60%">
            <?echo !empty($row) ? $row['DATE_CREATE'] : ''?>
            <?
            if (intval($row['CREATED_BY']) > 0):
                ?>&nbsp;&nbsp;&nbsp;[<a href="user_edit.php?lang=<?=LANGUAGE_ID; ?>&amp;ID=<?=$row['CREATED_BY']; ?>"><? echo $row['CREATED_BY'] ?></a>]
                <?
                $rsUser = CUser::GetByID($row['CREATED_BY']);
                $arUser = $rsUser->Fetch();
                if ($arUser):
                    echo '&nbsp;'.CUser::FormatName(\CSite::GetNameFormat(), $arUser, false, true);
                endif;
            endif;
            ?>
        </td>
    </tr>
    <?
    $tabControl->EndCustomField("DATE_CREATE");
    ?>

    <?
    $tabControl->BeginCustomField("DATE_UPDATE", GetMessage('UPDATED'));
    ?>
    <tr class="adm-detail-valign-top">
        <td width="40%"><? echo $tabControl->GetCustomLabelHTML() ?></td>
        <td width="60%">
            <?echo !empty($row) ? $row['DATE_UPDATE'] : ''?>
            <?
            if (intval($row['CREATED_BY']) > 0):
                ?>&nbsp;&nbsp;&nbsp;[<a href="user_edit.php?lang=<?=LANGUAGE_ID; ?>&amp;ID=<?=$row['UPDATED_BY']; ?>"><? echo $row['UPDATED_BY'] ?></a>]
                <?
                $rsUser = CUser::GetByID($row['UPDATED_BY']);
                $arUser = $rsUser->Fetch();
                if ($arUser):
                    echo '&nbsp;'.CUser::FormatName(\CSite::GetNameFormat(), $arUser, false, true);
                endif;
            endif;
            ?>
        </td>
    </tr>
    <?
    $tabControl->EndCustomField("DATE_UPDATE");
    ?>
<? endif; ?>

<?
$tabControl->BeginCustomField("ACTIVE", $fields['ACTIVE']->getTitle());
?>
    <tr class="adm-detail-valign-top">
        <td width="40%"><?echo $tabControl->GetCustomLabelHTML()?></td>
        <td width="60%">
            <input name="form[ACTIVE]" value="N" type="hidden">
            <input name="form[ACTIVE]" value="Y" <?echo $row['ACTIVE'] === "Y" || !isset($row['ACTIVE']) ? 'checked' : '';?> type="checkbox">
        </td>
    </tr>
<?
$tabControl->EndCustomField("ACTIVE");
?>

<?
$tabControl->BeginCustomField("SERVER_URL", $fields['SERVER_URL']->getTitle(), true);
?>
    <tr class="adm-detail-valign-top">
        <td width="40%"><?echo $tabControl->GetCustomLabelHTML()?></td>
        <td width="60%"><input type="text" name="form[SERVER_URL]" class="w-90" value="<?echo !empty($row) ? htmlspecialcharsbx($row['SERVER_URL']) : ''?>"></td>
    </tr>
<?
$tabControl->EndCustomField("SERVER_URL");
?>

<?
$tabControl->BeginCustomField("SERVER_KEY", $fields['SERVER_KEY']->getTitle(), true);
?>
    <tr class="adm-detail-valign-top">
        <td width="40%"><?echo $tabControl->GetCustomLabelHTML()?></td>
        <td width="60%"><input type="text" name="form[SERVER_KEY]" class="w-90" value="<?echo !empty($row) ? htmlspecialcharsbx($row['SERVER_KEY']) : ''?>"></td>
    </tr>
<?
$tabControl->EndCustomField("SERVER_KEY");
?>

<?
$tabControl->BeginCustomField("DESCRIPTION", $fields['DESCRIPTION']->getTitle(), false);
?>
    <tr class="adm-detail-valign-top">
        <td width="40%"><?echo $tabControl->GetCustomLabelHTML()?></td>
        <td width="60%"><textarea name="form[DESCRIPTION]" rows="5" class="w-90"><?echo !empty($row) ? $row['DESCRIPTION'] : ''?></textarea></td>
    </tr>
<?
$tabControl->EndCustomField("DESCRIPTION");
?>

<?
$tabControl->BeginNextFormTab();
?>

<?
$tabControl->BeginCustomField("IBLOCK_SYNC", Loc::getMessage("SYNC_IBLOCK_TITLE"));
?>
    <tr class="adm-detail-valign-top">
        <td colspan="2">

            <? if (empty($errors) && $tabControl->GetSelectedTab() == 'iblocks'): ?>
                <table class="client_sync_table">
                    <tr>
                        <th width="50%" class="title">
                            <?echo Loc::getMessage("SERVER_TITLE");?>
                        </th>
                        <th width="50%" class="title">
                            <?echo Loc::getMessage("CLIENT_TITLE");?>
                        </th>
                    </tr>

                    <tr>
                        <th colspan="2">
                            <?echo Loc::getMessage("IBLOCK_CHOOSE_TITLE");?>
                        </th>
                    </tr>
                    <tr>
                        <td align="right">
                            <select id="SERVER_IBLOCK_TYPE" name="form[SERVER_IBLOCK_TYPE]">
                                <option value=""><?echo GetMessage('SERVER_IB_TYPE_SELECT');?></option>

                                <? foreach ($serverIblockTypes as $aType): ?>
                                    <option value="<?echo $aType['ID'];?>" <?echo $aType['ID'] == $row['SERVER_IBLOCK_TYPE'] ? 'selected' : ''?> >
                                        <?echo $aType['IBLOCK_TYPE_LANG_MESSAGE_NAME'];?>
                                    </option>
                                <? endforeach; ?>
                            </select>

                            <select id="SERVER_IBLOCK_ID" name="form[SERVER_IBLOCK_ID]">
                                <option value=""></option>

                                <? foreach ($serverIblockItems as $aIblock): ?>
                                    <option value="<?echo $aIblock['ID'];?>" data-type="<?echo $aIblock['IBLOCK_TYPE_ID'];?>" <?echo $aIblock['ID'] == $row['SERVER_IBLOCK_ID'] ? 'selected' : ''?> >
                                        <?echo $aIblock['NAME'];?>
                                    </option>
                                <? endforeach; ?>
                            </select>
                        </td>
                        <td align="left">
                            <select id="CLIENT_IBLOCK_TYPE" name="form[CLIENT_IBLOCK_TYPE]">
                                <option value=""><?echo GetMessage('SERVER_IB_TYPE_SELECT');?></option>

                                <? foreach (XpsUpdateClient\Client\Iblock::getIblocks()['TYPES'] as $aType): ?>
                                    <option value="<?echo $aType['ID'];?>" <?echo $aType['ID'] == $row['CLIENT_IBLOCK_TYPE'] ? 'selected' : ''?> >
                                        <?echo $aType['IBLOCK_TYPE_LANG_MESSAGE_NAME'];?>
                                    </option>
                                <? endforeach; ?>
                            </select>

                            <select id="CLIENT_IBLOCK_ID" name="form[CLIENT_IBLOCK_ID]">
                                <option value=""></option>

                                <? foreach (XpsUpdateClient\Client\Iblock::getIblocks()['IBLOCKS'] as $aIblock): ?>
                                    <option value="<?echo $aIblock['ID'];?>" data-type="<?echo $aIblock['IBLOCK_TYPE_ID'];?>" <?echo $aIblock['ID'] == $row['CLIENT_IBLOCK_ID'] ? 'selected' : ''?> >
                                        <?echo $aIblock['NAME'];?>
                                    </option>
                                <? endforeach; ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <th colspan="2">
                            <?echo Loc::getMessage("KEY_PROPERTIES_TITLE");?>
                        </th>
                    </tr>
                    <tr>
                        <td align="right">
                            <select id="SERVER_IBLOCK_KEY_ID" name="form[SERVER_IBLOCK_KEY_ID]">
                                <option value=""></option>

                                <? foreach ($serverIblockProperties as $aProperty): ?>
                                    <? if (!$aProperty['PROPERTY_CAN_BE_KEY']) continue; ?>

                                    <option value="<?echo $aProperty['ID'];?>" data-iblock="<?echo $aProperty['IBLOCK_ID'];?>" data-type="<?echo $aProperty['PROPERTY_TYPE'];?>" <?echo $aProperty['ID'] == $row['SERVER_IBLOCK_KEY_ID'] && $aProperty['IBLOCK_ID'] == $row['SERVER_IBLOCK_ID'] ? 'selected' : ''?> >
                                        <?echo $aProperty['NAME'];?>
                                    </option>
                                <? endforeach; ?>
                            </select>
                        </td>
                        <td align="left">
                            <select id="CLIENT_IBLOCK_KEY_ID" name="form[CLIENT_IBLOCK_KEY_ID]">
                                <option value=""></option>

                                <? foreach (XpsUpdateClient\Client\Iblock::getIblocks()['PROPERTIES'] as $aProperty): ?>
                                    <? if (!$aProperty['PROPERTY_CAN_BE_KEY']) continue; ?>

                                    <option value="<?echo $aProperty['ID'];?>" data-iblock="<?echo $aProperty['IBLOCK_ID'];?>" data-type="<?echo $aProperty['PROPERTY_TYPE'];?>" <?echo $aProperty['ID'] == $row['CLIENT_IBLOCK_KEY_ID'] && $aProperty['IBLOCK_ID'] == $row['CLIENT_IBLOCK_ID'] ? 'selected' : ''?> >
                                        <?echo $aProperty['NAME'];?>
                                    </option>
                                <? endforeach; ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <th colspan="2">
                            <?echo Loc::getMessage("PROPERTIES_TITLE");?>
                        </th>
                    </tr>
                    <tr>
                        <td colspan="2" id="client_sync_property_table_cont">

                            <? for ($i = 0; $i < count($row['PROPERTIES_JSON']['SERVER']) + 1; $i++): ?>
                                <table class="client_sync_property_table">
                                    <tr>
                                        <td width="48%" align="right" class="client_sync_property_table_server">
                                            <select name="form[PROPERTIES_JSON][SERVER][]">
                                                <option value=""></option>

                                                <? foreach ($serverIblockProperties as $aProperty): ?>
                                                    <? if (!$aProperty['PROPERTY_SYNC_ALLOWED']) continue; ?>

                                                    <option value="<?echo $aProperty['ID'];?>" data-iblock="<?echo $aProperty['IBLOCK_ID'];?>" data-type="<?echo $aProperty['PROPERTY_TYPE'];?>" <?echo $aProperty['ID'] == $row['PROPERTIES_JSON']['SERVER'][$i] && $aProperty['IBLOCK_ID'] == $row['SERVER_IBLOCK_ID'] ? 'selected' : ''?> >
                                                        <?echo $aProperty['NAME'];?>
                                                    </option>
                                                <? endforeach; ?>
                                            </select>

                                        </td>
                                        <td align="center">
                                            <span class="adm-table-item-edit-wrap adm-table-item-edit-single m-0 btn_delete_sync_property" title="<?echo GetMessage('SERVER_CLIENT_DELETE');?>">
                                                <a class="adm-table-btn-delete"></a>
                                            </span>
                                        </td>
                                        <td width="48%" align="left" class="client_sync_property_table_client">
                                            <select name="form[PROPERTIES_JSON][CLIENT][]">
                                                <option value=""></option>

                                                <? foreach (XpsUpdateClient\Client\Iblock::getIblocks()['PROPERTIES'] as $aProperty): ?>
                                                    <? if (!$aProperty['PROPERTY_SYNC_ALLOWED']) continue; ?>

                                                    <option value="<?echo $aProperty['ID'];?>" data-iblock="<?echo $aProperty['IBLOCK_ID'];?>" data-type="<?echo $aProperty['PROPERTY_TYPE'];?>" <?echo $aProperty['ID'] == $row['PROPERTIES_JSON']['CLIENT'][$i] && $aProperty['IBLOCK_ID'] == $row['CLIENT_IBLOCK_ID'] ? 'selected' : ''?> >
                                                        <?echo $aProperty['NAME'];?>
                                                    </option>
                                                <? endforeach; ?>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            <? endfor; ?>

                            <a class="adm-btn adm-btn-save adm-btn-add" id="btn_add_sync_property"><?echo Loc::getMessage("ADD_PROPERTIES_TITLE");?></a>
                        </td>
                    </tr>
                </table>
            <? endif; ?>
        </td>
    </tr>
<?
$tabControl->EndCustomField("JSON");
?>


<?
$tabControl->Buttons(array('btnSave' => true, 'btnCancel' => false, 'btnApply' => false, 'disabled' => $modulePermissions < "W", 'back_url'=>'citadel_xpsupdateclient_client.php?lang='.LANGUAGE_ID));
$tabControl->Show();
?>

<?

if ($_REQUEST['mode'] == 'list')
    require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/epilog_admin_js.php');
else
    require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/epilog_admin.php');

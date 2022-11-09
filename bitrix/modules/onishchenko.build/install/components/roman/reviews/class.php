<?php
use \Onishchenko\Build\Recaptcha,
    \Bitrix\Main\Loader;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class Reviews extends CBitrixComponent
{

    public function onPrepareComponentParams($arParams)
    {
        $arParams['EMAIL_TO'] = trim($arParams['EMAIL_TO']);
        if (!$arParams['IBLOCK_ID'] || $arParams['IBLOCK_ID'] == 0)
            echo GetMessage('ERROR_MESS');
        else
            $arParams['IBLOCK_ID'] = intval($arParams['IBLOCK_ID']);
        return $arParams;
    }

    private function addMessageIblock($name, $email, $service, $message)
    {
        if (Loader::includeModule("iblock")) {
            $el = new CIBlockElement;
            $PROP['EMAIL'] = $email;
            $PROP['SERVICE'] = $service;
            if($this->arParams['ALLOW_COMMENTS'] == 'Y') {
                $r = CIBlockPropertyEnum::GetList([], ['IBLOCK_ID' => $this->arParams['IBLOCK_ID'], 'CODE' => 'SHOW']);
                while ($res = $r->Fetch()){
                    if ($res['VALUE'] == GetMessage('VALUE')) {
                        $show_id = $res['ID'];
                    }
                }
                $PROP['SHOW'] = ["VALUE" => $show_id ];
            }

            $arAddElement = [
                "IBLOCK_ID" => $this->arParams['IBLOCK_ID'],
                "PROPERTY_VALUES"=> $PROP,
                "NAME" => $name,
                "ACTIVE" => "Y",
                "PREVIEW_TEXT" => $message,
                "PREVIEW_PICTURE" => CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"] . "/". DEFAULT_TEMPLATE_PATH . "/images/noavatar.png")
            ];

            if ($PRODUCT_ID = $el->Add($arAddElement)) {
                if($this->arParams['EMAIL_TO'])
                    $this->sendMail($name, $email, $service, $message);
                return true;
            }
            else
                return false;
        }
        else {
            $this->abortResultCache();
            return;
        }
    }

    private function sendMail($name, $email, $service, $message)
    {
        $arEventFields = [
            "AUTHOR_EMAIL" => $email,
            "AUTHOR_NAME" => $name,
            "MESSAGE" => $message,
            "SERVICE" => $service,
            "EMAIL_TO" => $this->arParams['EMAIL_TO'],
        ];
        CEvent::Send("BUILD_REVIEWS", SITE_ID, $arEventFields);
    }

    private function checkGoogleAPI()
    {
        if (Recaptcha::checkGoogleAPI())
            $this->arResult['RECAPTCHA'] = 'Y';
        else
            $this->arResult['RECAPTCHA'] = 'N';
    }

    private function handlerData()
    {
        $name = htmlspecialcharsbx(iconv('UTF-8', SITE_CHARSET, $_POST['name']));
        $email = ($_POST['email']) ? htmlspecialcharsbx(iconv('UTF-8', SITE_CHARSET, $_POST['email'])) : GetMessage('MISSING_EMAIL');
        $service = htmlspecialcharsbx(iconv('UTF-8', SITE_CHARSET, $_POST['service']));
        $message = htmlspecialcharsbx(iconv('UTF-8', SITE_CHARSET, $_POST['message']));
        $comment_status = $this->addMessageIblock($name, $email, $service, $message);
        $this->printMessage(['recaptcha_status' =>'Y','comment_status' => $comment_status]);
    }

    private function printMessage($arMessage)
    {
        $GLOBALS['APPLICATION']->RestartBuffer();
        echo json_encode($arMessage);
        die();
    }

    public function executeComponent()
    {
        $this->checkGoogleAPI();
        if($_POST['ajax'] == 'REVIEWS' && check_bitrix_sessid()) {
            if ($this->arResult['RECAPTCHA'] == 'N')
                $this->handlerData();
            else {
                if (Recaptcha::checkValidRecaptcha($_POST['recaptcha']))
                    $this->handlerData();
                else
                    $this->printMessage(['recaptcha_status' =>'N','comment_status' => false]);
            }
        }
        else
            $this->IncludeComponentTemplate();
    }
}
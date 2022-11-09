<?php
use \Onishchenko\Build\Recaptcha,
    \Bitrix\Main\Loader;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class Call extends CBitrixComponent
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

    private function addMessageIblock($name, $phone, $message)
    {
        if (Loader::includeModule("iblock")) {
            $el = new CIBlockElement;
            $PROP['PHONE'] = $phone;
            $arAddElement = [
                "IBLOCK_ID" => $this->arParams['IBLOCK_ID'],
                "PROPERTY_VALUES"=> $PROP,
                "NAME" => $name,
                "ACTIVE" => "Y",
                "PREVIEW_TEXT" => $message,
            ];

            if($PRODUCT_ID = $el->Add($arAddElement)){
                if($this->arParams['EMAIL_TO'])
                    $this->sendMail($name, $phone, $message);
                return GetMessage('SUCCESS_MESSAGE');
            }
            else
                return GetMessage('ERROR_MESSAGE');
        }
        else {
            $this->abortResultCache();
            return;
        }
    }

    private function sendMail($name, $phone, $message = false)
    {
        if(!$message)
            $message = GetMessage('NO_COMMENT');
        $arEventFields = [
            "AUTHOR_NAME" => $name,
            "PHONE" => $phone,
            "MESSAGE" => $message,
            "EMAIL_TO" => $this->arParams['EMAIL_TO'],
        ];
        CEvent::Send("BUILD_CALL_FORM", SITE_ID, $arEventFields);
    }

    private function handlerData()
    {
        $name = htmlspecialcharsbx(iconv('UTF-8',SITE_CHARSET, $_POST['name']));
        $phone = htmlspecialcharsbx(iconv('UTF-8',SITE_CHARSET, $_POST['phone']));
        $message = htmlspecialcharsbx(iconv('UTF-8',SITE_CHARSET, $_POST['message']));
        $mess = $this->addMessageIblock($name, $phone, $message);
        $this->printMessage($mess);
    }

    private function checkGoogleAPI()
    {
        if(Recaptcha::checkGoogleAPI())
            $this->arResult['RECAPTCHA'] = 'Y';
        else
            $this->arResult['RECAPTCHA'] = 'N';
    }

    private function printMessage($message)
    {
        $GLOBALS['APPLICATION']->RestartBuffer();
        echo $message;
        die();
    }

    public function executeComponent()
    {
        $this->checkGoogleAPI();
        if($_POST['ajax'] == 'CALL' && check_bitrix_sessid()) {
            if ($this->arResult['RECAPTCHA'] == 'N')
                $this->handlerData();
            else {
                if (Recaptcha::checkValidRecaptcha($_POST['recaptcha']))
                    $this->handlerData();
                else
                    $this->printMessage(GetMessage('RECAPTCHA_ERROR'));
            }
        }
        else
            $this->IncludeComponentTemplate();
    }
}
<?php
use \Onishchenko\Build\Recaptcha,
    \Bitrix\Main\Loader;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class Job extends CBitrixComponent
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

    private function addMessageIblock($name, $email, $job, $resume, $job_name)
    {
        if (Loader::includeModule("iblock")) {
            $el = new CIBlockElement;
            $PROP['EMAIL'] = $email;
            $PROP['JOB'] = $job;
            $arAddElement = [
                "IBLOCK_ID" => $this->arParams['IBLOCK_ID'],
                "PROPERTY_VALUES"=> $PROP,
                "NAME" => $name,
                "ACTIVE" => "Y",
                "PREVIEW_TEXT" => $resume,
            ];

            if($PRODUCT_ID = $el->Add($arAddElement)){
                if($this->arParams['EMAIL_TO'])
                    $this->sendMail($name, $email, $job_name, $resume);
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

    private function sendMail($name, $email, $job_name, $resume)
    {
        $arEventFields = [
            "AUTHOR_EMAIL" => $email,
            "AUTHOR_NAME" => $name,
            "JOB_NAME" => $job_name,
            "RESUME" => $resume,
            "EMAIL_TO" => $this->arParams['EMAIL_TO'],
        ];
        CEvent::Send("BUILD_APPLY_FOR_JOB", SITE_ID, $arEventFields);
    }

    private function handlerData()
    {
        $name = htmlspecialcharsbx(iconv('UTF-8',SITE_CHARSET,$_POST['name']));
        $email = htmlspecialcharsbx(iconv('UTF-8',SITE_CHARSET,$_POST['email']));
        $job = (int) $_POST['job'];
        $resume = htmlspecialcharsbx(iconv('UTF-8',SITE_CHARSET,$_POST['resume']));
        $job_name = htmlspecialcharsbx(iconv('UTF-8',SITE_CHARSET,$_POST['job_name']));
        $mess = $this->addMessageIblock($name,$email,$job,$resume,$job_name);
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
        if($_POST['ajax'] == 'JOB' && check_bitrix_sessid()) {
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
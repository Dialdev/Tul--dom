<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$dbEvent = CEventMessage::GetList($b="ID", $order="ASC", Array("EVENT_NAME" => 'APPOINTMENTS'));
if(!($dbEvent->Fetch()))
{
    $langs = CLanguage::GetList(($b=""), ($o=""));
    while($lang = $langs->Fetch())
    {
        $lid = $lang["LID"];
        IncludeModuleLangFile(__FILE__, $lid);

        $et = new CEventType;
        $et->Add(array(
            "LID" => $lid,
            "EVENT_NAME" => "BUILD_FEEDBACK_FORM",
            "NAME" => GetMessage("BUILD_FEEDBACK_FORM_NAME"),
            "DESCRIPTION" => GetMessage("BUILD_FEEDBACK_FORM_DESC"),
        ));

        $et = new CEventType;
        $et->Add(array(
            "LID" => $lid,
            "EVENT_NAME" => "BUILD_CALL_FORM",
            "NAME" => GetMessage("BUILD_CALL_FORM_NAME"),
            "DESCRIPTION" => GetMessage("BUILD_CALL_FORM_DESC"),
        ));

        $et = new CEventType;
        $et->Add(array(
            "LID" => $lid,
            "EVENT_NAME" => "BUILD_REVIEWS",
            "NAME" => GetMessage("BUILD_REVIEWS_NAME"),
            "DESCRIPTION" => GetMessage("BUILD_REVIEWS_DESC"),
        ));

        $et = new CEventType;
        $et->Add(array(
            "LID" => $lid,
            "EVENT_NAME" => "BUILD_APPLY_FOR_JOB",
            "NAME" => GetMessage("BUILD_APPLY_FOR_JOB_NAME"),
            "DESCRIPTION" => GetMessage("BUILD_APPLY_FOR_JOB_DESC"),
        ));

        $et = new CEventType;
        $et->Add(array(
            "LID" => $lid,
            "EVENT_NAME" => "BUILD_APPOINTMENTS_FORM",
            "NAME" => GetMessage("BUILD_APPOINTMENTS_FORM_NAME"),
            "DESCRIPTION" => GetMessage("BUILD_APPOINTMENTS_FORM_DESC"),
        ));

        $et = new CEventType;
        $et->Add(array(
            "LID" => $lid,
            "EVENT_NAME" => "BUILD_FAQ",
            "NAME" => GetMessage("BUILD_FAQ_NAME"),
            "DESCRIPTION" => GetMessage("BUILD_FAQ_DESC"),
        ));

        $et = new CEventType;
        $et->Add(array(
            "LID" => $lid,
            "EVENT_NAME" => "BUILD_STAFF_QUESTION",
            "NAME" => GetMessage("BUILD_STAFF_QUESTION_NAME"),
            "DESCRIPTION" => GetMessage("BUILD_STAFF_QUESTION_DESC"),
        ));

        $et = new CEventType;
        $et->Add(array(
            "LID" => $lid,
            "EVENT_NAME" => "BUILD_QUESTION",
            "NAME" => GetMessage("BUILD_QUESTION_NAME"),
            "DESCRIPTION" => GetMessage("BUILD_QUESTION_DESC"),
        ));


        $arSites = array();
        $sites = CSite::GetList(($b=""), ($o=""), Array("LANGUAGE_ID"=>$lid));
        while ($site = $sites->Fetch())
            $arSites[] = $site["LID"];

        if(count($arSites) > 0)
        {

            $emess = new CEventMessage;
            $emess->Add(array(
                "ACTIVE" => "Y",
                "EVENT_NAME" => "BUILD_FEEDBACK_FORM",
                "LID" => $arSites,
                "EMAIL_FROM" => "#DEFAULT_EMAIL_FROM#",
                "EMAIL_TO" => "#EMAIL_TO#",
                "BCC" => "",
                "SUBJECT" => GetMessage("BUILD_FEEDBACK_FORM_SUBJECT"),
                "MESSAGE" => GetMessage("BUILD_FEEDBACK_FORM_MESSAGE"),
                "BODY_TYPE" => "text",
            ));

            $emess = new CEventMessage;
            $emess->Add(array(
                "ACTIVE" => "Y",
                "EVENT_NAME" => "BUILD_CALL_FORM",
                "LID" => $arSites,
                "EMAIL_FROM" => "#DEFAULT_EMAIL_FROM#",
                "EMAIL_TO" => "#EMAIL_TO#",
                "BCC" => "",
                "SUBJECT" => GetMessage("BUILD_CALL_FORM_SUBJECT"),
                "MESSAGE" => GetMessage("BUILD_CALL_FORM_MESSAGE"),
                "BODY_TYPE" => "text",
            ));

            $emess = new CEventMessage;
            $emess->Add(array(
                "ACTIVE" => "Y",
                "EVENT_NAME" => "BUILD_REVIEWS",
                "LID" => $arSites,
                "EMAIL_FROM" => "#DEFAULT_EMAIL_FROM#",
                "EMAIL_TO" => "#EMAIL_TO#",
                "BCC" => "",
                "SUBJECT" => GetMessage("BUILD_REVIEWS_SUBJECT"),
                "MESSAGE" => GetMessage("BUILD_REVIEWS_MESSAGE"),
                "BODY_TYPE" => "text",
            ));

            $emess = new CEventMessage;
            $emess->Add(array(
                "ACTIVE" => "Y",
                "EVENT_NAME" => "BUILD_APPLY_FOR_JOB",
                "LID" => $arSites,
                "EMAIL_FROM" => "#DEFAULT_EMAIL_FROM#",
                "EMAIL_TO" => "#EMAIL_TO#",
                "BCC" => "",
                "SUBJECT" => GetMessage("BUILD_APPLY_FOR_JOB_SUBJECT"),
                "MESSAGE" => GetMessage("BUILD_APPLY_FOR_JOB_MESSAGE"),
                "BODY_TYPE" => "text",
            ));

            $emess = new CEventMessage;
            $emess->Add(array(
                "ACTIVE" => "Y",
                "EVENT_NAME" => "BUILD_APPOINTMENTS_FORM",
                "LID" => $arSites,
                "EMAIL_FROM" => "#DEFAULT_EMAIL_FROM#",
                "EMAIL_TO" => "#EMAIL_TO#",
                "BCC" => "",
                "SUBJECT" => GetMessage("BUILD_APPOINTMENTS_FORM_SUBJECT"),
                "MESSAGE" => GetMessage("BUILD_APPOINTMENTS_FORM_MESSAGE"),
                "BODY_TYPE" => "text",
            ));

            $emess = new CEventMessage;
            $emess->Add(array(
                "ACTIVE" => "Y",
                "EVENT_NAME" => "BUILD_FAQ",
                "LID" => $arSites,
                "EMAIL_FROM" => "#DEFAULT_EMAIL_FROM#",
                "EMAIL_TO" => "#EMAIL_TO#",
                "BCC" => "",
                "SUBJECT" => GetMessage("BUILD_FAQ_SUBJECT"),
                "MESSAGE" => GetMessage("BUILD_FAQ_MESSAGE"),
                "BODY_TYPE" => "text",
            ));

            $emess = new CEventMessage;
            $emess->Add(array(
                "ACTIVE" => "Y",
                "EVENT_NAME" => "BUILD_STAFF_QUESTION",
                "LID" => $arSites,
                "EMAIL_FROM" => "#DEFAULT_EMAIL_FROM#",
                "EMAIL_TO" => "#EMAIL_TO#",
                "BCC" => "",
                "SUBJECT" => GetMessage("BUILD_STAFF_QUESTION_SUBJECT"),
                "MESSAGE" => GetMessage("BUILD_STAFF_QUESTION_MESSAGE"),
                "BODY_TYPE" => "text",
            ));

            $emess = new CEventMessage;
            $emess->Add(array(
                "ACTIVE" => "Y",
                "EVENT_NAME" => "BUILD_QUESTION",
                "LID" => $arSites,
                "EMAIL_FROM" => "#DEFAULT_EMAIL_FROM#",
                "EMAIL_TO" => "#EMAIL_TO#",
                "BCC" => "",
                "SUBJECT" => GetMessage("BUILD_QUESTION_SUBJECT"),
                "MESSAGE" => GetMessage("BUILD_QUESTION_MESSAGE"),
                "BODY_TYPE" => "text",
            ));
        }
    }
}
?>
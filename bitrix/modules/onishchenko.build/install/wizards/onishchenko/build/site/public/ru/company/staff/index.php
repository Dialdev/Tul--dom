<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Сотрудники");
?>
<?$APPLICATION->IncludeComponent(
    "roman:staff",
    "",
    array(
        "IBLOCK_ID" => "#IB_STAFF#",
        "IBLOCK_TYPE" => "content",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
    ),
    false
);?>
<?$APPLICATION->IncludeComponent(
	"roman:ask_question", 
	".default", 
	array(
		"IBLOCK_ID" => "#IB_QUESTIONS_FORM#",
		"IBLOCK_TYPE" => "content",
		"EMAIL_TO" => "#EMAIL#",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => ".default",
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
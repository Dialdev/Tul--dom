<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arServices = Array(
	"main" => Array(
		"NAME" => GetMessage("SERVICE_MAIN_SETTINGS"),
		"STAGES" => Array(
			"site_create.php", // Create site
			"files.php", // Copy bitrix files
			"template.php", // Install template
		),
	),
	
	"iblock" => Array(
		"NAME" => GetMessage("SERVICE_IBLOCK"),
		"STAGES" => Array(
			"types.php", 	
			"ib_1.php",
			"ib_2.php",
			"ib_3.php",
			"ib_4.php",
			"ib_5.php",
			"ib_6.php",
			"ib_7.php",
			"ib_8.php",
			"ib_9.php",
			"ib_10.php",
			"ib_11.php",
			"ib_12.php",
			"ib_13.php",
			"ib_14.php",
			"ib_15.php",
			"ib_17.php",
			"ib_18.php",
			"ib_19.php",
			"ib_20.php",
		),
	)
);
?>
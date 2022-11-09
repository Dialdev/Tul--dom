<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = array(
    "GROUPS" => array(
    ),
    "PARAMETERS" => array(
        "FOR_DEMO" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("FOR_DEMO"),
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "N",
        ),
    ),
);
?>
<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
    die();
}
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
$arComponentParameters = [
    "PARAMETERS" => [
        "CACHE_TIME"  => [
            "DEFAULT" => 86400,
            "PARENT"  => "CACHE_SETTINGS",
            "NAME"    => Loc::getMessage("SHOP_LAPTOP_PARAM_DETAIL_CACHE_TIME"),
        ],
        "MANUFACTURER_ID"  => [
            "PARENT" => "BASE",
            "NAME"   => Loc::getMessage("SHOP_LAPTOP_PARAM_DETAIL_MANUFACTURER_ID"),
        ],
        "MODEL_ID"  => [
            "PARENT" => "BASE",
            "NAME"   => Loc::getMessage("SHOP_LAPTOP_PARAM_DETAIL_MODEL_ID"),
        ]
    ]
];
?>
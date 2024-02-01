<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
    die();
}
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
$arComponentParameters = [
    "PARAMETERS" => [
        "SEF_MODE" => [
            "manufacturer" => [
                "NAME"      => Loc::getMessage("SHOP_LAPTOP_PARAM_SEF_MODE_MANUFACTURER"),
                "DEFAULT"   => "#MANUFACTURER_ID#/",
                "VARIABLES" => [
                    "MANUFACTURER_ID"
                ],
            ],
            "model" => [
                "NAME"      => Loc::getMessage("SHOP_LAPTOP_PARAM_SEF_MODE_MODEL"),
                "DEFAULT"   => "#MANUFACTURER_ID#/#MODEL_ID#/",
                "VARIABLES" => [
                    "MODEL_ID",
                    "MANUFACTURER_ID"
                ],
            ],
            "laptop" => [
                "NAME"      => Loc::getMessage("SHOP_LAPTOP_PARAM_SEF_MODE_LAPTOP"),
                "DEFAULT"   => "detail/#LAPTOP_ID#/",
                "VARIABLES" => [
                    "MODEL_ID",
                    "MANUFACTURER_ID",
                    "LAPTOP_ID"
                ],
            ],
        ],
        "CACHE_TIME"  => [
            "DEFAULT" => 86400,
            "PARENT"  => "CACHE_SETTINGS",
            "NAME"    => Loc::getMessage("SHOP_LAPTOP_PARAM_CACHE_TIME"),
        ],
        "COUNT"  => [
            "DEFAULT" => 86400,
            "PARENT"  => "BASE",
            "DEFAULT" => "10",
            "NAME"    => Loc::getMessage("SHOP_LAPTOP_PARAM_COUNT"),
        ]
    ]
];
?>
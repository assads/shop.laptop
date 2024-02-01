<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
    die();
}
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
$arComponentDescription = [
    "NAME"        => Loc::getMessage("SHOP_LAPTOP_COMPONENT_NAME"),
    "DESCRIPTION" => GetMessage("SHOP_LAPTOP_COMPONENT_DESCRIPTION"),
    "ICON"        => "/images/shop_laptop.gif",
    "COMPLEX"     => "Y",
    "PATH"        => [
        "ID"    => "content",
        "CHILD" => [
            "ID"    => "shop_laptop",
            "NAME"  => Loc::getMessage("SHOP_LAPTOP_COMPONENT_NAME_COMP"),
            "SORT"  => 10,
            "CHILD" => [
                "ID" => "shop_laptop_cmpx",
            ]
        ]
    ]
];
?>
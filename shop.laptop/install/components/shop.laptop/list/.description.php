<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
    die();
}
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
$arComponentDescription = [
    "NAME"        => Loc::getMessage("SHOP_LAPTOP_COMPONENT_LIST_NAME"),
    "DESCRIPTION" => GetMessage("SHOP_LAPTOP_COMPONENT_LIST_DESCRIPTION"),
    "ICON"        => "/images/shop_laptop_list.gif",
    "PATH"        => [
        "ID"    => "content",
        "CHILD" => [
            "ID"    => "shop_laptop",
            "NAME"  => Loc::getMessage("SHOP_LAPTOP_COMPONENT_LIST_NAME_COMP"),
            "SORT"  => 10,
            "CHILD" => [
                "ID" => "shop_laptop_cmpx",
            ]
        ]
    ]
];
?>
<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
    die();
}

use Bitrix\Main\Loader;
use Bitrix\Main\Grid\Options;
use Bitrix\Main\Localization\Loc;
use Bitrix\Iblock\Component\Tools;
use Bitrix\Main\UI\PageNavigation;
Loc::loadMessages(__FILE__);

class ShopLaptopDetailComponent extends \CBitrixComponent
{
    private $options = [];

    public function onPrepareComponentParams($arParams): array
    {
        if (!Loader::includeModule("shop.laptop"))
        {
            $this->abortResultCache();
            ShowError(Loc::getMessage("SHOP_LAPTOP_DETAIL_ERROR_MODULE"));
            return [];
        }
        if (!isset($arParams["LAPTOP_ID"]) || intval($arParams["LAPTOP_ID"]) <= 0)
        {
            $this->abortResultCache();
            ShowError(Loc::getMessage("SHOP_LAPTOP_DETAIL_ERROR_LAPTOP_ID"));
            return [];
        }
        return $arParams;
    }

    public function executeComponent(): void
    {
        $arCache = [];
        if ($this->arParams["CACHE_TYPE"] !== "N" && $this->arParams["CACHE_TIME"] > 0)
        {
            $arCache["cache"] = [
                "ttl"         => $this->arParams["CACHE_TIME"],
                "cache_joins" => true
            ];
        }
        $this->arResult["ELEMENT"] = \ShopLaptop\LaptopTable::getRow(
            array_merge(
                [
                    "filter" => [
                        "=ID" => $this->arParams["LAPTOP_ID"]
                    ],
                    "select" => [
                        "*",
                        "MODEL_NAME"        => "MODEL.NAME",
                        "MANUFACTURER_ID"   => "MODEL.MANUFACTURER_ID",
                        "MANUFACTURER_NAME" => "MODEL.MANUFACTURER.NAME"
                    ]
                ],
                $arCache
            )
        );
        $this->arResult["ELEMENT"]["OPTIONS"] = \ShopLaptop\OptionToLaptopTable::getList(
            array_merge(
                [
                    "filter" => [
                        "=LAPTOP_ID" => $this->arParams["LAPTOP_ID"]
                    ],
                    "select" => [
                        "*",
                        "OPTION_NAME"  => "OPTION.NAME",
                        "OPTION_VALUE" => "OPTION.VALUE"
                    ]
                ],
                $arCache
            )
        )->fetchAll();
        $this->IncludeComponentTemplate();
    }
}
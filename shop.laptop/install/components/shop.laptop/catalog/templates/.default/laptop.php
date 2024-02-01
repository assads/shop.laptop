<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
    die();
}
/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogProductsViewedComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
?>
<? $APPLICATION->IncludeComponent(
    "shop.laptop:detail",
    ".default",
    [
        "LAPTOP_ID" => $arResult["VARIABLES"]["LAPTOP_ID"],
        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
        "CACHE_TIME" => $arParams["CACHE_TIME"],
        "SEF_MODE" => $arParams["SEF_MODE"],
        "SEF_URL_TEMPLATES" => $arResult["URL_TEMPLATES"],
    ],
    $component
);?>
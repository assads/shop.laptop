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
?>
<? $APPLICATION->IncludeComponent(
    "shop.laptop:list",
    ".default",
    [
        "MANUFACTURER_ID" => $arResult["VARIABLES"]["MANUFACTURER_ID"],
        "MODEL_ID" => $arResult["VARIABLES"]["MODEL_ID"],
        "SEF_FOLDER" => $arParams["SEF_FOLDER"],
        "SEF_MODE" => $arParams["SEF_MODE"],
        "SEF_URL_TEMPLATES" => $arResult["URL_TEMPLATES"],
        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
        "CACHE_TIME" => $arParams["CACHE_TIME"],
        "COUNT" => $arParams["COUNT"],
    ],
    $component
);?>
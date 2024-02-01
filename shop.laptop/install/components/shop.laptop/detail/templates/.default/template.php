<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
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
\Bitrix\Main\UI\Extension::load("ui.bootstrap4");
?>
<div class="container">
    <div class="row rounded-3 shadow-sm">
        <div class="col-sm card-header"><?=Loc::getMessage("SHOP_LAPTOP_DETAIL_NAME");?></div>
        <div class="col-sm card-header"><?=Loc::getMessage("SHOP_LAPTOP_DETAIL_YEAR");?></div>
        <div class="col-sm card-header"><?=Loc::getMessage("SHOP_LAPTOP_DETAIL_PRICE");?></div>
        <div class="col-sm card-header"><?=Loc::getMessage("SHOP_LAPTOP_DETAIL_MODEL_NAME");?></div>
        <div class="col-sm card-header"><?=Loc::getMessage("SHOP_LAPTOP_DETAIL_MANUFACTURER_NAME");?></div>
        <div class="col-sm card-header"><?=Loc::getMessage("SHOP_LAPTOP_DETAIL_OPTIONS");?></div>
    </div>
    <div class="row card-body">
        <div class="col-sm"><?=$arResult["ELEMENT"]["NAME"];?></div>
        <div class="col-sm"><?=$arResult["ELEMENT"]["YEAR"];?></div>
        <div class="col-sm"><?=$arResult["ELEMENT"]["PRICE"];?></div>
        <div class="col-sm"><?=$arResult["ELEMENT"]["MODEL_NAME"];?></div>
        <div class="col-sm"><?=$arResult["ELEMENT"]["MANUFACTURER_NAME"];?></div>
        <div class="col-sm">
            <? foreach ($arResult["ELEMENT"]["OPTIONS"] as $arOption) : ?>
                <div class="d-flex text-muted pt-3">
                    <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                        <div class="d-flex justify-content-between">
                            <strong class="text-gray-dark"><?=$arOption["OPTION_NAME"];?></strong>
                            <span><?=$arOption["OPTION_VALUE"];?></span>
                        </div>
                    </div>
                </div>
            <? endforeach; ?>
        </div>
    </div>
</div>
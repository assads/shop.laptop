<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
    die();
}

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Iblock\Component\Tools;
Loc::loadMessages(__FILE__);

class ShopLaptopCatalogComponent extends CBitrixComponent
{
    public function onPrepareComponentParams($arParams): array
    {
        if (!Loader::includeModule("shop.laptop"))
        {
            $this->abortResultCache();
            ShowError(Loc::getMessage("SHOP_LAPTOP_CATALOG_ERROR_MODULE"));
            return [];
        }
        return $arParams;
    }

    public function executeComponent(): void
    {
        $componentPage = "";
        $templatesUrls = [
            "laptop"       => "detail/#LAPTOP_ID#/",
            "model"        => "#MANUFACTURER_ID#/#MODEL_ID#/",
            "manufacturer" => "#MANUFACTURER_ID#/",
        ];
        $variableAliases    = [];
        $componentVariables = [
            "MANUFACTURER_ID",
            "MODEL_ID",
            "LAPTOP_ID"
        ];
        if ($this->arParams["SEF_MODE"] == "Y")
        {
            $templatesUrls = \CComponentEngine::makeComponentUrlTemplates($templatesUrls, $this->arParams["SEF_URL_TEMPLATES"]);
            $componentPage = \CComponentEngine::parseComponentPath(
                $this->arParams["SEF_FOLDER"],
                $templatesUrls,
                $variables
            );
            \CComponentEngine::initComponentVariables($componentPage, $componentVariables, $variableAliases, $variables);
            $this->arResult = [
                "VARIABLES"     => $variables,
                "ALIASES"       => $variableAliases,
                "SEF_FOLDER"    => $this->arParams["SEF_FOLDER"],
                "URL_TEMPLATES" => $templatesUrls
            ];
        }
        else
        {
            global $APPLICATION;
            $variableAliases = \CComponentEngine::makeComponentVariableAliases([], $this->arParams["VARIABLE_ALIASES"]);
            \CComponentEngine::initComponentVariables(false, $componentVariables, $variableAliases, $variables);
            if (isset($variables["LAPTOP_ID"]) && intval($variables["LAPTOP_ID"]) > 0)
            {
                $componentPage = "laptop";
            }
            else
            {
                $componentPage = "list";
            }
            $curPage = $APPLICATION->GetCurPage();
            $this->arResult = [
                "VARIABLES"     => $variables,
                "ALIASES"       => $variableAliases,
                "SEF_FOLDER"    => $curPage,
                "URL_TEMPLATES" => [
                    "list"         => $curPage,
                    "laptop"       => $curPage."?LAPTOP_ID=#LAPTOP_ID#",
                    "manufacturer" => $curPage."?MANUFACTURER_ID=#MANUFACTURER_ID#",
                    "model"        => $curPage."?MODEL_ID=#MODEL_ID#&MANUFACTURER_ID=#MANUFACTURER_ID#",
                ]
            ];
        }
        if ($componentPage == "")
        {
            $componentPage = "list";
        }
        $this->IncludeComponentTemplate($componentPage);
    }
}
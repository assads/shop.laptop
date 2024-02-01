<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
    die();
}

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\UI\PageNavigation;
Loc::loadMessages(__FILE__);

class ShopLaptopListComponent extends \CBitrixComponent
{
    private $options = [];

    public function onPrepareComponentParams($arParams): array
    {
        if (!Loader::includeModule("shop.laptop"))
        {
            $this->abortResultCache();
            ShowError(Loc::getMessage("SHOP_LAPTOP_LIST_ERROR_MODULE"));
            return [];
        }
        if (isset($arParams["MANUFACTURER_ID"]))
        {
            $arParams["MANUFACTURER_ID"] = intval($arParams["MANUFACTURER_ID"]);
        }
        if (isset($arParams["MODEL_ID"]))
        {
            $arParams["MODEL_ID"] = intval($arParams["MODEL_ID"]);
        }
        if (!isset($arParams["COUNT"]))
        {
            $arParams["COUNT"] = 20;
        }
        else
        {
            $arParams["COUNT"] = intval($arParams["COUNT"]);
        }
        if (!isset($arParams["CACHE_TYPE"]))
        {
            $arParams["CACHE_TYPE"] = "A";
        }
        if (!isset($arParams["CACHE_TIME"]))
        {
            $arParams["CACHE_TIME"] = 86400;
        }
        if (!isset($arParams["SEF_FOLDER"]))
        {
            $arParams["SEF_FOLDER"] = SITE_DIR;
        }
        return $arParams;
    }

    protected function initGrid(): void
    {
        if (!isset($this->options["select"]))
        {
            $this->options["select"] = ["*"];
        }
        if ($this->arParams["CACHE_TYPE"] !== "N" && $this->arParams["CACHE_TIME"] > 0)
        {
            $this->options["cache"] = [
                "ttl"         => $this->arParams["CACHE_TIME"],
                "cache_joins" => true
            ];
        }
        if ($this->arResult["TYPE"] == "manufacturer")
        {
            $this->options["select"]["MANUFACTURER_ID"] = "ID";
            $res = \ShopLaptop\ManufacturerTable::getList($this->options);
            $map = \ShopLaptop\ManufacturerTable::getMap();
        }
        elseif ($this->arResult["TYPE"] == "model")
        {
            $this->options["select"]["MANUFACTURER_NAME"] = "MANUFACTURER.NAME";
            $this->options["filter"] = [
                "MANUFACTURER_ID" => $this->arParams["MANUFACTURER_ID"]
            ];
            $this->options["select"]["MODEL_ID"] = "ID";
            $res = \ShopLaptop\ModelTable::getList($this->options);
            $map = \ShopLaptop\ModelTable::getMap();
        }
        else
        {
            $this->options["select"]["MODEL_NAME"]        = "MODEL.NAME";
            $this->options["select"]["MANUFACTURER_ID"]   = "MODEL.MANUFACTURER.ID";
            $this->options["select"]["MANUFACTURER_NAME"] = "MODEL.MANUFACTURER.NAME";
            $this->options["select"]["LAPTOP_ID"]         = "ID";
            $this->options["filter"] = [
                "MODEL_ID" => $this->arParams["MODEL_ID"]
            ];
            $res = \ShopLaptop\LaptopTable::getList($this->options);
            $map = \ShopLaptop\LaptopTable::getMap();
        }
        if (!isset($this->arResult["GRID"]["COLUMNS"]))
        {
            $this->arResult["GRID"]["COLUMNS"] = [];
        }
        $sort = 100;
        foreach ($map as $mapClass => $mapItem)
        {
            if ($mapItem instanceof \Bitrix\Main\ORM\Fields\Relations\Reference)
            {
                continue;
            }
            $code = $mapItem->getColumnName();
            $name = $mapItem->getTitle();
            $this->arResult["GRID"]["COLUMNS"][] = [
                "id"          => $code,
                "name"        => $name,
                "sort"        => $code,
                "content"     => $name,
                "title"       => $name,
                "column_sort" => $sort,
                "default"     => true
            ];
            $sort++;
        }
        $this->arResult["GRID"]["ITEMS_COUNT"] = $res->getCount();
        $arItems = $res->fetchAll();
        if (!isset($this->arResult["GRID"]["ROWS"]))
        {
            $this->arResult["GRID"]["ROWS"] = [];
        }
        $arSenom = ["ID", "NAME"];
        foreach ($arItems as $arItem)
        {
            $arItem["PAGE_URL"] = $this->getPageUrl($arItem);
            if (isset($arItem["PAGE_URL"]))
            {
                $arItem["NAME"] = "<a href=\"".$arItem["PAGE_URL"]."\">".$arItem["NAME"]."</a>";
            }
            unset($arItem["PAGE_URL"]);
            foreach ($arItem as $arItemCode => $arItemValue)
            {
                if (strpos($arItemCode, "_") !== false)
                {
                    $arCode = explode("_", $arItemCode);
                    if (count($arCode) > 1 && in_array(end($arCode), $arSenom))
                    {
                        $c = 0;
                        foreach ($arSenom as $arSenomCode)
                        {
                            if (isset($arItem[$arCode[0]."_".$arSenomCode]))
                            {
                                $c++;
                            }
                        }
                        if ($c >= 2)
                        {
                            $arItem[$arCode[0]."_".$arSenom[0]] = $arItem[$arCode[0]."_".$arSenom[1]];
                            unset($arItem[$arCode[0]."_".$arSenom[1]]);
                        }
                    }
                }
            }
            $this->arResult["GRID"]["ROWS"][] = [
                "data" => $arItem
            ];
        }
    }

    protected function getPageUrl(array $arItem): string
    {
        $url = str_replace(
            [
                "#SITE_DIR#",
                "#MANUFACTURER_ID#",
                "#MODEL_ID#",
                "#LAPTOP_ID#"
            ],
            [
                $this->arParams["SEF_MODE"],
                (isset($arItem["MANUFACTURER_ID"]) ? $arItem["MANUFACTURER_ID"] : ""),
                (isset($arItem["MODEL_ID"])        ? $arItem["MODEL_ID"]        : ""),
                (isset($arItem["LAPTOP_ID"])       ? $arItem["LAPTOP_ID"]       : "")
            ],
            $this->arParams["SEF_URL_TEMPLATES"][$this->arResult["TYPE"]]
        );
        if ($this->arParams["SEF_MODE"] == "Y")
        {
            return "/".$url;
        }
        return $url;
    }

    public function executeComponent(): void
    {
        $this->arResult["TYPE"] = "manufacturer";
        if ($this->arParams["MODEL_ID"] > 0 && $this->arParams["MANUFACTURER_ID"] > 0)
        {
            $this->arResult["TYPE"] = "laptop";
        }
        elseif ($this->arParams["MANUFACTURER_ID"] > 0)
        {
            $this->arResult["TYPE"] = "model";
        }
        $this->arResult["GRID"] = [
            "GRID_ID" => "GRID_".$this->arResult["TYPE"]
        ];
        $grid      = new CGridOptions($this->arResult["GRID"]["GRID_ID"]);
        $paramSort = $grid->GetSorting(["sort" => ["ID" => "ASC"], "vars" => ["by" => "by", "order" => "order"]]);
        $paramNav  = $grid->GetNavParams(["nPageSize" => $this->arParams["COUNT"]]);
        $nav       = new Bitrix\Main\UI\PageNavigation($this->arResult["GRID"]["GRID_ID"]);
        $nav->allowAllRecords(true);
        $nav->setPageSize($paramNav["nPageSize"]);
        $nav->initFromUri();
        $this->options = [
            "order"       => $paramSort["sort"],
            "offset"      => $nav->getOffset(),
            "limit"       => $nav->getLimit(),
            "count_total" => true
        ];
        $this->initGrid();
        $nav->setRecordCount($this->arResult["GRID"]["ITEMS_COUNT"]);
        $this->arResult["GRID"]["SORT"]                    = $paramSort["sort"];
        $this->arResult["GRID"]["SORT_VARS"]               = $paramSort["vars"];
        $this->arResult["GRID"]["ROWS_COUNT"]              = $nav->getLimit();
        $this->arResult["GRID"]["TOTAL_ROWS_COUNT"]        = $nav->getRecordCount();
        $this->arResult["GRID"]["NAV_OBJECT"]              = $nav;
        $this->arResult["GRID"]["AJAX_ID"]                 = \CAjax::getComponentID("bitrix:main.ui.grid", ".default", "");
        $this->arResult["GRID"]["SHOW_ROW_CHECKBOXES"]     = false;
        $this->arResult["GRID"]["SHOW_SELECTED_COUNTER"]   = false;
        $this->arResult["GRID"]["SHOW_GRID_SETTINGS_MENU"] = false;
        $this->arResult["GRID"]["SHOW_PAGESIZE"]           = true;
        $this->arResult["GRID"]["ALLOW_SORT"]              = true;
        $this->arResult["GRID"]["DEFAULT_PAGE_SIZE"]       = $this->arParams["COUNT"];
        $this->arResult["GRID"]["PAGE_SIZES"]              = [
            ["NAME" => "5",  "VALUE" => "5"],
            ["NAME" => "10", "VALUE" => "10"],
            ["NAME" => "15", "VALUE" => "15"],
            ["NAME" => "20", "VALUE" => "20"]
        ];
        $this->IncludeComponentTemplate();
    }
}
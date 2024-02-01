<?
namespace ShopLaptop;

use Bitrix\Main\Entity;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class ModelTable extends Entity\DataManager
{
    public static function getTableName()
    {
        return "sl_model";
    }

    public static function getMap()
    {
        return [
            new Entity\IntegerField(
                "ID",
                [
                    "data_type"    => "integer",
                    "primary"      => true,
                    "autocomplete" => true,
                    "title"        => Loc::getMessage("SHOP_LAPTOP_MODEL_TABLE_ID"),
                ]
            ),
            new Entity\StringField(
                "NAME",
                [
                    "data_type" => "string",
                    "required"  => true,
                    "title"     => Loc::getMessage("SHOP_LAPTOP_MODEL_TABLE_NAME"),
                ]
            ),
            new Entity\IntegerField(
                "MANUFACTURER_ID",
                [
                    "data_type" => "integer",
                    "required"  => true,
                    "title"     => Loc::getMessage("SHOP_LAPTOP_MODEL_TABLE_MANUFACTURER_ID"),
                ]
            ),
            new Entity\ReferenceField(
                "MANUFACTURER",
                "\\ShopLaptop\\ManufacturerTable",
                [
                    "this.MANUFACTURER_ID" => "ref.ID"
                ]
            ),
        ];
    }
}
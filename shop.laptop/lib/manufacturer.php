<?
namespace ShopLaptop;

use Bitrix\Main\Entity;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class ManufacturerTable extends Entity\DataManager
{
    public static function getTableName()
    {
        return "sl_manufacturer";
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
                    "title"        => Loc::getMessage("SHOP_LAPTOP_MANUFACTURER_TABLE_ID"),
                ]
            ),
            new Entity\StringField(
                "NAME",
                [
                    "data_type" => "string",
                    "required"  => true,
                    "title"     => Loc::getMessage("SHOP_LAPTOP_MANUFACTURER_TABLE_NAME"),
                ]
            ),
        ];
    }
}
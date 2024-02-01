<?
namespace ShopLaptop;

use Bitrix\Main\Entity;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class LaptopTable extends Entity\DataManager
{
    public static function getTableName()
    {
        return "sl_laptop";
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
                    "title"        => Loc::getMessage("SHOP_LAPTOP_LAPTOP_TABLE_ID"),
                ]
            ),
            new Entity\StringField(
                "NAME",
                [
                    "data_type" => "string",
                    "required"  => true,
                    "title"     => Loc::getMessage("SHOP_LAPTOP_LAPTOP_TABLE_NAME"),
                ]
            ),
            new Entity\IntegerField(
                "YEAR",
                [
                    "data_type" => "integer",
                    "required"  => true,
                    "title"     => Loc::getMessage("SHOP_LAPTOP_LAPTOP_TABLE_YEAR"),
                ]
            ),
            new Entity\IntegerField(
                "PRICE",
                [
                    "data_type" => "float",
                    "required"  => true,
                    "title"     => Loc::getMessage("SHOP_LAPTOP_LAPTOP_TABLE_PRICE"),
                ]
            ),
            new Entity\IntegerField(
                "MODEL_ID",
                [
                    "data_type" => "integer",
                    "required"  => true,
                    "title"     => Loc::getMessage("SHOP_LAPTOP_LAPTOP_TABLE_MODEL_ID"),
                ]
            ),
            new Entity\ReferenceField(
                "MODEL",
                "\\ShopLaptop\\ModelTable",
                [
                    "this.MODEL_ID" => "ref.ID"
                ]
            ),
        ];
    }
}
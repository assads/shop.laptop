<?
namespace ShopLaptop;

use Bitrix\Main\Entity;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class OptionToLaptopTable extends Entity\DataManager
{
    public static function getTableName()
    {
        return "sl_option_to_laptop";
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
                    "title"        => Loc::getMessage("SHOP_LAPTOP_OPTION_TO_LAPTOP_TABLE_ID"),
                ]
            ),
            new Entity\IntegerField(
                "OPTION_ID",
                [
                    "data_type" => "integer",
                    "required"  => true,
                    "title"     => Loc::getMessage("SHOP_LAPTOP_OPTION_TO_LAPTOP_TABLE_OPTION_ID"),
                ]
            ),
            new Entity\IntegerField(
                "LAPTOP_ID",
                [
                    "data_type" => "integer",
                    "required"  => true,
                    "title"     => Loc::getMessage("SHOP_LAPTOP_OPTION_TO_LAPTOP_TABLE_LAPTOP_ID"),
                ]
            ),
            new Entity\ReferenceField(
                "OPTION",
                "\\ShopLaptop\\OptionTable",
                [
                    "this.OPTION_ID" => "ref.ID"
                ]
            ),
            new Entity\ReferenceField(
                "LAPTOP",
                "\\ShopLaptop\\LaptopTable",
                [
                    "this.LAPTOP_ID" => "ref.ID"
                ]
            ),
        ];
    }
}
<?
namespace ShopLaptop;

use Bitrix\Main\Entity;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class OptionTable extends Entity\DataManager
{
    public static function getTableName()
    {
        return "sl_option";
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
                    "title"        => Loc::getMessage("SHOP_LAPTOP_OPTION_TABLE_ID"),
                ]
            ),
            new Entity\StringField(
                "NAME",
                [
                    "data_type" => "string",
                    "required"  => true,
                    "title"     => Loc::getMessage("SHOP_LAPTOP_OPTION_TABLE_NAME"),
                ]
            ),
            new Entity\StringField(
                "VALUE",
                [
                    "data_type" => "string",
                    "required"  => true,
                    "title"     => Loc::getMessage("SHOP_LAPTOP_OPTION_TABLE_VALUE"),
                ]
            ),
        ];
    }
}
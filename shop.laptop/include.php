<?
CModule::AddAutoloadClasses(
    "shop.laptop",
    [
        "\\ShopLaptop\\ManufacturerTable"   => "lib/manufacturer.php",
        "\\ShopLaptop\\ModelTable"          => "lib/model.php",
        "\\ShopLaptop\\LaptopTable"         => "lib/laptop.php",
        "\\ShopLaptop\\OptionTable"         => "lib/option.php",
        "\\ShopLaptop\\OptionToLaptopTable" => "lib/option_to_laptop.php"
    ]
);
?>
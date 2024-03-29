CREATE TABLE `sl_manufacturer` (
    `ID` INT(11) unsigned NOT NULL AUTO_INCREMENT,
    `NAME` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
    PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
CREATE TABLE `sl_model` (
    `ID` INT(11) unsigned NOT NULL AUTO_INCREMENT,
    `NAME` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
    `MANUFACTURER_ID` INT(11) NOT NULL,
    PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
CREATE TABLE `sl_laptop` (
    `ID` INT(11) unsigned NOT NULL AUTO_INCREMENT,
    `NAME` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
    `YEAR` INT(4) NOT NULL,
    `PRICE` DECIMAL(18,2) NOT NULL,
    `MODEL_ID` INT(11) NOT NULL,
    PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
CREATE TABLE `sl_option` (
    `ID` INT(11) unsigned NOT NULL AUTO_INCREMENT,
    `NAME` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
    `VALUE` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
    PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
CREATE TABLE `sl_option_to_laptop` (
    `ID` INT(11) unsigned NOT NULL AUTO_INCREMENT,
    `OPTION_ID` INT(11) NOT NULL,
    `LAPTOP_ID` INT(11) NOT NULL,
    PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
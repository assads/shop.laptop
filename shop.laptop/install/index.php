<?
if (class_exists("shop_laptop"))
{
    return;
}
use Bitrix\Main\IO\Directory;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class shop_laptop extends CModule
{
    var $MODULE_ID = "shop.laptop";
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_GROUP_RIGHTS = "Y";
    var $errors = false;

    function __construct()
    {
        global $DOCUMENT_ROOT;
        $arModuleVersion = [];
        $this->path      = GetLocalPath("modules/" . $this->MODULE_ID);
        include($DOCUMENT_ROOT . $this->path . "/install/version.php");
        if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion))
        {
            $this->MODULE_VERSION      = $arModuleVersion["VERSION"];
            $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        }
        $this->MODULE_NAME        = Loc::getMessage("SHOP_LAPTOP_MODULE_INSTALL_NAME");
        $this->MODULE_DESCRIPTION = Loc::getMessage("SHOP_LAPTOP_MODULE_INSTALL_DESCRIPTION");
        $this->PARTNER_NAME       = Loc::getMessage("SHOP_LAPTOP_MODULE_INSTALL_PARTNER_NAME");
        $this->PARTNER_URI        = Loc::getMessage("SHOP_LAPTOP_MODULE_INSTALL_PARTNER_URI");
    }

    function DoInstall()
    {
        global $APPLICATION, $DOCUMENT_ROOT, $step;
        if (!IsModuleInstalled($this->MODULE_ID))
        {
            $step = intval($step);
            if ($step < 2)
            {
                $this->InstallFiles();
                if ($this->errors !== false)
                {
                    if (is_array($this->errors))
                    {
                        $this->errors = implode("<br>", $this->errors);
                    }
                    $APPLICATION->ThrowException($this->errors);
                    return false;
                }
                $APPLICATION->includeAdminFile(
                    Loc::getMessage("SHOP_LAPTOP_MODULE_INSTALL_TITLE"),
                    $DOCUMENT_ROOT . $this->path . "/install/step1.php"
                );
            }
            elseif ($step == 2)
            {
                $this->InstallDB(["demo" => $_REQUEST["demo"]]);
                if (is_array($this->errors))
                {
                    $this->errors = implode("<br>", $this->errors);
                }
                if ($this->errors != false)
                {
                    $APPLICATION->ThrowException($this->errors);
                    return false;
                }
                else
                {
                    RegisterModule($this->MODULE_ID);
                }
                $APPLICATION->includeAdminFile(
                    Loc::getMessage("SHOP_LAPTOP_MODULE_INSTALL_TITLE_2"),
                    $DOCUMENT_ROOT . $this->path . "/install/step2.php"
                );
            }
        }
        else
        {
            $APPLICATION->ThrowException(Loc::getMessage("SHOP_LAPTOP_MODULE_INSTALL_IS"));
            return false;
        }
    }

    function InstallFiles()
    {
        global $DOCUMENT_ROOT;
        $copy = CopyDirFiles(
            $DOCUMENT_ROOT . $this->path . "/install/components/",
            str_replace(["modules", $this->MODULE_ID], ["components", ""], $DOCUMENT_ROOT . $this->path),
            true,
            true
        );
        if (!$copy)
        {
            $this->errors = [Loc::getMessage("SHOP_LAPTOP_MODULE_INSTALL_COPY", array("#PATH#" => $DOCUMENT_ROOT . $this->path."/components/"))];
        }
        return true;
    }

    function InstallDB($arParams = [])
    {
        global $DOCUMENT_ROOT, $DB;
        if (!$DB->query("SELECT * FROM sl_manufacturer", true))
        {
            $this->errors = $DB->RunSQLBatch($DOCUMENT_ROOT . $this->path . "/install/db/" . ToLower($DB->type) . "/install.sql");
        }
        if ($arParams["demo"] == "Y")
        {
            $DB->RunSQLBatch($DOCUMENT_ROOT . $this->path . "/install/db/" . ToLower($DB->type) . "/demo.sql");
        }
        return true;
    }

    function DoUninstall()
    {
        global $DOCUMENT_ROOT, $APPLICATION, $step;
        $step = intval($step);
        if ($step < 2)
        {
            $APPLICATION->includeAdminFile(
                Loc::getMessage("SHOP_LAPTOP_MODULE_UINSTALL_TITLE"),
                $DOCUMENT_ROOT . $this->path . "/install/unstep1.php"
            );
        }
        elseif ($step == 2)
        {
            $this->UninstallFiles();
            $this->UninstallDB(["savedata" => $_REQUEST["savedata"]]);
            UnRegisterModule($this->MODULE_ID);
            if (is_array($this->errors))
            {
                $this->errors = implode("<br>", $this->errors);
            }
            if ($this->errors != false)
            {
                $APPLICATION->ThrowException($this->errors);
                return false;
            }
            $APPLICATION->includeAdminFile(
                Loc::getMessage("SHOP_LAPTOP_MODULE_UINSTALL_TITLE"),
                $DOCUMENT_ROOT . $this->path . "/install/unstep2.php"
            );
        }
    }

    function UninstallFiles()
    {
        DeleteDirFilesEx(str_replace("modules", "components", $this->path));
        return true;
    }

    function UninstallDB($arParams = [])
    {
        global $DB, $DOCUMENT_ROOT;
        if ($arParams["savedata"] !== "Y")
        {
            $this->errors = $DB->RunSQLBatch($DOCUMENT_ROOT . $this->path . "/install/db/" . ToLower($DB->type) . "/uninstall.sql");
        }
        return true;
    }
}
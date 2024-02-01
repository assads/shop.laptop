<?
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
$mid          = "shop.laptop";
$moduleAccess = $APPLICATION->GetGroupRight($mid);
if ($moduleAccess >= "W")
{
    if (!Loader::includeModule($mid))
    {
        CAdminMessage::ShowMessage(Loc::getMessage("SHOP_LAPTOP_OPTIONS_NOT_FOUND_MODULE"));
    }
    else
    {
        $aTabs = [
            [
                "DIV"   => "edit1",
                "TAB"   => Loc::getMessage("SHOP_LAPTOP_OPTIONS_TAB_SETTINGS"),
                "ICON"  => "",
                "TITLE" => Loc::getMessage("SHOP_LAPTOP_OPTIONS_TITLE_SETTINGS")
            ]
        ];
        $tabControl = new CAdminTabControl("tabControl", $aTabs);
        $tabControl->Begin();
        ?>
        <form method="post" action="<?=$APPLICATION->GetCurPage()?>?mid=<?=htmlspecialcharsbx($mid)?>&lang=<?=LANG?>">
            <? $tabControl->BeginNextTab(); ?>
                <? require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/admin/group_rights.php'); ?>
            <? $tabControl->Buttons(); ?>
                <input type="submit" name="Update" value="<?=Loc::getMessage("MAIN_SAVE")?>" title="<?=Loc::getMessage("MAIN_OPT_SAVE_TITLE")?>" class="adm-btn-save">
                <?=bitrix_sessid_post();?>
            <? $tabControl->End(); ?>
        </form>
        <?
    }
}
else
{
    CAdminMessage::ShowMessage(Loc::getMessage("SHOP_LAPTOP_OPTIONS_ACCESS_DENIED"));
}
?>
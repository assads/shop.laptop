<?
if (!check_bitrix_sessid())
{
    return;
}
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
echo CAdminMessage::ShowNote(Loc::getMessage("SHOP_LAPTOP_MODULE_INSTALL_STEP_1_TITLE"));
?>
<form action="<?=$APPLICATION->GetCurPage()?>">
    <?=bitrix_sessid_post()?>
    <input type="hidden" name="lang" value="<?=LANG?>">
    <input type="hidden" name="id" value="shop.laptop">
    <input type="hidden" name="install" value="Y">
    <input type="hidden" name="step" value="2">
    <p><?=Loc::getMessage("SHOP_LAPTOP_MODULE_INSTALL_STEP_1_DEMO")?></p>
    <p><input type="checkbox" name="demo" id="demo" value="Y" checked><label for="demo"><?=Loc::getMessage("SHOP_LAPTOP_MODULE_INSTALL_STEP_1_DEMO_Y")?></label></p>
    <input type="submit" name="inst" value="<?=Loc::getMessage("SHOP_LAPTOP_MODULE_INSTALL_STEP_1_BTN")?>">
</form>
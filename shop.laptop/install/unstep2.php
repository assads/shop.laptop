<?
if (!check_bitrix_sessid())
{
    return;
}
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
if ($ex = $APPLICATION->GetException())
{
    echo CAdminMessage::ShowMessage(
        [
            "TYPE"    => "ERROR",
            "MESSAGE" => Loc::getMessage("MOD_UNINST_ERR"),
            "DETAILS" => $ex->GetString(),
            "HTML"    => true,
        ]
    );
}
else
{
    echo CAdminMessage::ShowNote(Loc::getMessage("MOD_UNINST_OK"));
}
?>
<form action="<?=$APPLICATION->GetCurPage()?>">
    <input type="hidden" name="lang" value="<?=LANG;?>">
    <input type="submit" name="" value="<?=Loc::getMessage("MOD_BACK");?>">
<form>
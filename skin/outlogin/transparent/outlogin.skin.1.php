<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 

if ($g4['https_url']) {
    $outlogin_url = $_GET['url'];
    if ($outlogin_url) {
        if (preg_match("/^\.\.\//", $outlogin_url)) {
            $outlogin_url = urlencode($g4[url]."/".preg_replace("/^\.\.\//", "", $outlogin_url));
        }
        else {
            $purl = parse_url($g4[url]);
            if ($purl[path]) {
                $path = urlencode($purl[path]);
                $urlencode = preg_replace("/".$path."/", "", $urlencode);
            }
            $outlogin_url = $g4[url].$urlencode;
        }
    }
    else {
        $outlogin_url = $g4[url];
    }
}
else {
    $outlogin_url = $urlencode;
}

// ���̵� �ڵ����� 
$ck_auto_mb_id = decrypt( get_cookie("ck_auto_mb_id"), $g4[encrypt_key]); 
if ($ck_auto_mb_id) { 
    $auto_mb_id = "checked"; 
}
?>

<!-- �α��� �� �ܺηα��� ���� -->
<table width="100%" border="0" cellpadding="0" cellspacing="1" style='border:solid 1px #ddd;'>
<tr>
<td>
<form name="fhead" method="post" onsubmit="return fhead_submit(this);" autocomplete="off" style="margin:0px;">
<table width="100%" border="0" cellpadding="2" cellspacing="0">
<input type="hidden" name="url" value="<?=$outlogin_url?>">
<tr> 
    <td width="100%" colspan="2">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr><td width="100%" height="4" colspan="2"></td></tr>
        <tr> 
            <td width="120">
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="120" height="23" colspan="2" align="center" valign="top">
                        <? if ($ck_auto_mb_id) {?>
                        <input class=ed name="mb_id" type="text" style="width:110;height:19; background-color:transparent;" maxlength="20" required itemname="���̵�" value='<?=$ck_auto_mb_id?>' align='absmiddle'>
                        <? } else { ?>
                        <input class=ed name="mb_id" type="text" style="width:110;height:19; background-color:transparent;" maxlength="20" required itemname="���̵�" value='' align='absmiddle'>
                        <? } ?>
                    </td>
                </tr>
                <tr> 
                    <td width="120" height="23" colspan="2" align="center"><input class=ed name="mb_password" id="mb_password" type="password" style="width:110;height:19; background-color:transparent;" maxlength="20" required itemname="��й�ȣ" value='' align='absmiddle'></td>
                </tr>
                </table>
            </td>
            <td width="55" height="46" rowspan="2" align="center"><input type="image" src="<?=$outlogin_skin_path?>/img/login_button.gif" width="40" height="45" align="absmiddle" onfocus="this.blur()"align='absmiddle'></td>
        </tr>
        </table>
	</td>
</tr>
<tr> 
    <td width="45" height="20" align="left">
    <input type="checkbox" name="auto_login" value="1" onclick="if (this.checked) { if (confirm('�ڵ��α����� ����Ͻø� �������� ȸ�����̵�� ��й�ȣ�� �Է��Ͻ� �ʿ䰡 �����ϴ�.\n\n\������ҿ����� ���������� ����� �� ������ ����� �����Ͽ� �ֽʽÿ�.\n\n�ڵ��α����� ����Ͻðڽ��ϱ�?')) { this.checked = true; } else { this.checked = false; } }"><img src="<?=$outlogin_skin_path?>/img/login_auto.gif" width="22" height="20" align="absmiddle">
    </td>
    <td height="20" align="center">
        <a href="<?=$g4[bbs_path]?>/register.php" onfocus="this.blur()"><img src="<?=$outlogin_skin_path?>/img/login_join_button.gif" width="46" height="20" border="0"></a>
        <a href="javascript:win_password_lost();" onfocus="this.blur()"><img src="<?=$outlogin_skin_path?>/img/login_pw_find_button.gif" width="61" height="20" border="0"></a>
	</td>
</tr>
</table>
</form>
</td>
</tr>
</table>

<script type="text/javascript">
function fhead_submit(f)
{
    if (!f.mb_id.value)
    {
        alert("ȸ�����̵� �Է��Ͻʽÿ�.");
        f.mb_id.focus();
        return false;
    }

    if (!f.mb_password.value)
    {
        alert("�н����带 �Է��Ͻʽÿ�.");
        f.mb_password.focus();
        return false;
    }

    <?
    if ($g4[https_url])
        echo "f.action = '$g4[https_url]/$g4[bbs]/login_check.php';";
    else
        echo "f.action = '$g4[bbs_path]/login_check.php';";
    ?>

    return true;
}
</script>
<!-- �α��� �� �ܺηα��� �� -->

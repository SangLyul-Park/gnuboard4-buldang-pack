<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 
?>

<form name="fregister" method="POST" onsubmit="return fregister_submit(this);" autocomplete="off">

<table width=600 cellspacing=0 align=center><tr><td align=center>

    <table width="100%" cellspacing="0" cellpadding="0">
    <tr> 
        <td align=center><img src="<?=$member_skin_path?>/img/join_title.gif" width="624" height="72"></td>
    </tr>
    </table>

    <? if ($g4['member_suggest_join']) { // ��õ+�����������θ� ���԰����ϰ� ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td height=25></td>
        </tr>
        <tr>
            <td bgcolor="#cccccc" width=100%>
                <table cellspacing=1 cellpadding=0 width=100% border=0>
                <tr bgcolor="#ffffff"> 
                    <td width="140" height=30>&nbsp;&nbsp;&nbsp;<b>��õ�ξ��̵�</b></td>
                    <td width="">&nbsp;&nbsp;&nbsp;<input name=mb_recommend itemname="��õ�ξ��̵�" required class=ed></td>
                </tr>
                <tr bgcolor="#ffffff"> 
                    <td height=30>&nbsp;&nbsp;&nbsp;<b>����������ȣ</b></td>
                    <td>&nbsp;&nbsp;&nbsp;<input name=join_code itemname="����������ȣ" required maxlength=6 class=ed></td>
                </tr>
                </table>
            </td>
        </tr>
    </table>

    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td height=25></td>
        </tr>
        <tr>
            <td bgcolor="#ffffff" width=100%>
                <table cellspacing=1 width=100% border=0>
                <tr> 
                    <td>
                    <b><?=$config['cf_title']?>�� ���� ȸ���� ��õ�� ���ؼ��� ȸ�� ������ ����</b>�ϸ�, <br>
                    ��õ�� ���̵�� ������ȣ�� ��õ���� ���� ȸ������ �����Ŀ��� ����� �� �����ϴ� (1���� ��õ=1�� ����). <br>
                    ȸ�� ���Թ��Ǵ� <?=$config['cf_title']?> ȸ���е鲲 �Ͻñ⸦ �ٶ��ϴ�.
                    </td>
                </tr>
                </table>
            </td>
        </tr>
    </table>
    <? } ?>

    <br>
    <table width="100%" cellpadding="4" cellspacing="0" bgcolor=#EEEEEE>
        <tr> 
            <td height=20>&nbsp; <b>ȸ�����</b></td>
        </tr>
        <tr> 
            <td align="center" valign="top"><textarea style="width: 98%" rows=5 readonly class=ed><?=get_text($config[cf_stipulation])?></textarea></td>
        </tr>
        <tr> 
            <td height=20 valign=top>&nbsp; <input type=checkbox value=1 name=agree id=agree>&nbsp;<label for=agree>�����մϴ�.</label>
            <input type=checkbox value=1 name=agree_no0 id=agree_no0 onClick="this.checked=false;history.go(-1);">&nbsp;<label for=agree_no0>�������� �ʽ��ϴ�.</label>
            </td>
        </tr>
    </table>

    <table width="100%" cellpadding="4" cellspacing="0" bgcolor=#EEEEEE>
        <tr> 
            <td colspan=3 height=20>&nbsp; <b>����������޹�ħ</b></td>
        </tr>
        <tr>
            <td align="center" valign="top" width="33%">
                <textarea style="width: 98%;" rows=5 readonly class=ed><?=get_text($config[cf_privacy_2])?></textarea>
            </td>
            <td align="center" valign="top" width="33%">
                <textarea style="width: 98%;" rows=5 readonly class=ed><?=get_text($config[cf_privacy_3])?></textarea>
            </td>
            <td align="center" valign="top"  width="33%">
                <textarea style="width: 98%;" rows=5 readonly class=ed><?=get_text($config[cf_privacy_1])?></textarea>
            </td>
        </tr>
        <tr>
            <td colspan=3 height=20 valign=top>&nbsp; <input type=checkbox value=1 name=agree2 id=agree2>&nbsp;<label for=agree2>�����մϴ�.</label>
               <input type=checkbox value=1 name=agree_no2 id=agree_no2 onClick="this.checked=false;history.go(-1);">&nbsp;<label for=agree_no2>�������� �ʽ��ϴ�.</label>
            </td>
        </tr>
    </table>

    <? if (trim($config[cf_privacy_4])) { ?>
    <table width="100%" cellpadding="4" cellspacing="0" bgcolor=#EEEEEE>
        <tr> 
           <td align="center" valign="top"><textarea style="width: 98%" rows=4 readonly class=ed><?=get_text($config[cf_privacy_4])?></textarea>
           </td>
        </tr>
        <tr>
            <td height=20 valign=top>&nbsp; <input type=checkbox value=1 name=agree4 id=agree4>&nbsp;<label for=agree4>�����մϴ�.</label>
                �� "����" �Ͻô� ��� üũ�� �ּ���.
            </td>
        </tr>
    </table>
    <? } ?>

</td></tr></table>

<br>
<div align=center>
<input type=image src="<?=$member_skin_path?>/img/btn_agreement.gif" border=0>&nbsp;&nbsp;&nbsp;<img src="<?=$member_skin_path?>/img/btn_dont_agreement.gif" border=0 onClick="history.go(-1);" style="cursor:pointer;">
</div>

</form>


<script type="text/javascript">
function fregister_submit(f) 
{
    var agree1 = document.getElementsByName("agree");
    if (!agree1[0].checked) {
        alert("ȸ�����Ծ���� ���뿡 �����ϼž� ȸ������ �Ͻ� �� �ֽ��ϴ�.");
        agree1[0].focus();
        return false;
    }

    var agree2 = document.getElementsByName("agree2");
    if (!agree2[0].checked) {
        alert("����������޹�ħ�� ���뿡 �����ϼž� ȸ������ �Ͻ� �� �ֽ��ϴ�.");
        agree2[0].focus();
        return false;
    }

    f.action = './register_form.php';
    return true;
}

if (typeof(document.fregister.mb_name) != "undefined")
    document.fregister.mb_name.focus();
</script>

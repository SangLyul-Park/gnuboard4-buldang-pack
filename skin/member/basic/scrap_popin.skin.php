<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 

// ��ũ�� �޸𺰷� �����ϱ�
$sql = " select distinct ms_memo from $g4[scrap_table] where mb_id = '$member[mb_id]' and ms_memo != '' ";
$result = sql_query($sql);
$memo_str = "<select name='ms_memo' onchange=\"javascript:document.getElementById('wr_content').value=this.value;\">";
$memo_str .= "<option value=''>���� ����ϴ� ����޸� �����ϱ�</option>";
    for ($i=0; $row=sql_fetch_array($result); $i++)
    {
        $memo_str .= "<option value='$row[ms_memo]'";
        $memo_str .= ">" . cut_str($row[ms_memo],60,'') . "</option>";
    }
    $memo_str .= "</select>";
?>

<table width="95%" height="50" border="0" cellpadding="0" cellspacing="0">
<tr>
    <td align="center" valign="middle" bgcolor="#EBEBEB">
        <table width="98%" height="40" border="0" cellspacing="0" cellpadding="0">
        <tr> 
            <td width="25" align="center" bgcolor="#FFFFFF" ><img src="<?=$member_skin_path?>/img/icon_01.gif" width="5" height="5"></td>
            <td width="75" align="left" bgcolor="#FFFFFF" ><font color="#666666"><b>��ũ���ϱ�</b></font></td>
            <td width="490" bgcolor="#FFFFFF" ></td>
        </tr>
        </table></td>
</tr>
</table>

<table width="95%" border="0" cellspacing="0" cellpadding="0">
<form name=f_scrap_popin method=post action="./scrap_popin_update.php">
<input type="hidden" name="bo_table" value="<?=$bo_table?>">
<input type="hidden" name="wr_id"    value="<?=$wr_id?>">
<input type="hidden" name="wr_mb_id" value="<?=$write[mb_id]?>">
<input type="hidden" name="wr_subject" value="<?=$write[wr_subject]?>">
<tr> 
    <td height="180" align="center" valign="top"><table width="98%" border="0" cellspacing="0" cellpadding="0">
            <tr> 
                <td height="20"></td>
            </tr>
            <tr> 
                <td height="2" bgcolor="#808080"></td>
            </tr>
            <tr> 
                <td height="2" align="center" valign="top" bgcolor="#FFFFFF"><table width="98%" border="0" cellspacing="0" cellpadding="0">
                        <tr> 
                            <td width="80" height="27" align="center"><b>����</b></td>
                            <td width="10" valign="bottom"><img src="<?=$member_skin_path?>/img/l.gif" width="1" height="8"></td>
                            <td width="450" style='word-break:break-all;'><?=get_text(cut_str($write[wr_subject], 255))?></td>
                        </tr>
                        <tr> 
                            <td height="1" colspan="3" bgcolor="#E9E9E9"></td>
                        </tr>
                        <tr> 
                            <td width="80" height="150" align="center"><b>����޸�</b></td>
                            <td width="10" valign="bottom"><img src="<?=$member_skin_path?>/img/l.gif" width="1" height="8"></td>
                            <td>
                            <?=$memo_str?>
                            <textarea name="wr_content" id="wr_content" rows="3" style="width:90%;"></textarea>
                            <br>* ����޸�� ��ũ���� �з� �� �˻��� �� ���� Ű���� �Դϴ� (��: ��ũ��).
                            <br>* ���ο� ����޸�� ���� �Է��ؾ� �մϴ�.
                            <br>* ����޸� �Է����� �ʾƵ� ������, ���� ����� ���ؼ� �Է��ϴ°� �����ϴ�.
                            </td>
                        </tr>
                    </table></td>
            </tr>
        </table></td>
</tr>
<tr> 
    <td height="2" align="center" valign="top" bgcolor="#D5D5D5"></td>
</tr>
<tr>
    <td height="2" align="center" valign="top" bgcolor="#E6E6E6"></td>
</tr>
<tr>
    <td height="40" align="center" valign="bottom"><INPUT type=image width="40" height="20" src="<?=$member_skin_path?>/img/ok_btn.gif" border=0></td>
</tr>
</form>
</table>

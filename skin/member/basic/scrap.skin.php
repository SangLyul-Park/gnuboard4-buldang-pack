<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 

// �Խ��� ��Ϻ��� �����ϱ�
$sql = " select distinct a.bo_table, b.bo_subject from $g4[scrap_table] a left join $g4[board_table] b on a.bo_table=b.bo_table where a.mb_id = '$member[mb_id]' ";
$result = sql_query($sql);
$str = "<select name='bo_table' onchange=\"location='$g4[bbs_path]/scrap.php?head_on=$head_on&mnb=$mnb&snb=$snb&sfl=bo_table&stx='+this.value;\">";
$str .= "<option value='all'>��ü��Ϻ���</option>";
    for ($i=0; $row=sql_fetch_array($result); $i++)
    {
        $str .= "<option value='$row[bo_table]'";
        if ($sfl=='bo_table' and $row[bo_table] == $stx) $str .= " selected";
        $str .= ">$row[bo_subject]</option>";
    }
    $str .= "</select>";

// ��ũ�� �޸𺰷� �����ϱ�
$sql = " select distinct ms_memo from $g4[scrap_table] where mb_id = '$member[mb_id]' and ms_memo != '' ";
$result = sql_query($sql);
$memo_str0 = "<select name='ms_memo' onchange=\"location='$g4[bbs_path]/scrap.php?head_on=$head_on&mnb=$mnb&snb=$snb&sfl=ms_memo&stx='+this.value;\">";
$memo_str = "<option value='all'>��ü��Ϻ���</option>";
    for ($i=0; $row=sql_fetch_array($result); $i++)
    {
        $memo_str .= "<option value='$row[ms_memo]'";
        if ($sfl=='ms_memo' and $row[ms_memo] == $stx) $memo_str .= " selected";
        $memo_str .= ">" . cut_str($row[ms_memo],30,'') . "</option>";
    }
    $memo_str .= "</select>";
$memo_str_list = $memo_str0 . $memo_str;
?>

<script type="text/javascript" src="<?=$g4[path]?>/js/sideview.js"></script>


<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
<form name=fsearch method=get>
<input type=hidden name=head_on value=<?=$head_on?>>
<input type=hidden name=mnb value=<?=$mnb?>>
<input type=hidden name=snb value=<?=$snb?>>

<tr> 
    <td height="40" width="400" align="left">
    <a href="<?=$g4[bbs_path]?>/scrap.php?head_on=<?=$head_on?>&mnb=<?=$mnb?>&snb=<?=$snb?>">ó��</a>&nbsp;&nbsp;<?=$str?>&nbsp;&nbsp;<?=$memo_str_list?>
    </td>
    <td align=right>
        <select name=sfl class=cssfl>
            <option value='wr_subject_memo' <? if ($sfl=='wr_subject_memo') echo "selected" ?> >����+�޸�</option>
            <option value='wr_subject' <? if ($sfl=='wr_subject') echo "selected" ?> >����</option>
            <option value='ms_memo' <? if ($sfl=='ms_memo') echo "selected" ?> >�޸�</option>
            <option value='wr_mb_id' <? if ($sfl=='wr_mb_id') echo "selected" ?> >�۾���(���̵�+����)</option>
            <option value='bo_table' <? if ($sfl=='bo_table') echo "selected" ?> >�Խ���</option>
        </select>
        <input type=text name=stx required itemname='�˻���' value='<? echo $stx ?>'>
        <input type=image src='<?=$g4[admin_path]?>/img/btn_search.gif' align=absmiddle></td>
    </td>
</tr>
</form>
</table>

<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr> 
    <td height="200" align="center" valign="top">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
            <td height="2" bgcolor="#808080"></td>
        </tr>
        <tr> 
            <td width="98%" bgcolor="#FFFFFF">
                <table width=100% cellpadding=1 cellspacing=1 border=0>
                <colgroup width=35>
                <colgroup width=120>
                <colgroup width=200>
                <colgroup width=80>
                <colgroup width=''>
                <colgroup width=80>
                <colgroup width=50>
                <tr bgcolor=#E1E1E1 align=center> 
                    <td height="24" align=center><b>��ȣ</b></td>
                    <td><b>�Խ���</b></td>
                    <td><b>����</b></td>
                    <td><b>�۾���</b></td>
                    <td><b>�޸�</b></td>
                    <td><b>�����Ͻ�</b></td>
                    <td><b>����</b></td>
                </tr>

                <? for ($i=0; $i<count($list); $i++) { ?>
                    <tr height=25 bgcolor="#F6F6F6" align="center"> 
                        <td height="24"><?=$list[$i][num]?></td>
                        <td>
                        <? if ($head_on) { ?>
                            <a href="<?=$list[$i][opener_href]?>">
                        <? } else { ?>
                            <a href="javascript:;" onclick="opener.document.location.href='<?=$list[$i][opener_href]?>';">
                        <? } ?>
                        <?=$list[$i][bo_subject]?></a>
                        </td>
                        <? // ��б��� ��ũ���� ��� ��б� �������� �տ� ǥ��
                        if ($list[$i][secret]) 
                            $secret_icon = "<img src='$member_skin_path/img/icon_secret.gif'>";
                        else
                            $secret_icon = "";
                        ?>
                        <td align="left" style='word-break:break-all;'><?=$secret_icon?>&nbsp;
                        <? if ($head_on) { ?>
                            <a href="<?=$list[$i][opener_href_wr_id]?>" title="<?=$list[$i][subject]?>">
                        <? } else { ?>
                            <a href="javascript:;" onclick="opener.document.location.href='<?=$list[$i][opener_href_wr_id]?>';" title="<?=$list[$i][subject]?>">
                        <? } ?>
                        <?=cut_str($list[$i][wr_subject],30)?></a></td>
                        <td><?=$list[$i][mb_nick]?></td>
                        <td align="left" style='word-break:break-all;'>&nbsp;<a href="#" title="<?=$list[$i][ms_memo]?>"><?=$list[$i][ms_memo]?>
                        &nbsp;<a href="javascript:memo_box(<?=$list[$i][ms_id]?>)"><img src='<?=$member_skin_path?>/img/co_btn_modify.gif' border='0' align='absmiddle'></a>
                        <span id='memo_<?=$list[$i][ms_id]?>' style='display:none;'>
                        <input type="type" class="ed" name="memo_edit_<?=$list[$i][ms_id]?>" id="memo_edit_<?=$list[$i][ms_id]?>" size="30" value="<?=preg_replace("/\"/", "&#034;", stripslashes(get_text($list[$i][ms_memo],0)))?>" />
                        <a href='javascript:memo_update(<?=$list[$i][ms_id]?>)'><img src='<?=$member_skin_path?>/img/btn_c_ok.gif' border='0'/></a>
                        <BR>
                        <?
                        $memo_str_tmp = "<select name='ms_memo_{$list[$i][ms_id]}' onchange=\"javascript:document.getElementById('memo_edit_{$list[$i][ms_id]}').value=this.value;\">";
                        echo $memo_str_tmp . $memo_str;
                        ?>
                        </span> 
                        </td>
                        <td><?=cut_str($list[$i][ms_datetime],10, '')?></td>
                        <td><a href="javascript:del('<?=$list[$i][del_href]?>');"><img src="<?=$member_skin_path?>/img/btn_comment_delete.gif" width="45" height="14" border="0"></a></td>
                    </tr>
                <? } ?>

                <? if ($i == 0) echo "<tr><td colspan=5 align=center height=100>�ڷᰡ �����ϴ�.</td></tr>"; ?>
                </table></td>
        </tr>
        </table></td>
</tr>
<tr> 
    <td height="30" align="center"><?=get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");?></td>
</tr>
<tr> 
    <td height="2" align="center" valign="top" bgcolor="#D5D5D5"></td>
</tr>
<tr>
    <td height="2" align="center" valign="top" bgcolor="#E6E6E6"></td>
</tr>
<? if (!$head_on) { ?>
<tr>
    <td height="30" align="center" valign="bottom"><a href="javascript:window.close();"><img src="<?=$member_skin_path?>/img/btn_close.gif" width="48" height="20" border="0"></a></td>
</tr>
<? } ?>
</table>
<br>

<form name=flist method=post>
<input type="hidden" class="ed" id="memo_edit" name="memo_edit" value="<?=$memo_edit?>" />
</form>

<script language="JavaScript">
var save_before = '';

function memo_box(memo_id)
{
    var el_id;

    el_id = 'memo_' + memo_id;

    if (save_before != el_id) {
      
        if (save_before)
        {
            document.getElementById(save_before).style.display = 'none';
        }

        document.getElementById(el_id).style.display = 'block';
        save_before = el_id;
    } else {
        if (save_before)
            if (document.getElementById(save_before).style.display == 'none')
                document.getElementById(save_before).style.display = 'block';
            else
                document.getElementById(save_before).style.display = 'none';
    }
    
}

// ������ �޸� ������Ʈ
function memo_update(ms_id) {
    var f = document.flist;
    var el_id;

    el_id = 'memo_edit_' + ms_id;
    document.getElementById('memo_edit').value = document.getElementById(el_id).value;
    f.action = "<?=$member_skin_path?>/scrap_memo_update.php?ms_id=" + ms_id + "&head_on=<?=$head_on?>&mnb=<?=$mnb?>&snb=<?=$snb?>";
    f.submit();
}
</script>

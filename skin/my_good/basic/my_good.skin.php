<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 

// �Խ��� ��Ϻ��� �����ϱ�
$sql = " select distinct a.bo_table, b.bo_subject from $g4[board_good_table] a left join $g4[board_table] b on a.bo_table=b.bo_table where a.mb_id = '$member[mb_id]' ";
$result = sql_query($sql);
$str = "<select class='form_control' name='bo_table' id='$bo_table' onchange=\"location='$g4[bbs_path]/my_good.php?head_on=$head_on&mnb=$mnb&snb=$snb&sfl=bo_table&stx='+this.value;\">";
$str .= "<option value='all'>��ü��Ϻ���</option>";
    for ($i=0; $row=sql_fetch_array($result); $i++)
    {
        $str .= "<option value='$row[bo_table]'";
        if ($sfl=='bo_table' and $row[bo_table] == $stx) $str .= " selected";
        $str .= ">$row[bo_subject]</option>";
    }
    $str .= "</select>";
?>

<script type="text/javascript" src="<?=$g4[path]?>/js/sideview.js"></script>

<form name=fsearch method=get role="form" class="form-inline" style="margin-bottom:5px;">
<input type=hidden name=head_on value=<?=$head_on?>>
<input type=hidden name=mnb value=<?=$mnb?>>
<input type=hidden name=snb value=<?=$snb?>>
<a class="btn btn-default" href="<?=$g4[bbs_path]?>/my_good.php?head_on=<?=$head_on?>&mnb=<?=$mnb?>&snb=<?=$snb?>">ó��</a>
<span class="pull-right"><?=$str?></span>
</form>

<table width="100%" class="table table-hover">
<tr class="success" align=center> 
    <td class="col-sm-1">��ȣ</td>
    <td class="col-sm-2">�Խ���</td>
    <td>����</td>
    <td class="col-sm-1 hidden-xs">�۾���</td>
    <td class="col-sm-1 hidden-xs">��õ��¥</td>
</tr>
<? for ($i=0; $i<count($list); $i++) { ?>
    <tr align="center"> 
        <td height="24"><?=$list[$i][num]?></td>
        <td>
            <? if ($head_on) { ?>
                <a href="<?=$list[$i][opener_href]?>">
            <? } else { ?>
                <a href="javascript:;" onclick="opener.document.location.href='<?=$list[$i][opener_href]?>';">
            <? } ?>
            <?=$list[$i][bo_subject]?></a>
        </td>
        <td align="left" style='word-break:break-all;'>
            <? // ��б��� ��ũ���� ��� ��б� �������� �տ� ǥ��
            if ($list[$i][secret]) 
                $secret_icon = "";
            else
                $secret_icon = "";
            if ($secret_icon)
                echo $secret_icon . "&nbsp;&nbsp;";
            ?>
            <? if ($head_on) { ?>
                <a href="<?=$list[$i][opener_href_wr_id]?>" title="<?=$list[$i][subject]?>">
            <? } else { ?>
                <a href="javascript:;" onclick="opener.document.location.href='<?=$list[$i][opener_href_wr_id]?>';" title="<?=$list[$i][subject]?>">
            <? } ?>
            <?=cut_str($list[$i][wr_subject],65)?></a></td>
            <td><?=$list[$i][mb_nick]?></td>
                        <td><?=cut_str($list[$i][bg_datetime],10, '')?></td>
                        <td>
                        <? if ($list[$i][del_href]) { ?><a href="javascript:del('<?=$list[$i][del_href]?>');"><img src="<?=$member_skin_path?>/img/btn_comment_delete.gif" width="45" height="14" border="0"></a><? } ?>
                        </td>
                    </tr>
                <? } ?>

                <? if ($i == 0) echo "<tr><td colspan=5 align=center height=100>�ڷᰡ �����ϴ�.</td></tr>"; ?>
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
                <colgroup width=60>
                <colgroup width=120>
                <colgroup width=''>
                <colgroup width=80>
                <colgroup width=80>
                <colgroup width=50>
                <tr bgcolor=#E1E1E1 align=center> 
                    <td height="24" align=center><b>��ȣ</b></td>
                    <td><b>�Խ���</b></td>
                    <td><b>����</b></td>
                    <td><b>�۾���</b></td>
                    <td><b>��õ�Ͻ�</b></td>
                    <td><b>���</b></td>
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
                        <?=cut_str($list[$i][wr_subject],65)?></a></td>
                        <td><?=$list[$i][mb_nick]?></td>
                        <td><?=cut_str($list[$i][bg_datetime],10, '')?></td>
                        <td>
                        <? if ($list[$i][del_href]) { ?><a href="javascript:del('<?=$list[$i][del_href]?>');"><img src="<?=$member_skin_path?>/img/btn_comment_delete.gif" width="45" height="14" border="0"></a><? } ?>
                        </td>
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

<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 

// �Խ��� ��Ϻ��� �����ϱ�
$sql = " select distinct a.bo_table, b.bo_subject from $g4[board_good_table] a left join $g4[board_table] b on a.bo_table=b.bo_table where a.mb_id = '$member[mb_id]' ";
$result = sql_query($sql);
$str = "<select class='form-control' name='bo_table' id='$bo_table' onchange=\"location='$g4[bbs_path]/my_good.php?head_on=$head_on&mnb=$mnb&snb=$snb&sfl=bo_table&stx='+this.value;\">";
$str .= "<option value='all'>��ü��Ϻ���</option>";
    for ($i=0; $row=sql_fetch_array($result); $i++)
    {
        $str .= "<option value='$row[bo_table]'";
        if ($sfl=='bo_table' and $row[bo_table] == $stx) $str .= " selected";
        $str .= ">$row[bo_subject]</option>";
    }
    $str .= "</select>";
?>

<form name=fsearch method=get role="form" class="form-inline" style="margin-bottom:5px;">
<input type=hidden name=head_on value="<?=$head_on?>">
<input type=hidden name=mnb value="<?=$mnb?>">
<input type=hidden name=snb value="<?=$snb?>">
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
                $secret_icon = "<i class=\"fa fa-lock\"></i>";
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
            <?=cut_str($list[$i][wr_subject],65)?></a>

            <? if ($list[$i][del_href]) { ?>
                <a href="javascript:del('<?=$list[$i][del_href]?>');"><i class="fa fa-trash-o"></i></a>
            <? } ?>
            <div class="visible-xs"><?=$list[$i][mb_nick]?> <small><?=get_date($list[$i][bg_datetime])?></small>
        </td>
        <td class="hidden-xs"><?=$list[$i][mb_nick]?></td>
        <td class="hidden-xs"><?=get_date($list[$i][bg_datetime])?></td>
    </tr>
<? } ?>

<? if ($i == 0) echo "<tr><td colspan=5 align=center height=100>�ڷᰡ �����ϴ�.</td></tr>"; ?>
</table>

<div class="center-block">
    <ul class="pagination">
    <? if ($prev_part_href) { echo "<li><a href='$prev_part_href'>�����˻�</a></li>"; } ?>
    <?
    // �⺻���� �Ѿ���� �������� �Ʒ��� ���� ��ȯ�Ͽ� �پ��ϰ� ����� �� �ֽ��ϴ�.
    $write_pages = str_replace("����", "<i class='fa fa-angle-left'></i>", $write_pages);
    $write_pages = str_replace("����", "<i class='fa fa-angle-right'></i>", $write_pages);
    $write_pages = str_replace("ó��", "<i class='fa fa-angle-double-left'></i>", $write_pages);
    $write_pages = str_replace("�ǳ�", "<i class='fa fa-angle-double-right'></i>", $write_pages);
    ?>
    <?=$write_pages?>
    <? if ($next_part_href) { echo "<li><a href='$next_part_href'>���İ˻�</a></li>"; } ?>
    </ul>
</div>

<? if (!$head_on) { ?>
    <a class="btn btn-default" href="javascript:window.close();">Close</a>
<? } ?>

<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 
?>

<a class="btn btn-default" href="<?=$g4[bbs_path]?>/notice_list.php">ó������
<? if ($total_count > 0) {?>&nbsp;(<?=number_format($total_count)?>)<?}?>
</a>

<form name="fboardlist" method="post" role="form" class="form-inline">
<input type="hidden" name="sw"   value="">	
<input type="hidden" name="view"   value="<?=$view?>">	
<input type="hidden" name="mb_id"   value="<?=$mb_id?>">	

<table width="100%" class="table table-hover table-condensed">
<tr class="success" align=center> 
    <td class="col-sm-2 hidden-xs">�Խ���</td>
    <td>����</td>
    <td class="col-sm-2 hidden-xs">�۾���</td>
    <td class="col-sm-1 hidden-xs"><?=subject_sort_link('wr_datetime', $qstr2, 1)?>��¥</a></td>
    <td class="col-sm-1 hidden-xs">��ȸ</td>
</tr>
<?
for ($i=0; $i<count($list); $i++) {
    $bo_subject = cut_str($list[$i][bo_subject], 10);
    $wr_subject = get_text(cut_str($list[$i][wr_subject], 40));
?>
<tr align=center>
    <td align="center" class="hidden-xs"><?=$bo_subject?></td>
    <td align=left class="hidden-xs">
    <a href='<?=$list[$i][href]?>'><?=$wr_subject?></a>
    <? if ($list[$i][wr_comment]) echo "<span style='font-family:Tahoma;font-size:10px;color:#EE5A00;'>(" . $list[$i][wr_comment] . ")</span>"?>
    </td>
    <td align="center" class="hidden-xs"><?=$list[$i][name]?></td>
    <td align="center" class="hidden-xs"><?=$list[$i][wr_datetime2]?></td>
    <td align="center" class="hidden-xs"><?=$list[$i][wr_hit]?></td>
    <!-- 
    xs ������� 30���� �̻��̸� table width�� �Ѿ ���� ��ũ���� ����ϴ� 
    �׷���, ���� ����ϴ� row�� ����� ����ϴ�.
    xs ��������� �Ʒ�ó�� 1���� td�� ��� �˴ϴ�. �ٸ� ���� ��� hidden.
    �� ���� ����� ���� ������ ������ ȯ�� �մϴ�.
    -->
    <td align=left class="visible-xs" style='word-break:break-all;'>
        <div>
            <a href='<?=$list[$i][href]?>'><?=cut_str($wr_subject,30)?></a>
            <? if ($list[$i][wr_comment]) echo "<span style='color:#EE5A00;'>(" . $list[$i][wr_comment] . ")</span>"?>
            <span class="pull-right"><font style="color:#BABABA;"><?=$bo_subject?></font></span>
        </div>
        <span class="visible-xs pull-right">
        <font style="color:#BABABA;">
        <?=$list[$i][wr_datetime2]?>&nbsp;&nbsp;
        <?=$list[$i][wr_hit]?>&nbsp;&nbsp;
        </font>
        <?=$list[$i][name]?>
        </span>        
    </td>
</tr>
<?}?>
<? if ($i == 0) { ?>
<tr><td colspan="5" height=50 align=center>�Խù��� �����ϴ�.</td></tr>
<? } ?>
</table>
</form>

<!-- ������ -->
<div class="hidden-xs" style="text-align:center;">
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
<div class="center-block visible-xs">
    <ul class="pagination">
    <? if ($prev_part_href) { echo "<li><a href='$prev_part_href'>�����˻�</a></li>"; } ?>
    <?
    // �⺻���� �Ѿ���� �������� �Ʒ��� ���� ��ȯ�Ͽ� �پ��ϰ� ����� �� �ֽ��ϴ�.
    $write_pages_xs = str_replace("����", "<i class='fa fa-angle-left'></i>", $write_pages_xs);
    $write_pages_xs = str_replace("����", "<i class='fa fa-angle-right'></i>", $write_pages_xs);
    $write_pages_xs = str_replace("ó��", "<i class='fa fa-angle-double-left'></i>", $write_pages_xs);
    $write_pages_xs = str_replace("�ǳ�", "<i class='fa fa-angle-double-right'></i>", $write_pages_xs);
    ?>
    <?=$write_pages_xs?>
    <? if ($next_part_href) { echo "<li><a href='$next_part_href'>���İ˻�</a></li>"; } ?>
    </ul>
</div>
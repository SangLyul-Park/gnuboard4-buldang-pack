<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ�
?>
<script type="text/javascript" src="<?=$g4[path]?>/js/sideview.js"></script>
<script language="JavaScript">
var list_delete_php = "recycle_list_delete.php";
</script>

<script type="text/javascript">
function recycle_delete(ok)
{
    var msg;

    if (ok == 1)
        msg = "<?=$config[cf_recycle_days]?>���� ���� �������� ������ �����մϴ�.\n\n\n�׷��� �����Ͻðڽ��ϱ�?";
    else
        msg = "<?=$config[cf_recycle_days]?>���� ���� �������� �����մϴ�.\n\n\n�׷��� �����Ͻðڽ��ϱ�?";

    if (confirm(msg)) {
        document.location.href = "<?=$g4[admin_path]?>/recycle_delete.php?ok=" + ok;
    }
}
</script>

<form name=fsearch method=get role="form" class="form-inline" >
<a class="btn btn-default" href="<?=$_SERVER[PHP_SELF]?>">ó��</a>
(�����ۼ� : <?=number_format($total_count)?>, �����ۼ� : <?=number_format($delete_count)?>)
<div class="pull-right">
    <select class="form-control" name=sfl class=cssfl>
        <option value='bo_table'>�Խ���</option>
    </select>
    <div class="form-group">
        <input class="form-control" type=text name=stx required itemname='�˻���' value='<? echo $stx ?>'>
    </div>
    <input class="btn btn-default" type=submit value='�˻�'>
</div>
</form>

<form name=fmemberlist method=post>
<input type=hidden name=sst   value='<?=$sst?>'>
<input type=hidden name=sod   value='<?=$sod?>'>
<input type=hidden name=sfl   value='<?=$sfl?>'>
<input type=hidden name=stx   value='<?=$stx?>'>
<input type=hidden name=page  value='<?=$page?>'>
<input type=hidden name=token value='<?=$token?>'>

<table width=100% class="table table-hover table-condensed">
<tr class="success" >
    <td><?=subject_sort_link('mb_id')?>�۾���</a></td>
    <td><?=subject_sort_link('bo_table')?>�Խ���</a></td>
    <td>(wr_id) �Խñ�����</td>
    <td>�ۼ���</td>
    <td><?=subject_sort_link('rc_datetime', '', 'desc')?>������</a></td>
  	<td>����</td>
</tr>
<tr><td colspan='<?=$colspan?>' class='line2'></td></tr>
<?
for ($i=0; $row=sql_fetch_array($result); $i++) {
    
    $mb = get_member($row[mb_id]);
    $mb_nick = get_sideview($mb[mb_id], $mb[mb_nick], $mb[mb_email], $mb[mb_homepage]);    

    // �Խñ� ����
    $tmp_write_table = $g4['write_prefix'] . $row[rc_bo_table];
    $sql2 = " select wr_subject, wr_content, wr_datetime from $tmp_write_table where wr_id = '$row[rc_wr_id]' ";
    $write = sql_fetch($sql2);

    // �ڸ�Ʈ���� ����
    $c_flag="";
    if ($row[wr_is_comment])
        $c_flag = " C";
    
    // wr_id
    if ($c_flag)
        $wr_id = $row[wr_id] . $c_flag;
    else
        $wr_id = "<a href='$g4[bbs_path]/recycle_view.php?bo_table=$row[rc_bo_table]&wr_id=$row[rc_wr_id]&org_bo_table=$row[bo_table]' target=_blank>" . $row[wr_id] . "</a>";

    // ���� ��ư�� ���
    if ($row[rc_delete] == 0)
        $s_recover = "<a href=\"javascript:post_recover('$g4[bbs_path]/recycle_recover.php', '$row[rc_no]');\"><i class=\"fa fa-undo\"></i></a>";
    else
        $s_recover = "";

    // ��ڰ� �����Ѱ� (mb_id�� rc_mb_id�� �ٸ� ���)���� �ڿ� mark
    $mb_remover="";
    if ($row[mb_id] !== $row[rc_mb_id])
        $mb_remover="&nbsp;<img src='$g4[admin_path]/img/icon_admin.gif' align=absmiddle border=0 title='�����ڰ� �������� ��'>";

    // �Խ��Ǿ��̵�. �Խ��� ����
    $bo_info = get_board($row[bo_table],"bo_subject");
    $bo_table1 = "<a href='$g4[bbs_path]/recycle_list.php?sfl=bo_table&stx=$row[bo_table]' title='$bo_info[bo_subject]'>$row[bo_table]</a>";

    $list = $i%2;
    echo "
    <input type=hidden name=rc_no[$i] value='$row[rc_no]'>
    <tr class='list$list col1 ht center'>
        <td title='$row[mb_id]'>$mb_nick$mb_remover</td>
        <td>$bo_table1</td>
        <td>($wr_id) " . conv_subject($write[wr_subject],80) . "</td>
        <td>" . get_datetime($write[wr_datetime]) . "</td>
        <td>" . get_datetime($row[rc_datetime]) . "</td>
        <td>$s_recover</td>
    </tr>";
}

if ($i == 0)
    echo "<tr><td colspan=6 align=center height=100 class=contentbg>�ڷᰡ �����ϴ�.</td></tr>";

echo "</table>";

if ($stx)
    echo "<script language='javascript'>document.fsearch.sfl.value = '$sfl';</script>\n";
?>
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
</form>

<ul>
<li>DB���� ������ �Խñ� ������ �ϱ⸦ ���ϴ� ��� �����ڿ��� �����Ͻñ� �ٶ��ϴ�.</li>
<li>ȸ�����̵� ���� �������� �ִ� ����, ����ڰ� ������ ���� �ƴ϶� �����ڰ� ������ �� �Դϴ�.</li>
<li>�Խ����� Ŭ���ϸ� �ش� �Խ����� �������� ���ĵǸ�, �Խñ� id�� Ŭ���ϸ� �ش� �Խñ��� ��â�� ��ϴ�.</li>
</ul>

<script type="text/javascript">
// POST ������� ����
function post_recover(action_url, val)
{
	var f = document.fpost;

	if(confirm("������ �ڷḦ ���� �մϴ�.\n\n���� �����Ͻðڽ��ϱ�?")) {
        f.rc_no.value = val;
		f.action      = action_url;
		f.submit();
	}
}
</script>

<form name='fpost' method='post'>
<input type='hidden' name='sst'   value='<?=$sst?>'>
<input type='hidden' name='sod'   value='<?=$sod?>'>
<input type='hidden' name='sfl'   value='<?=$sfl?>'>
<input type='hidden' name='stx'   value='<?=$stx?>'>
<input type='hidden' name='page'  value='<?=$page?>'>
<input type='hidden' name='token' value='<?=$token?>'>
<input type='hidden' name='rc_no'>
</form>
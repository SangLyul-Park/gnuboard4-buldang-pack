<?
$sub_menu = "300700";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$token = get_token();

$sql_common = " from $g4[recycle_table] ";

$sql_search = " where rc_wr_id = rc_wr_parent ";
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case "mb_id" :
            $sql_search .= " ($sfl = '$stx') ";
            break;
        case "bo_table" :
            $sql_search .= " ($sfl = '$stx') ";
            break;
        default :
            $sql_search .= " ($sfl like '$stx%') ";
            break;
    }
    $sql_search .= " ) ";
}

if (!$sst) {
    $sst = "rc_datetime";
    $sod = "desc";
}

$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = $config[cf_page_rows];
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���
if (!$page) $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

// ���� �Խñ� ��
$sql = " select count(*) as cnt
         $sql_common
         $sql_search
            and rc_delete = '1'
         $sql_order ";
$row = sql_fetch($sql);
$delete_count = $row[cnt];

$listall = "<a href='$_SERVER[PHP_SELF]' class=tt>ó��</a>";

$g4[title] = "���������";
include_once("./admin.head.php");

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);

$colspan = 15;
?>

<script language="JavaScript">
var list_delete_php = "recycle_list_delete.php";
</script>

<script language="JavaScript">
function recycle_delete(ok)
{
    var msg;

    if (ok == 1)
        msg = "<?=$config[cf_recycle_days]?>���� ���� �������� ������ �����մϴ�.\n\n\n�׷��� �����Ͻðڽ��ϱ�?";
    else
        msg = "<?=$config[cf_recycle_days]?>���� ���� �������� �����մϴ�.\n\n\n�׷��� �����Ͻðڽ��ϱ�?";

    if (confirm(msg))
    {
        document.location.href = "./recycle_delete.php?ok=" + ok;
    }
}
</script>

<table width=100%>
<form name=fsearch method=get>
<tr>
    <td width=50% align=left><?=$listall?> 
        (�����ۼ� : <?=number_format($total_count)?>, �����ۼ� : <?=number_format($delete_count)?>)
        &nbsp;&nbsp;<a href="javascript:recycle_delete();">�����ۻ���</a>
        &nbsp;&nbsp;<a href="javascript:recycle_delete(1);">�����ۿ�������</a>
    </td>
    <td width=50% align=right>
        <select name=sfl class=cssfl>
            <option value='mb_id'>ȸ�����̵�</option>
            <option value='bo_table'>�Խ���</option>
        </select>
        <input type=text name=stx class=ed required itemname='�˻���' value='<? echo $stx ?>'>
        <input type=image src='<?=$g4[admin_path]?>/img/btn_search.gif' align=absmiddle></td>
</tr>
</form>
</table>

<form name=fmemberlist method=post>
<input type=hidden name=sst   value='<?=$sst?>'>
<input type=hidden name=sod   value='<?=$sod?>'>
<input type=hidden name=sfl   value='<?=$sfl?>'>
<input type=hidden name=stx   value='<?=$stx?>'>
<input type=hidden name=page  value='<?=$page?>'>
<input type=hidden name=token value='<?=$token?>'>

<table width=100% cellpadding=0 cellspacing=0>
<colgroup width=30>
<colgroup width=100>
<colgroup width=80>
<colgroup width=60>
<colgroup width=''>
<colgroup width=40>
<colgroup width=80>
<colgroup width=80>
<tr><td colspan='<?=$colspan?>' class='line1'></td></tr>
<tr class='bgcol1 bold col1 ht center'>
    <td><input type=checkbox name=chkall value='1' onclick='check_all(this.form)'></td>
    <td><?=subject_sort_link('mb_id')?>ȸ�����̵�</a></td>
    <td><?=subject_sort_link('bo_table')?>�Խ���id</a></td>
    <td>�Խñ�id</td>
    <td>�Խñ�����</td>
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
    $sql2 = " select wr_subject, wr_content from $tmp_write_table where wr_id = '$row[rc_wr_id]' ";
    $write = sql_fetch($sql2);
    $wr_subject = conv_subject($write[wr_subject],80);
    if ($row[rc_delete])
        $wr_subject = "<strike>" . $wr_subject . "</stricke>";

    // �ڸ�Ʈ���� ����
    $c_flag="";
    if ($row[wr_is_comment])
        $c_flag = " C";
    
    // wr_id
    if ($c_flag)
        $wr_id = $row[wr_id] . $c_flag;
    else
        $wr_id = "<a href='$g4[admin_path]/recycle_view.php?bo_table=$row[rc_bo_table]&wr_id=$row[rc_wr_id]&org_bo_table=$row[bo_table]' target=_blank>" . $row[wr_id] . "</a>";

    // ���� ��ư�� ���
    if ($row[rc_delete] == 0)
        $s_recover = "<a href=\"javascript:post_recover('recycle_recover.php', '$row[rc_no]');\"><img src='img/icon_recover.gif' border=0 title='����'></a>";
    else
        $s_recover = "";

    // ��ڰ� �����Ѱ� (mb_id�� rc_mb_id�� �ٸ� ���)���� �ڿ� mark
    $mb_remover="";
    if ($row[mb_id] !== $row[rc_mb_id])
        $mb_remover="&nbsp;<img src='img/icon_admin.gif' align=absmiddle border=0 title='�����ڰ� �������� ��'>";

    // �Խ��Ǿ��̵�. �Խ��� ����
    $bo_info = get_board($row[bo_table],"bo_subject");
    $bo_table1 = "<a href='$g4[admin_path]/recycle_list.php?sfl=bo_table&stx=$row[bo_table]' title='$bo_info[bo_subject]'>$row[bo_table]</a>";

    $list = $i%2;
    echo "
    <input type=hidden name=rc_no[$i] value='$row[rc_no]'>
    <tr class='list$list col1 ht center'>
        <td><input type=checkbox name=chk[] value='$i'></td>
        <td title='$row[mb_id]'><nobr style='display:block; overflow:hidden; width:90;'>&nbsp;$mb_nick$mb_remover</nobr></td>
        <td><nobr style='display:block; overflow:hidden; width:90px;'>$bo_table1</nobr></td>
        <td><nobr style='display:block; overflow:hidden; width:90px;'>$wr_id</nobr></td>
        <td>$wr_subject</td>
        <td>" . get_datetime($row[rc_datetime]) . "</td>
        <td>$s_recover</td>
    </tr>";
}

if ($i == 0)
    echo "<tr><td colspan='$colspan' align=center height=100 class=contentbg>�ڷᰡ �����ϴ�.</td></tr>";

echo "<tr><td colspan='$colspan' class='line2'></td></tr>";
echo "</table>";

$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
echo "<table width=100% cellpadding=3 cellspacing=1>";
echo "<tr><td width=50%>";
echo "<input type=button class='btn1' value='���û���' onclick=\"btn_check(this.form, 'delete')\">";
echo "</td>";
echo "<td width=50% align=right>$pagelist</td></tr></table>\n";

if ($stx)
    echo "<script language='javascript'>document.fsearch.sfl.value = '$sfl';</script>\n";
?>
</form>

* ������ ������ ���� mark�� �ϰ� �����δ� �������� �ʽ��ϴ�. ���� �Խñ� ������ ���Ͻø� ������������� �޴��� ������ּ���.<br>
* ȸ�����̵� ���� �������� �ִ� ����, ����ڰ� ������ ���� �ƴ϶� �����ڰ� ������ �� �Դϴ�.<br>
* �Խ���id�� Ŭ���ϸ� �ش� �Խ����� �������� ���ĵǸ�, �Խñ� id�� Ŭ���ϸ� �ش� �Խñ��� ��â�� ��ϴ�.

<script>
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

<?
include_once ("./admin.tail.php");
?>

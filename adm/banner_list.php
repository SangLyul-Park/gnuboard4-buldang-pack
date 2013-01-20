<?
$sub_menu = "300900";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$token = get_token();

$sql_common = " from $g4[banner_table] a ";
$sql_search = " where (1) ";

if ($is_admin != "super") {
    $sql_common .= " , $g4[banner_group_table] b ";
    $sql_search .= " and (a.bg_id = b.bg_id and b.bg_admin = '$member[mb_id]') ";
}

if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case "bn_id" :
            $sql_search .= " ($sfl like '$stx%') ";
            break;
        case "a.bg_id" :
            $sql_search .= " ($sfl = '$stx') ";
            break;
        default : 
            $sql_search .= " ($sfl like '%$stx%') ";
            break;
    }
    $sql_search .= " ) ";
}

if (!$sst) {
    $sst  = "a.bg_id, a.bn_id";
    $sod = "asc";
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
if ($page == "") { $page = 1; } // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

$sql = " select * 
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);

$listall = "<a href='$_SERVER[PHP_SELF]'>ó��</a>";

$g4[title] = "��ʰ���";
include_once("./admin.head.php");

include_once ("$g4[path]/lib/banner.lib.php");

$colspan = 8;
?>

<script type="text/javascript">
var list_update_php = 'banner_list_update.php';
var list_delete_php = 'banner_list_delete.php';
</script>

<table width=100% cellpadding=3 cellspacing=1>
<form name=fsearch method=get>
<tr>
    <td width=50% align=left><?=$listall?> (��ʼ� : <?=number_format($total_count)?>��)</td>
    <td width=50% align=right>
        <select name=sfl>
            <option value='bn_id'>���ID</option>
            <option value='bn_subject'>����</option>
            <option value='a.bg_id'>�׷�ID</option>
        </select>
        <input type=text name=stx class=ed required itemname='�˻���' value='<?=$stx?>'>
        <input type=image src='<?=$g4[admin_path]?>/img/btn_search.gif' align=absmiddle></td>
</tr>
</form>
</table>

<form name=fbannerlist method=post>
<input type=hidden name=sst   value="<?=$sst?>">
<input type=hidden name=sod   value="<?=$sod?>">
<input type=hidden name=sfl   value="<?=$sfl?>">
<input type=hidden name=stx   value="<?=$stx?>">
<input type=hidden name=page  value="<?=$page?>">
<input type=hidden name=token value="<?=$token?>">
<table width=100% cellpadding=0 cellspacing=1>
<colgroup width=30>
<colgroup width=100>
<colgroup width=100>
<colgroup width=''>
<colgroup width=120>
<colgroup width=55>
<colgroup width=35>
<colgroup width=35>
<tr><td colspan='<?=$colspan?>' class='line1'></td></tr>
<tr class='bgcol1 bold col1 ht2 center'>
    <td rowspan=2><input type=checkbox name=chkall value="1" onclick="check_all(this.form)"></td>
    <td ><?=subject_sort_link("bn_id")?>���ID</a></td>
    <td ><?=subject_sort_link("a.bg_id")?>�׷�</a></td>
    <td ><?=subject_sort_link("bn_subject")?>����</a></td>
    <td >������</td>
    <td rowspan=2 title="��ʻ��"><?=subject_sort_link("bn_use")?>���<br>���</a></td>
    <td rowspan=2 title="��ʼ���"><?=subject_sort_link("bn_order")?>���<br>����</a></td>
  	<td rowspan=2><a href="./banner_form.php"><img src='<?=$g4[admin_path]?>/img/icon_insert.gif' border=0 title='����'></a></td>
</tr>
<tr class='bgcol1 bold col1 ht2 center'>
    <td>Ŭ����</td>
    <td>Target(��â)</td>
    <td>URL</td>
    <td>������</td>
</tr>
<tr><td colspan='<?=$colspan?>' class='line2'></td></tr>
<?
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $s_upd = "<a href='./banner_form.php?w=u&bn_id=$row[bn_id]&$qstr'><img src='img/icon_modify.gif' border=0 title='����'></a>";
    $s_del = "";
    if ($is_admin == "super") {
        $s_del = "<a href=\"javascript:post_delete('banner_delete.php', '$row[bn_id]');\"><img src='img/icon_delete.gif' border=0 title='����'></a>";
    }

    $sql = " select count(*) as cnt from $g4[banner_click_table] where bg_id='$row[bg_id]' and bn_id='$row[bn_id]' ";
    $tmp = sql_fetch($sql);

    $list = $i % 2;
    echo "<input type=hidden name=bn_id[$i] value='$row[bn_id]'>";
    echo "<tr class='list$list col1 ht center'>";
    echo "<td rowspan=2 height=25><input type=checkbox name=chk[] value='$i'></td>";
    echo "<td ><a href='$g4[data_path]/banner/$row[bg_id]/$row[bn_image]' target=_blank><b>$row[bn_id]</b></a></td>";
    echo "<td ><a href='$g4[admin_path]/banner_list.php?sfl=a.bg_id&stx=$row[bg_id]'><b>$row[bg_id]</b></a></td>";
    echo "<td align=left height=25><input type=text class=ed name=bn_subject[$i] value='".get_text($row[bn_subject])."' style='width:99%'></td>";
    echo "<td ><input type=text class=ed name=bn_start_datetime[$i] value='$row[bn_start_datetime]' style='width:120px;'></td>";
    echo "<td rowspan=2><input type=checkbox name=bn_use[$i] ".($row[bn_use]?'checked':'')." value='1'></td>";
    echo "<td rowspan=2><input type=text class=ed name=bn_order[$i] value='$row[bn_order]' size=2></td>";
    echo "<td rowspan=2>$s_upd $s_del</td>";
    echo "</tr>";

    echo "<tr class='list$list col1 ht center'>";
    echo "<td>" . number_format($tmp[cnt]) . "</td>";
    echo "<td ><input type=checkbox name=bn_target[$i] ".($row[bn_target]?'checked':'')." value='1'></td>";
    echo "<td align=left><input type=text class=ed name=bn_url[$i] value='".get_text($row[bn_url])."' style='width:99%'></td>";
    echo "<td ><input type=text class=ed name=bn_end_datetime[$i] value='$row[bn_end_datetime]' style='width:120px;'></td>";
    echo "</tr>\n";
    echo "<script language='JavaScript'>document.getElementById('bo_skin_$i').value='$row[bo_skin]';</script>";
} 

if ($i == 0)
    echo "<tr><td colspan='$colspan' align=center height=100 bgcolor=#ffffff>�ڷᰡ �����ϴ�.</td></tr>"; 

echo "<tr><td colspan='$colspan' class='line2'></td></tr>";
echo "</table>";

$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page=");
echo "<table width=100% cellpadding=3 cellspacing=1>";
echo "<tr><td width=70%>";
echo "<input type=button class='btn1' value='���ü���' onclick=\"btn_check(this.form, 'update')\"> ";

if ($is_admin == "super")
    echo "<input type=button class='btn1' value='���û���' onclick=\"btn_check(this.form, 'delete')\">";

echo "</td>";
echo "<td width=30% align=right>$pagelist</td></tr></table>\n";

if ($stx)
    echo "<script>document.fsearch.sfl.value = '$sfl';</script>";
?>
</form>

<script type="text/javascript">
// POST ������� ����
function post_delete(action_url, val)
{
	var f = document.fpost;

	if(confirm("�ѹ� ������ �ڷ�� ������ ����� �����ϴ�.\n\n���� �����Ͻðڽ��ϱ�?")) {
    f.bn_id.value = val;
		f.action         = action_url;
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
<input type='hidden' name='bn_id'>
</form>

<?
include_once("./admin.tail.php");
?>

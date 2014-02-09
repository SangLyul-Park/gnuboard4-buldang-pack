<?
$sub_menu = "300555";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$token = get_token();

/*
CREATE TABLE IF NOT EXISTS `g4_singo_reason` (
  `sg_id` int(11) NOT NULL AUTO_INCREMENT,
  `sg_reason` varchar(255) NOT NULL,
  `sg_use` tinyint(4) NOT NULL,
  `sg_print` tinyint(4) NOT NULL,
  `sg_datetime` datetime NOT NULL,
  PRIMARY KEY (`sg_id`)
)
*/

$sql_common = " from $g4[singo_reason_table] ";

$sql_search = " where (1) ";

if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case "gr_id" :
        case "gr_admin" :
            $sql_search .= " ($sfl = '$stx') ";
            break;
        default : 
            $sql_search .= " ($sfl like '%$stx%') ";
            break;
    }
    $sql_search .= " ) ";
}

if ($sst)
    $sql_order = " order by $sst $sod ";
else
    $sql_order = " order by sg_id asc ";

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

$sql = " select * 
          $sql_common 
          $sql_search
          $sql_order 
          limit $from_record, $rows ";
$result = sql_query($sql);

$listall = "<a href='$_SERVER[PHP_SELF]'>ó��</a>";

$g4[title] = "�Ű��������";
include_once("./admin.head.php");
?>

<script type="text/javascript">
var list_update_php = "./boardgroup_list_update.php";
</script>

<form name=fsearch method=get role="form" class="form-inline">
<div class="btn-group">
    <?=$listall?> (�Ű���� : <?=number_format($total_count)?>��)
</div>
<div class="pull-right">
    <select name=sfl class="form-control">
        <option value="gr_subject">����</option>
        <option value="gr_id">ID</option>
        <option value="gr_admin">�׷������</option>
    </select>
    <input class="form-control" type=text name=stx required itemname='�˻���' value='<?=$stx?>'>
    <div class="form-group">
        <button class="btn btn-primary">�˻�</button>
    </div>
</div>
</form>

<form name=fboardgrouplist method=post>
<input type=hidden name=sst  value='<?=$sst?>'>
<input type=hidden name=sod  value='<?=$sod?>'>
<input type=hidden name=sfl  value='<?=$sfl?>'>
<input type=hidden name=stx  value='<?=$stx?>'>
<input type=hidden name=page value='<?=$page?>'>
<input type=hidden name=token value='<?=$token?>'>
<table width=100% class="table table-condensed table-hover table-responsive" style="word-wrap:break-word;">
<tr class="success">
    <td width=30><input type=checkbox name=chkall value="1" onclick="check_all(this.form)"></td>
    <td width=45><? if ($is_admin == "super") { echo "<a href='./boardgroup_form.php'><i class='fa fa-plus-square fa-2x' title='����'></i></a>"; } ?></td>
    <td>�Ű����</td>
    <td width=80>�Խ���</td>
    <td width=80>���ٻ��</td>
    <td width=80>����ȸ����</td>
    <td width=35>�˻�<br />���</td>
    <td width=35>�˻�<br />����</td>    
</tr>
<?
for ($i=0; $row=sql_fetch_array($result); $i++)
{
    $s_upd = "<a href='./boardgroup_form.php?$qstr&w=u&gr_id=$row[gr_id]'><i class='fa fa-pencil' title='����'></i></a>";
    $s_del = "";
    if ($is_admin == "super") {
        $s_del = "&nbsp;<a href=\"javascript:post_delete('boardgroup_delete.php', '$row[gr_id]');\"><i class='fa fa-trash-o' title='����'></i></a>";
    }

    $list = $i%2;
    echo "<input type=hidden name=sg_id[$i] value='$row[sg_id]'>";
    echo "<tr>";
    echo "<td><input type=checkbox name=chk[] value='$i'></td>";
    echo "<td>$s_upd $s_del</td>";
    echo "<td><input type=text name=sg_reason[$i] value='".get_text($row[sg_reason])."' size=30></td>";

    echo "<td><a href='./board_list.php?sfl=a.gr_id&stx=$row[gr_id]'>$row2[cnt]</a></td>";
    echo "<td><input type=checkbox name=gr_use_access[$i] ".($row[gr_use_access]?'checked':'')." value='1'></td>";
    echo "<td><a href='./boardgroupmember_list.php?gr_id=$row[gr_id]'>$row1[cnt]</a></td>";
    echo "<td title='�˻����'><input type=checkbox name=gr_use_search[$i] ".($row[gr_use_search]?'checked':'')." value='1'></td>";
    echo "<td title='�˻�����'><input type=text class=ed name=gr_order_search[$i] value='$row[gr_order_search]' size=2></td>";
    echo "</tr>\n";
} 

if ($i == 0)
    echo "<tr><td colspan='9' align=center height=100 bgcolor=#ffffff>�ڷᰡ �����ϴ�.</td></tr>"; 

echo "</table>";
?>

<!-- ������ -->
<div class="hidden-xs" style="text-align:center;">
    <ul class="pagination">
    <?=get_paging($config[cf_write_pages], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page=");?>
    </ul>
</div>

<div class="btn-group">
    <input type=button class='btn btn-default' value='���ü���' onclick="btn_check(this.form, 'update')">
</div>

<?
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
        f.gr_id.value = val;
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
<input type='hidden' name='gr_id'>
</form>

<?
include_once("./admin.tail.php");
?>

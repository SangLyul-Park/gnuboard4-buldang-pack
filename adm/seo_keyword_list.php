<?
// SEO ����Ű���� ����
$sub_menu = "200830";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$token = get_token();

$g4[title] = "SEO-����Ű����";
include_once ("./admin.head.php");

$g4[board_file_download_table] = $g4[board_file_table] . "_download";
$sql_common = " from $g4[seo_tag_table] a left join $g4[board_table] b on (a.bo_table = b.bo_table) ";

$sql_search = " where (1) ";

if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case "bo_table":
            $sql_search .= " (a.bo_table = '$bo_table') ";
            break;
        case "bo_table" :
            $sql_search .= " ($sfl = '$stx') ";
            break;
        case "count" :
            $sql_search .= " ($sfl >= $stx) ";
            break;
        default : 
            $sql_search .= " ($sfl like '%$stx%') ";
            break;
    }
    $sql_search .= " ) ";
}

if (!$sst) {
    $sst  = "a.tag_id";
    $sod = "desc";
}
$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt
         $sql_common 
         $sql_search 
          ";
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = $config[cf_page_rows];
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���
if ($page == "") $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

$sql = " select a.*, b.bo_subject
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);

$listall = "<a href='$_SERVER[PHP_SELF]'>ó��</a>";
?>

<form name=fsearch method=get role="form" class="form-inline">
<div class="btn-group">
    <?=$listall?> (�Ǽ� : <?=number_format($total_count)?>)
</div>
<div class="pull-right">
    <select name=sfl class="form-control">
        <option value='a.tag_name'>�±׸�</option>
        <option value='a.bo_table'>�Խ���</option>
        <option value='a.tag_date'>�˻��Ͻ�</option>
        <option value='a.count'>�˻�Ƚ��</option>    </select>
    <input class="form-control" type=text name=stx required itemname='�˻���' value='<?=$stx?>'>
    <div class="form-group">
        <button class="btn btn-primary">�˻�</button>
    </div>
</div>
</form>

<form name=fpointlist method=post role="form" class="form-inline">
<input type=hidden name=sst   value='<?=$sst?>'>
<input type=hidden name=sod   value='<?=$sod?>'>
<input type=hidden name=sfl   value='<?=$sfl?>'>
<input type=hidden name=stx   value='<?=$stx?>'>
<input type=hidden name=page  value='<?=$page?>'>
<input type=hidden name=token value='<?=$token?>'>

<table width=100% class="table table-condensed table-hover table-responsive" style="word-wrap:break-word;">
<colgroup width=30>
<colgroup width=180>
<colgroup width=120>
<colgroup width=''>
<colgroup width=80>
<colgroup width=60>
<tr class="success">
    <td><input type=checkbox name=chkall value='1' onclick='check_all(this.form)'></td>
    <td><?=subject_sort_link('a.tag_name')?>�±׸�</a></td>
    <td><?=subject_sort_link('a.bo_table')?>�Խ���</a></td>
    <td>�Խñ�����</td>
    <td><?=subject_sort_link('a.tag_date')?>�˻��Ͻ�</a></td>
    <td>�˻�Ƚ��</td>
</tr>
<?
$sql = " select a.*, b.bo_subject
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) 
{
    if ($row[bo_table]) {
        $tmp_write_table = $g4[write_prefix] . $row[bo_table];
        $write = sql_fetch("select * from $tmp_write_table where wr_id = $row[wr_id] ", FALSE);
        
        if ($write['wr_subject'] == "") {
            $write['wr_subject'] = "������ �Խ���";
        }
    }
    echo "
    <input type=hidden name=tag_id[$i] value='$row[tag_id]'>
    <tr class='list$list col1 ht center'>
        <td><input type=checkbox name=chk[] value='$i'></td>
        <td><a href='?sfl=a.tag_name&stx=$row[tag_name]'>$row[tag_name]</a></td>
        <td><a href='?sfl=a.bo_table&stx=$row[bo_table]'>" . cut_str($row[bo_subject],20) . "</a></td>
        <td><a href='$g4[bbs_path]/board.php?bo_table=$row[bo_table]&wr_id=$row[wr_id]' target=new>" . cut_str($write[wr_subject],40) . "</a></td>
        <td><a href='?sfl=a.tag_date&stx=$row[tag_date]'>" . get_datetime($row[tag_date]) . "</td>
        <td>". number_format($row[count])."</td>
    </tr> ";
} 

if ($i == 0)
    echo "<tr><td colspan='6' align=center height=100>�ڷᰡ �����ϴ�.</td></tr>";

echo "</table>";
?>

<!-- ������ -->
<div class="hidden-xs" style="text-align:center;">
    <ul class="pagination">
    <?=get_paging($config[cf_write_pages], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page=");?>
    </ul>
</div>

<?
if ($stx)
    echo "<script language='javascript'>document.fsearch.sfl.value = '$sfl';</script>\n";
?>
</form>

<script language='javascript'> document.fsearch.stx.focus(); </script>

<?
include_once ("./admin.tail.php");
?>

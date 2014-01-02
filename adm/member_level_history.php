<?
$sub_menu = "200500";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$token = get_token();

$sql_common = " from $g4[member_level_history_table] ";

$sql_search = " where (1) ";
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case "mb_id" :
            $sql_search .= " ($sfl = '$stx') ";
            break;
        case "from_level" :
            $sql_search .= " ($sfl = '$stx' and from_level < to_level) ";
            break;
        case "to_level" :
            $sql_search .= " ($sfl = '$stx' and to_level < from_level) ";
            break;
        default :
            $sql_search .= " ($sfl like '$stx%') ";
            break;
    }
    $sql_search .= " ) ";
} 

if (!$sst) {
    $sst = "id";
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

// ������ Ƚ��
$sql = " select count(*) as cnt
          $sql_common
          $sql_search
          and from_level < to_level ";
$result = sql_fetch($sql);
$levelup_count = $result['cnt'];

$listall = "<a href='$_SERVER[PHP_SELF]' class=tt>ó��</a>";

$g4[title] = "ȸ���������";
include_once("./admin.head.php");

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);

$colspan = 6;
?>

<table width=100%>
<form name=fsearch method=get>
<tr>
    <td width=50% align=left><?=$listall?> 
        (�ѷ������Ǽ� : <?=number_format($total_count)?>,
        <a href='?sst=id&sod=desc&sfl=from_level&stx=' title='�������� ȸ��'><font color=orange>������ : <?=number_format($levelup_count)?></font></a>, 
        <a href='?sst=id&sod=desc&sfl=to_level&stx=' title='�����ٿ�� ȸ��'><font color=crimson>�����ٿ� : <?=number_format($total_count - $levelup_count)?></font></a>)
    </td>
    <td width=50% align=right>
        <select name=sfl class=cssfl>
            <option value='from_level'>From Level</option>
            <option value='to_level'>To Level</option>
            <option value='mb_id'>ȸ�����̵�</option>
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
<colgroup width=80>
<colgroup width=80>
<colgroup width=80>
<colgroup width=80>
<colgroup width=''>
<tr><td colspan='<?=$colspan?>' class='line1'></td></tr>
<tr class='bgcol1 bold col1 ht center'>
    <td></td>
    <td><?=subject_sort_link('mb_id')?>ȸ�����̵�</a></td>
    <td><?=subject_sort_link('from_level')?>From ����</a></td>
    <td><?=subject_sort_link('to_level')?>To ����</a></td>
    <td><?=subject_sort_link('level_datetime', '', 'desc')?>��¥</a></td>
    <td></td>
</tr>
<tr><td colspan='<?=$colspan?>' class='line2'></td></tr>
<?
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $list = $i%2;

    $mb = get_member($row[mb_id], "mb_id, mb_nick");
    echo "
    <tr class='list$list col1 ht center'>
        <td></td>
        <td title='$mb[mb_nick]'><nobr style='display:block; overflow:hidden; width:90;'>&nbsp;<a href='?sst=id&sod=desc&sfl=mb_id&stx=$mb[mb_id]'>$mb[mb_nick]</a></nobr></td>
        <td><a href='?sst=id&sod=desc&sfl=from_level&stx=$row[from_level]'>$row[from_level]</a></nobr></td>
        <td><a href='?sst=id&sod=desc&sfl=to_level&stx=$row[to_level]'>$row[to_level]</a></td>
        <td>" . cut_str($row[level_datetime],10, '') . "</td>
        <td></td>
    </tr>";
}

if ($i == 0)
    echo "<tr><td colspan='$colspan' align=center height=100 class=contentbg>�ڷᰡ �����ϴ�.</td></tr>";

echo "<tr><td colspan='$colspan' class='line2'></td></tr>";
echo "</table>";

$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");

if ($stx)
    echo "<script language='javascript'>document.fsearch.sfl.value = '$sfl';</script>\n";
?>
</form>

<?
include_once ("./admin.tail.php");
?>

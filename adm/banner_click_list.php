<?
$sub_menu = "300320";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$g4[title] = "���Ŭ����Ȳ";
include_once("./admin.head.php");
include_once("./banner.sub.php");

$colspan = 6;
?>

<table width=100% cellpadding=0 cellspacing=1 border=0>
<colgroup width=140>
<colgroup width=100>
<colgroup width=>
<colgroup width=80>
<colgroup width=80>
<tr><td colspan='<?=$colspan?>' class='line1'></td></tr>
<tr class='bgcol1 bold col1 ht center'>
    <td>��ʱ׷�</td>
    <td>���ID</td>
    <td>�������</td>
    <td>������</td>
    <td>�Ͻ�</td>
</tr>
<tr><td colspan='<?=$colspan?>' class='line2'></td></tr>
<?
$sql_common = " from $g4[banner_click_table] ";
$sql_search = " where bc_datetime between '$fr_date 00:00:00' and '$to_date 23:59:59' ";

if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case "bg_id" :
        case "bn_id" :
            $sql_search .= " ($sfl like '$stx') ";
            break;
        default : 
            $sql_search .= " ($sfl like '%$stx%') ";
            break;
    }
    $sql_search .= " ) ";
}

if (!$sst) {
    $sst = "bc_id";
    $sod = "desc";
}

$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt
         $sql_common 
         $sql_search ";
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = $config[cf_page_rows];
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���
if ($page == "") $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

$sql = " select * 
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);

for ($i=0; $row=sql_fetch_array($result); $i++) {

    $brow = get_brow($row[vi_agent]);
    $tmp = sql_fetch(" select * from $g4[banner_table] where bg_id='$row[bg_id]' and bn_id = '$row[bn_id]' ");
    $bn_subject = $tmp['bn_subject'];

    $list = ($i%2);
    
    // �˻��� ����
    $query=$q="";
    //parse_str($title);
    if ($query)
        $query = iconv('EUC-KR' , $g4[charset], $query);  // naver
    else if ($q)
        $query = iconv('EUC-KR' , $g4[charset], $q);      // google

    echo "
    <tr class='list$list col1 ht center'>
        <td><a href='$_SERVER[PHP_SELF]?=fr_date=$fr_date&to_date=$to_date&stx=$row[bg_id]&sfl=bg_id'>$row[bg_id]</a></td>
        <td><a href='$_SERVER[PHP_SELF]?=fr_date=$fr_date&to_date=$to_date&stx=$row[bn_id]&sfl=bn_id'>$row[bn_id]</a></td>
        <td>$bn_subject</td>
        <td>$brow</td>
        <td>" . get_datetime($row[bc_datetime]) . "</td>
    </tr>";
}

if ($i == 0)
    echo "<tr><td colspan='$colspan' height=100 align=center>�ڷᰡ �����ϴ�.</td></tr>"; 

echo "<tr><td colspan='$colspan' class='line2'></td></tr>";
echo "</table>";

$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page=");
if ($page) {
    echo "<table width=100% cellpadding=3 cellspacing=1><tr><td>��ü �湮�ڼ� : " . number_format($total_count) . "</td><td align=right>$pagelist</td></tr></table>";
}

include_once("./admin.tail.php");
?>

<script language="JavaScript">
// java script�� ������ �̵� (referer�� ������ �ʱ� ���ؼ�)
function goto_page(page)
{
    if (page) {
        window.open(page);
    }
    return false;
}
</script>
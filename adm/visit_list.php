<?
$sub_menu = "200800";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$g4[title] = "��������Ȳ";
include_once("./admin.head.php");
include_once("./visit.sub.php");

$colspan = 6;
?>

<table width=100% cellpadding=0 cellspacing=1 border=0>
<colgroup width=140>
<colgroup width=>
<colgroup width=100>
<colgroup width=80>
<colgroup width=80>
<colgroup width=80>
<tr><td colspan='<?=$colspan?>' class='line1'></td></tr>
<tr class='bgcol1 bold col1 ht center'>
    <td>ip</td>
    <td><?=subject_sort_link('vi_referer',"fr_date=$fr_date&to_date=$to_date&domain=$domain&ip=$ip")?>���� ���</a></td>
    <td>�˻���</td>
    <td>������</td>
    <td>OS</td>
    <td>�Ͻ�</td>
</tr>
<tr><td colspan='<?=$colspan?>' class='line2'></td></tr>
<?
//unset($br); // ������
//unset($os); // OS

$sql_common = " from $g4[visit_table] ";
$sql_search = " where vi_date between '$fr_date' and '$to_date' ";
if ($domain) {
    $sql_search .= " and vi_referer like '%$domain%' ";
}
if ($ip) {
    $sql_search .= " and vi_ip like '$ip%' ";
}

if (!$sst) {
    $sst = "vi_id";
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
    $os   = get_os($row[vi_agent]);

    $link = "";
    $referer = "";
    $title = "";
    if ($row[vi_referer]) {

        $referer = get_text(cut_str($row[vi_referer], 255, ""));
        $referer = urldecode($referer);

        if (strtolower($g4['charset']) == 'utf-8') {
            if (!is_utf8($referer)) {
                $referer = iconv('euc-kr', 'utf-8', $referer);
            }
        }
        else {
            if (is_utf8($referer)) {
                $referer = iconv('utf-8', 'euc-kr', $referer);
            }
        }

        $title = str_replace(array("<", ">"), array("&lt;", "&gt;"), urldecode($row[vi_referer]));
        $link = "<a href='#' onclick=\"goto_page('" . $row[vi_referer] . "');return false;\" title='$title '>" . "<img align=absmiddle src='./img/icon_referer.gif'></a>";
        //$link = "<a href='$row[vi_referer]' target=_blank>";
    }

    if ($is_admin == 'super')
        $ip = $row[vi_ip];
    else
        $ip = preg_replace("/([0-9]+).([0-9]+).([0-9]+).([0-9]+)/", "\\1.��.\\3.\\4", $row[vi_ip]);

    $ip_link = "<a href='./visit_list.php?fr_date=$fr_date&to_date=$to_date&ip=$ip' title='$ip �� ������ ���'>";
    preg_match("/^(http:\/\/)?([^\/]+)/i", $title, $matches);
    $ref_domain = $matches[2];
    if ($ref_domain)
        $ref_link = "<a href='./visit_list.php?fr_date=$fr_date&to_date=$to_date&domain=$ref_domain' title='$ref_domain ���� ������ ���'>" . "<img align=absmiddle src='./img/icon_whois.gif'></a>";
    else
        $ref_link = "";
    $title_link = "<a href='./visit_list.php?fr_date=$fr_date&to_date=$to_date&domain=$title' title='$title ���� ������ ���'>";
    
    if ($brow == '��Ÿ') { $brow = "<span title='$row[vi_agent]'>$brow</span>"; }
    if ($os == '��Ÿ') { $os = "<span title='$row[vi_agent]'>$os</span>"; }

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
        <td align=left><a href='http://www.ip-adress.com/ip_tracer/$ip' target=_new><img align=absmiddle src='./img/icon_link.gif'></a> $ip_link$ip</a></td>
        <td align=left><nobr style='display:block; overflow:hidden; width:350;'>$link $ref_link $title_link" . cut_str($title,40) . "</a></nobr></td>
        <td>$query</td>
        <td>$brow</td>
        <td>$os</td>
        <td>$row[vi_date] $row[vi_time]</td>
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
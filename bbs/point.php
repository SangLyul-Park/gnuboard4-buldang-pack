<?
include_once("./_common.php");

if (!$member[mb_id]) 
    alert_close("ȸ���� ��ȸ�Ͻ� �� �ֽ��ϴ�.");

$g4[title] = $member[mb_nick] . "���� ����Ʈ ����";
include_once("$g4[path]/head.sub.php");

$list = array();

$sql_common = " from $g4[point_table] a left join $g4[board_new_table] b 
                on (a.po_rel_table = b.bo_table and a.po_rel_id = b.wr_id) ";
$sql_where = " where a.mb_id = '".mysql_real_escape_string($member[mb_id])."' ";

if($stx && $sfl && $stx != 'all'){
   $sql_where .= " and a.$sfl = '$stx' ";
}

$sql_order = " order by a.po_id desc ";

$sql = " select count(*) as cnt $sql_common $sql_where ";
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = $config[cf_page_rows];
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���
if (!$page) { $page = 1; } // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

$sql = " select a.po_point, a.po_datetime, a.po_content, b.bo_table, b.wr_id
                $sql_common
                $sql_where 
                $sql_order
                limit $from_record, $rows ";
$result = sql_query($sql);

$point_list = array();

for ($i=0; $row=sql_fetch_array($result); $i++) {
    $point_list[$i]['po_point'] = $row['po_point'];
    $point_list[$i]['po_datetime'] = $row['po_datetime'];
    $point_list[$i]['po_content'] = $row['po_content'];
    // �Խñ��� ��쿡�� url link�� �ɾ��ش�
    if ($row['bo_table'] && $row['wr_id'])
        $point_list[$i]['po_url'] = $g4['bbs_path'] . "/board.php?bo_table=" . $row['bo_table'] . "&wr_id=" . $row['wr_id'];
    else
        $point_list[$i]['po_url'] = "";
}

$write_pages = get_paging($config[cf_write_pages], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page=");

$member_skin_path = "$g4[path]/skin/member/$config[cf_member_skin]";
include_once("$member_skin_path/point.skin.php");

include_once("$g4[path]/tail.sub.php");
?>

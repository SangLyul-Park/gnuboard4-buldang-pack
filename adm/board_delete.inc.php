<?
// board_delete.php , boardgroup_delete.php ���� include �ϴ� ����

if (!defined("_GNUBOARD_")) exit;
if (!defined("_BOARD_DELETE_")) exit; // ���� ������ ���� �Ұ� 

// $tmp_bo_table ���� $bo_table ���� �Ѱ��־�� ��
if (!$tmp_bo_table) { return; }

// �Խ��� 1���� ���� �Ұ� (�Խ��� ���縦 ���ؼ�)
//$row = sql_fetch(" select count(*) as cnt from $g4[board_table] ");
//if ($row[cnt] <= 1) { return; }

// �Խ��� ���� ����
sql_query(" delete from $g4[board_table] where bo_table = '$tmp_bo_table' ", FALSE);

// �ֽű� ����
sql_query(" delete from $g4[board_new_table] where bo_table = '$tmp_bo_table' ", FALSE);

// ��ũ�� ����
sql_query(" delete from $g4[scrap_table] where bo_table = '$tmp_bo_table' ", FALSE);

// ���� ����
sql_query(" delete from $g4[board_file_table] where bo_table = '$tmp_bo_table' ", FALSE);

// �Խ��� ���̺� DROP
sql_query(" drop table $g4[write_prefix]$tmp_bo_table ", FALSE);

// �Խ��� ���� ��ü ����
rm_rf("$g4[data_path]/file/$tmp_bo_table");

// �Ҵ��� - �Խ��� �ٷΰ��� ����
sql_query(" delete from $g4[my_menu_table] where bo_table = '$tmp_bo_table' ", FALSE);

// �Ҵ��� - �Ű��� ����
sql_query(" delete from $g4[singo_table] where bo_table = '$tmp_bo_table' ", FALSE);

// �Ҵ��� - �α�� ����
sql_query(" delete from $g4[popular_table] where bo_table = '$tmp_bo_table' ", FALSE);

// �Ҵ��� - ���� �湮�� �Խ��� ����
sql_query(" delete from $g4[my_board_table] where bo_table = '$tmp_bo_table' ", FALSE);

// �Ҵ��� - �Խ��� �湮�� ��� ����
sql_query(" delete from $mw[board_visit_table] where bo_table = '$tmp_bo_table' ", FALSE);

// ����Ʈ ���� �ϱ����� sum ����Ʈ�� �����ؼ� �־��ش�
$sql = " select mb_id, sum(po_point)as po_sum from $g4[point_table] where po_rel_table = '$tmp_bo_table' group by mb_id ";
$result = sql_query($sql);
while ($row = sql_fetch_array($result))
{
    insert_point($row[mb_id], $row[po_sum], "$board[bo_subject] ������ ���� ����Ʈ����", $bo_table, '', '�Խ��ǻ��� ����Ʈ����');
}
sql_query(" delete from $g4[point_table] where po_rel_table = '$tmp_bo_table' and rel_action <> '�Խ��ǻ��� ����Ʈ����' ", FALSE);

// ��õ ���� ����
sql_query(" delete from $g4[board_good_table] where bo_table = '$tmp_bo_table' ", FALSE);

// whatson ����
sql_query(" delete from $g4[whatson_table] where bo_table = '$tmp_bo_table' ", FALSE);

// ����Ʈ�� ����
sql_query(" delete from $g4[good_list_table] where bo_table = '$tmp_bo_table' ", FALSE);

// chimage ����
sql_query(" delete from $g4[board_cheditor_table] where bo_table = '$tmp_bo_table' ", FALSE);

// �α�˻��� �հ� ����
sql_query(" delete from $g4[popular_sum_table] where bo_table = '$tmp_bo_table' ", FALSE);

// ��ü���� ���̺� ����
sql_query(" delete from $g4[notice_table] where bo_table = '$tmp_bo_table' ", FALSE);

// �Ҵ��� - �ٿ�ε� ���� ����, ���� case by case�� �ڸ�Ʈ�� �صд�.
$g4[board_file_download_table] = $g4[board_file_table] . "_download";
//sql_query(" delete from $g4[board_file_download_table] where po_rel_table = '$tmp_bo_table' ");

// SEO Ű���� ����
sql_query(" delete from $g4[seo_tag_table] where bo_table = '$tmp_bo_table' ", FALSE);
sql_query(" delete from $g4[seo_history_table] where bo_table = '$tmp_bo_table' ", FALSE);
?>
